<script setup>
import MealListItem from "@/Components/MealListItem.vue";
import MealToggle from "@/Components/MealToggle.vue"
import { useStorage } from "../Composables/useStorage.js";
import { computed, reactive } from 'vue';
import { usePage } from '@inertiajs/vue3';

let props = defineProps(['meals']);

let showAllMeals = useStorage('showAllMeals', false);

const filteredMeals = computed(()=>{
    if(!showAllMeals.value){
        return props.meals.filter(meal => meal.user_id == usePage().props.auth.user.id);
    } else {
        return props.meals;
    }
});

</script>
<template>
    <div class="container mx-auto">
        <div
            class="block mt-6 max-w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div>
                <h1 class="p-3 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Meals
                </h1>
                <MealToggle @showAllMeals="(newVal)=>{showAllMeals = newVal}" class="flex p-4 items-center items-end justify-center" :defaultState="showAllMeals">
                </MealToggle>
            </div>
            <div class="max-w-full mx-auto p-4 overflow-hidden bg-white shadow rounded-b-md">
                <ul role="list" class="divide-y divide-gray-200">
                    <MealListItem v-for="meal in filteredMeals" :key="meal.id" :meal="meal">
                    </MealListItem>
                </ul>
            </div>
        </div>
    </div>
</template>
