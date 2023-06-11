<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import MacroList from './MacroList.vue';
import dayjs from 'dayjs';
import {capitalizeFirstLetter} from '@/Composables/formatHelper.js';
const props = defineProps(['meal']);
const toggleDropdown = (itemId) => {
    isOpen.value[itemId] = !isOpen.value[itemId];
};

const isOpen = ref({});

</script>
<template>
    <div class="bg-white rounded p-2">
        <div class="p-4">
            <h3 class="text-base font-semibold leading-7 text-gray-900">{{ meal.name }}</h3>
        </div>
        <div class="">
            <dl class="grid grid-cols-1 sm:grid-cols-2 px-4 pb-4">
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Created By</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ meal.user.name }}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Type</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ capitalizeFirstLetter(meal.type) }}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Consumed at</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ dayjs(meal.created_at).format("h:m A ddd, " +
                        "MMM D YYYY") }}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Visibility</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ meal.public ? 'Public' : 'Private' }}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-2 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">About</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ meal.desc }}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-2 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Items</dt>
                    <dd class="text-sm text-gray-900">
                        <dl class="grid grid-cols-1 sm:grid-cols-2 pb-4">
                            <div class="border-gray-100 px-4 py-2 sm:col-span-2 sm:px-0">
                                <dd class="mt-2 text-sm text-gray-900">
                                    <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                                        <template v-for="meal_item in meal.meal_items" :key="meal_item.id">
                                            <li
                                                :class="[
                                                    isOpen[meal_item.id] ? 'bg-indigo-600 text-white text-semibold': '',
                                                    'relative flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6'
                                                    ]">
                                                <div class="flex w-0 flex-1 items-center">
                                                    <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                                        <span :class="[
                                                            isOpen[meal_item.id] ? 'font-bold': 'font-semibold',
                                                            'truncate'
                                                        ]">{{ meal_item.name }}</span>
                                                    </div>
                                                    <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                                        <span :class="[
                                                            isOpen[meal_item.id] ? 'font-bold': 'font-semibold',
                                                            'truncate'
                                                        ]"> x {{ meal_item.quantity
                                                        }}</span>
                                                    </div>
                                                </div>
                                                <div class="ml-4 flex-shrink-0">
                                                    <a :class="[
                                                    isOpen[meal_item.id] ? 'font-bold text-white': 'font-semilbold text-indigo-600 hover:text-indigo-500',
                                                    'hover:underline cursor-pointer'
                                                    ]"
                                                        @click="toggleDropdown(meal_item.id)">View</a>
                                                </div>
                                            </li>
                                            <li v-if="isOpen[meal_item.id]" :key="`dropdown-${meal_item.id}`"
                                                class="py-4 px-8 bg-indigo-100">
                                                <p class="p-2">{{ meal_item.desc }}</p>
                                                    <MacroList :macros="meal_item.macros" :quantity="meal_item.quantity"/>
                                            </li>
                                        </template>
                                    </ul>
                                </dd>
                            </div>
                        </dl>
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
