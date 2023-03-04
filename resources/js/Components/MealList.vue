<script setup>
import MealListItem from "@/Components/MealListItem.vue";
defineProps(['meals']);
</script>
<template>
    <div class="container mx-auto">
        <div
            class="block mt-6 max-w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h1 class="p-3 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Meals</h1>
            <div class="max-w-full mx-auto p-4 overflow-hidden bg-white shadow rounded-b-md">
                <ul role="list" class="divide-y divide-gray-200">
                    <MealListItem v-for="meal in meals" :key="meal.id" :meal="meal"></MealListItem>
                </ul>
            </div>
        </div>
    </div>
</template>
