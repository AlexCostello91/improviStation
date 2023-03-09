<script setup>
import MealItemListItem from "@/Components/MealItemListItem.vue";
import { propsToAttrMap } from "@vue/shared";
import { computed } from 'vue';

const props = defineProps(['meal']);

const totalCalories = computed(() => {
    let totalCalories = 0;
    props.meal.meal_items.forEach(meal_item => {
        meal_item.macros.forEach(macro => {
            if (macro.name === 'calories') {
                totalCalories += (macro.value * meal_item.quantity);
            }
        });
    });
    return totalCalories;
})
</script>
<template>
    <div class="mx-auto px-4 overflow-hidden bg-white shadow rounded-b-md">
        <ul role="list" class="divide-y divide-gray-200">
            <MealItemListItem v-for="item in props.meal.meal_items" :key="item.id" :meal_item="item"></MealItemListItem>
            <li>
                <div class="flex items-center px-4 py-4 px-6">
                    <div class="flex min-w-0 flex-1 items-center">
                        <div class="min-w-0 flex-1 px-4 grid grid-cols-2 gap-4">
                            <div class="flex items-center">
                                {{ 'Total Calories:' }}
                            </div>
                            <div class="flex items-center justify-center">
                                {{ totalCalories }} Calories
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>
