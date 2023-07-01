<script setup>
import {Head} from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MealForm from '@/Components/MealForm.vue';

const props = defineProps({
    recent_meal_items:{
        type: Array
    },
    macroList:{
        type: Array
    }
});
</script>
<template>
    <AuthenticatedLayout>
        <template #title>
            <Head title="New Meal" />
        </template>
        <MealForm :recent_meal_items="recent_meal_items" :macro-list="macroList"/>
    </AuthenticatedLayout>
</template >
