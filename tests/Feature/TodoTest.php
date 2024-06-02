<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Todo;

// inertia helper https://inertiajs.com/testing?ref=harrk.dev
use Inertia\Testing\AssertableInertia as Assert;

class TodoTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_view_todos(): void
    {
        // Call the Todo factory to create 10 todos
        Todo::factory(10)->create();

        // Hit the HomeController@index and capture the response
        $response = $this->get('/');

        // Then run through the assertions.
        // dd($response);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Home')
            ->has('todos', 10, fn (Assert $todo) => $todo
                ->has('id')
                ->has('task')
                ->has('is_done')
                ->etc()// this means we don't have to define every key on the Todo model
            )
        );
    }

    // testing in more traditional way comparing result with db
    public function test_can_complete_todo()
    {
        $todo = Todo::factory()->create([
            'is_done' => false,
        ]);

        $response = $this->put(route('todos.update', $todo), [
            'is_done' => true,
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'is_done' => true,
        ]);
    }

    public function test_can_delete_todo()
    {
        $todo = Todo::factory()->create();

        $response = $this->delete(route('todos.destroy', $todo));

        $response->assertRedirect('/');
        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id,
        ]);
    }
}
