<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MealView from '@/Components/MealView.vue';
import { Head } from '@inertiajs/vue3';
defineProps(['meal']);
</script>

<template>
    <Head title="Meals" />
    <AuthenticatedLayout>
        <MealView :meal="meal"/>
    </AuthenticatedLayout>
</template>
