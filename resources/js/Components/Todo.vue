<template>
    <div class="bg-gray-100 py-2 px-4 rounded flex flex-row space-x-4">
        <input
            type="checkbox"
            :true-value="1"
            v-model="todoForm.is_done"
            @change="save"
        />

        <p>{{ todo.task }}</p>

        <button
            type="button"
            @click="deleteTodo"
            class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
        >
            X
        </button>
    </div>
</template>


<script setup>
    import { useForm } from "@inertiajs/vue3";

    // This time store a reference to props so we can pull in the defaults in the form
    const props = defineProps([
        'todo',
    ]);

    // Populate form defaults based on the prop data
    const todoForm = useForm({
        is_done: props.todo.is_done,
    });

    // Send an update request for the todo
    const save = () => {
        todoForm.put(`/todos/${ props.todo.id }`);
    };

    // delete a todo
    const deleteTodo = () => {
        todoForm.delete(`/todos/${ props.todo.id }`);
    }
</script>