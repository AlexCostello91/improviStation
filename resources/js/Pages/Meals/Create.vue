<script setup>
import {Head} from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MealForm from '@/Components/MealForm.vue';

const props = defineProps(['user_id']);
</script>
<template>
    <AuthenticatedLayout>
        <template #title>
            <Head title="New Meal" />
        </template>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">New Meal</h2>
        </template>
        <MealForm :user_id="user_id"/>
    </AuthenticatedLayout>
</template >
