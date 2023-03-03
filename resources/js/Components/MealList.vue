<template>
    <div class="max-w-4xl mx-auto p-4 mt-4 overflow-hidden bg-white shadow sm:rounded-md">
        <ul role="list" class="divide-y divide-gray-200">
            <MealListItem v-for="meal in meals" :key="meal.id" :meal="meal"></MealListItem>
        </ul>
    </div>
</template>
<script setup>
import MealListItem from "@/Components/MealListItem.vue";
defineProps(['meals']);
</script>
