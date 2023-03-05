<script setup>
import MealItemList from '@/Components/MealItemList.vue';
import { Link } from '@inertiajs/vue3';

defineProps(['meal']);
</script>
<template>
    <div class="container mx-auto">
        <div
            class="block mt-6 max-w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h1 class="p-3 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                <Link :href="route('meals.index')" class="hover:underline">
                Meals
                </Link><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 ml-2 mb-1 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
                {{ meal.name }}
            </h1>

            <MealItemList :meal="meal" />
        </div>
    </div>
</template>
