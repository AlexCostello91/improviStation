<template>
    <div class="max-w-4xl mx-auto p-4 mt-4 overflow-hidden bg-white shadow sm:rounded-md">
        <ul role="list" class="divide-y divide-gray-200">
            <MealItemListItem v-for="item in meal.items" :key="item.id" :meal_item="item"></MealItemListItem>
        </ul>
    </div>
</template>
<script setup>
import MealItemListItem from "@/Components/MealItemListItem.vue";
defineProps(['meal']);
</script>
