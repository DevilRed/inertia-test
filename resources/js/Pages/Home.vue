<template>
    <div class="mx-auto max-w-3xl mt-10 px-4">
        <h1 class="font-light text-3xl">My Todo List</h1>
        <AddTodoForm />

        <div class="flex flex-col space-y-4 mt-5">
            <Todo
                v-for="todo in todos"
                :key="todo.id"
                :todo="todo"
            />
        </div>
    </div>
</template>

<script setup>
    import Todo from "../Components/Todo.vue";
    import AddTodoForm from "../Components/AddTodoForm.vue";

    defineProps([
        'todos',
    ]);
</script>