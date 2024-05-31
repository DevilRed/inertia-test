<template>
    <form
        @submit.prevent="createTodo"
        class="border flex space-x-4 p-4 rounded"
    >
        <div class="flex-1">
            <input
                class="block px-2 py-1.5 bg-gray-100 rounded w-full"
                placeholder="Enter your task..."
                type="text"
                v-model="todoForm.task"
            />

            <small
                v-if="todoForm.errors['task']"
                class="text-red-500 mt-2 block"
            >
                {{ todoForm.errors['task']}}
            </small>
        </div>

        <div>
            <button
                class="px-6 py-1.5 bg-indigo-600  rounded text-white disabled:opacity-50"
                :disabled="todoForm.processing"
            >
                Add
            </button>
        </div>
    </form>
</template>

<script setup>
    // Import the useForm helper
    import { useForm } from "@inertiajs/vue3";

    // Initialise the form with the properties we want to update client-side send to the server-side
    const todoForm = useForm({
        task: '',
    });

    // Create a method that tells the form to submit to TodoController@store
    const createTodo = () => {
        todoForm.post('/todos');
    };
</script>