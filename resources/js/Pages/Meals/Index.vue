<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MealList from '@/Components/MealList.vue';
import { Head } from '@inertiajs/vue3';
defineProps(['meals']);
</script>
<template>
    <Head title="Meals" />
    <AuthenticatedLayout>
        <template #title>
            <Head title="ImproviStation - Improve your life!" />
        </template>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Meals</h2>
        </template>
        <MealList :meals="meals"/>
    </AuthenticatedLayout>
</template>
