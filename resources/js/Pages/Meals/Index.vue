<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MealList from '@/Components/MealList.vue';
import { Head } from '@inertiajs/vue3';
defineProps(['meals']);
</script>
<template>
    <AuthenticatedLayout>
        <template #title>
            <Head title="Meals" />
        </template>
        <MealList :meals="meals"/>
    </AuthenticatedLayout>
</template>
