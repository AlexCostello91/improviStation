<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import WorkoutForm from '@/Components/WorkoutForm.vue'
defineProps(['workout']);
</script>

<template>
    <AuthenticatedLayout>
        <template #title>
            <Head title="New Workout" />
        </template>
        <WorkoutForm :workout="workout"/>
    </AuthenticatedLayout>
</template>
