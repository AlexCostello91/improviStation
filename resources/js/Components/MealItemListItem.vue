<script setup>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import {computed} from 'vue';
import { Link } from '@inertiajs/vue3';


const props = defineProps(['meal_item']);
dayjs.extend(relativeTime);
const totalCalories = computed(()=>{
    return props.meal_item.macros.find(macro => macro.name === 'calories').value * props.meal_item.quantity;
})
</script>
<template>
    <Link :href="route('mealItems.show', meal_item.id)">
    <li>
        <a class="block hover:bg-gray-50">
            <div class="flex items-center px-4 py-4 sm:px-6">
                <div class="flex min-w-0 flex-1 items-center">
                    <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                        <div>
                            <p class="truncate font-medium text-indigo-600">{{ meal_item.name }} <span
                                    class="text-black">x</span> {{ meal_item.quantity }}</p>
                            <p class="text-sm text-gray-900">
                                <time :datetime="meal_item.created_at">{{ dayjs(meal_item.created_at).fromNow() }}</time>
                            </p>
                        </div>
                        <div class="flex items-center justify-center">
                            {{ totalCalories }} Calories
                        </div>
                    </div>
                </div>
            </div>
        </a>

    </li>
    </Link>
</template>
