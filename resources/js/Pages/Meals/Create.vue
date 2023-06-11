<script setup>
import {Head} from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MealForm from '@/Components/MealForm.vue';

</script>
<template>
    <AuthenticatedLayout>
        <template #title>
            <Head title="Create Meal" />
        </template>
        <MealForm />
    </AuthenticatedLayout>
</template >
