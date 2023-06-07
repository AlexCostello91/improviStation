<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MealView from '@/Components/MealView.vue';
import { Head } from '@inertiajs/vue3';
defineProps(['meal']);
</script>

<template>
    <AuthenticatedLayout>
        <template #title>
            <Head title="Meals" />
        </template>
        <MealView :meal="meal"/>
    </AuthenticatedLayout>
</template>
