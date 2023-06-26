<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DashboardStats from '@/Components/DashboardStats.vue';
import DashboardGraph from '@/Components/DashboardGraph.vue';
let props = defineProps(['mealStats','dailyValues']);

</script>

<template>

    <AuthenticatedLayout>
        <template #title>
            <Head title="Dashboard" />
        </template>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight p-4 sm:p-8 bg-indigo-200 sm:hidden">Dashboard</h2>
        <div class="max-w-7xl mx-auto items-center">
            <DashboardStats :mealStats="mealStats"/>
        </div>
        <div class="max-w-7xl mx-auto items-center">
            <DashboardGraph :dailyValues="dailyValues" />
        </div>
    </AuthenticatedLayout>
</template>
