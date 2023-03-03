<script setup>
import MealItemList from '@/Components/MealItemList.vue';

defineProps(['meal']);
</script>
<template>
    <div class="container mx-auto max-w-4xl">
        <h1>{{ meal.name }}</h1>
        <MealItemList :meal="meal"/>
    </div>
</template>
