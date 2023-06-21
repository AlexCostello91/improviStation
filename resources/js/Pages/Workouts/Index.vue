<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import WorkoutList from '@/Components/WorkoutList.vue';
defineProps(['workouts']);
</script>

<template>
    <AuthenticatedLayout>
        <template #title>
            <Head title="Workouts" />
        </template>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Workouts</h2>
        </template>
        <WorkoutList :workouts="workouts" />
    </AuthenticatedLayout>
</template>
