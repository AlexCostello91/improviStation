<script setup>
import MacroList from './MacroList.vue';
import { usePage } from '@inertiajs/vue3';
import { capitalizeFirstLetter } from '@/Composables/formatHelper.js';
import { convertFromUtc } from '@/Composables/convertFromUtc.js';
import MealItemList from './MealItemList.vue';
import {computeMealMacroSummary} from '@/Composables/computeMealMacroSumary.js';
const props = defineProps(['meal','macroList']);
const user = usePage().props.auth.user;


</script>
<template>
    <div class="bg-white ">
        <div class="flex justify-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight p-4 sm:p-8 break-all">{{ meal.name }}</h2>
        </div>
        <div class="px-4 sm:px-8">
            <dl class="grid grid-cols-1 sm:grid-cols-2 pb-4">
                <div class="border-t border-gray-100 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-semibold leading-6 text-gray-900">Created By</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ user.name }}</dd>
                </div>
                <div class="border-t border-gray-100 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-semibold leading-6 text-gray-900">Type</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ capitalizeFirstLetter(meal.type) }}</dd>
                </div>
                <div class="border-t border-gray-100 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-semibold leading-6 text-gray-900">Consumed at</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{
                        convertFromUtc(meal.consumed_at, user.timezone, "h:mm A ddd, MMM D YYYY") }}</dd>
                </div>
                <div class="border-t border-gray-100 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-semibold leading-6 text-gray-900">Visibility</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ meal.public ? 'Public' : 'Private' }}</dd>
                </div>
                <div class="border-t border-gray-100 py-6 sm:col-span-2 sm:px-0">
                    <dt class="text-sm font-semibold leading-6 text-gray-900">Description</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ meal.desc }}</dd>
                </div>
                <div class="border-t border-gray-100 py-6 sm:col-span-2 sm:px-0">
                    <dt class="text-sm font-semibold leading-6 text-gray-900">Items</dt>
                    <dd class="text-sm text-gray-900">
                        <MealItemList :meal_items="meal.meal_items" />
                    </dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-2 sm:px-0">
                    <dt class="text-sm font-semibold leading-6 text-gray-900">Nutrition Summary</dt>
                    <MacroList :macros="meal.macroSummary?meal.macroSummary:computeMealMacroSummary(meal)" :quantity="1" />
                </div>
            </dl>
        </div>
    </div>
</template>
