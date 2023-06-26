<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import WorkoutView from '@/Components/WorkoutView.vue'
defineProps(['workout']);
</script>

<template>
    <AuthenticatedLayout>
        <template #title>
            <Head :title="workout.name" />
        </template>
        <WorkoutView :workout="workout"/>
    </AuthenticatedLayout>
</template>
