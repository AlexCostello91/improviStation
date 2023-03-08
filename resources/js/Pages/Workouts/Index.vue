<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import WorkoutList from '@/Components/WorkoutList.vue';
defineProps(['workouts']);
</script>

<template>
    <Head title="Workouts" />
    <AuthenticatedLayout>
        <WorkoutList :workouts="workouts" />
    </AuthenticatedLayout>
</template>
