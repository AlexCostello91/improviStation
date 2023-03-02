<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Meal from '@/Components/Meal.vue';
import { useForm, Head } from '@inertiajs/vue3';

defineProps(['meals']);

const form = useForm({
    message: '',
});
</script>

<template>
    <Head title="Meals" />

    <AuthenticatedLayout>
        <div class="overflow-hidden bg-white shadow sm:rounded-md">
            <ul role="list" class="divide-y divide-gray-200">
                <Meal v-for="meal in meals" :key="meal.id" :meal="meal"></Meal>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>
