<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MealList from '@/Components/MealList.vue';
import { Head } from '@inertiajs/vue3';
import Footer from '@/Layouts/Footer.vue';
defineProps(['meals']);
</script>

<template>
    <Head title="Meals" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
        <MealList :meals="meals"/>
        <template #footer>
            <Footer />
        </template>
    </AuthenticatedLayout>
</template>
