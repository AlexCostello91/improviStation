<script setup>
import MealItemListItem from "@/Components/MealItemListItem.vue";
defineProps(['meal']);
</script>
<template>
    <div class="mx-auto p-4 overflow-hidden bg-white shadow rounded-b-md">
        <ul role="list" class="divide-y divide-gray-200">
            <MealItemListItem v-for="item in meal.meal_items" :key="item.id" :meal_item="item"></MealItemListItem>
        </ul>
    </div>
</template>
