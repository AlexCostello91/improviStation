<script setup>
import MacroList from './MacroList.vue';
import dayjs from 'dayjs';
import {capitalizeFirstLetter} from '@/Composables/formatHelper.js';
import MealItemList from './MealItemList.vue';
const props = defineProps(['meal']);

</script>
<template>
    <div class="bg-white rounded px-4">
        <div class="">
            <dl class="grid grid-cols-1 sm:grid-cols-2 px-4 pb-4">
                <div class="border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Created By</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ meal.user.name }}</dd>
                </div>
                <div class="border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Type</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ capitalizeFirstLetter(meal.type) }}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Consumed at</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ dayjs(meal.consumed_at).format("h:m A ddd, " +
                        "MMM D YYYY") }}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Visibility</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ meal.public ? 'Public' : 'Private' }}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-2 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Description</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ meal.desc }}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-2 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Items</dt>
                    <dd class="text-sm text-gray-900">
                        <MealItemList :meal_items="meal.meal_items" />
                    </dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-2 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Nutrition Summary</dt>
                    <MacroList :macros="meal.macroSummary" :quantity="1"/>
                </div>
            </dl>
        </div>
    </div>
</template>
