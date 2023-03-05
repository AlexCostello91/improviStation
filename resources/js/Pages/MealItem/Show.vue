<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MealItemView from '@/Components/MealItemView.vue';
import { Head } from '@inertiajs/vue3';
defineProps(['meal_item']);
</script>

<template>
    <Head title="Meal Item" />
    <AuthenticatedLayout>
        <MealItemView :meal_item="meal_item"/>
    </AuthenticatedLayout>
</template>
