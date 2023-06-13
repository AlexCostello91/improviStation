<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MealView from '@/Components/MealView.vue';
import {Head} from '@inertiajs/vue3';
const props = defineProps(['meal']);
</script>

<template>
    <AuthenticatedLayout>
        <template #title>
            <Head title="Meals" />
        </template>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{meal.name}}</h2>
        </template>
        <MealView :meal="meal"/>
    </AuthenticatedLayout>
</template>
