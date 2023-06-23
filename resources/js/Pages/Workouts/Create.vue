<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import WorkoutForm from '@/Components/WorkoutForm.vue'
</script>

<template>
    <AuthenticatedLayout>
        <template #title>
            <Head title="New Workout" />
        </template>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">New Workout</h2>
        </template>
        <WorkoutForm />
    </AuthenticatedLayout>
</template>
