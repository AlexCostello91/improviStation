<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DashboardStats from '@/Components/DashboardStats.vue';
let props = defineProps(['mealStats','mealStatsNew']);

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
        <p>{{ meals }}</p>
        <div class="max-w-7xl mx-auto items-center">
            <DashboardStats :mealStats="mealStats" :mealStatsNew="mealStatsNew"/>
        </div>
    </AuthenticatedLayout>
</template>
