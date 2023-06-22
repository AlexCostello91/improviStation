<script setup>
import { usePage } from '@inertiajs/vue3';
import PaginationPane from "./PaginationPane.vue";
import dayjs from "dayjs";
import { capitalizeFirstLetter } from '@/Composables/formatHelper.js';
import { convertFromUtc } from '@/Composables/convertFromUtc.js';
const user = usePage().props.auth.user;

let props = defineProps(['workouts']);
</script>
<template>
    <div class="px-4 sm:px-6 lg:p-8 bg-white rounded">
        <!-- <div class="sm:flex sm:items-center float-right">
            <div class="mt-4 sm:ml-16 sm:flex-none lg:mt-0">
                <Link :href="route('meals.create')"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Add Meal</Link>
            </div>
        </div> -->
        <div class="-mx-4 mt-8 sm:-mx-0">
            <table class="min-w-full divide-y divide-gray-300">
                <thead>
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name
                        </th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">Duration (mins)</th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">Perceived Intensity</th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">Started At
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Calories Burned</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <tr v-for="workout in workouts.data" :key="workout.id">
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ capitalizeFirstLetter(workout.name)
                        }}</td>
                        <td class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 sm:table-cell">{{
                            workout.duration }}</td>
                        <td class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell">{{ workout.intensity
                        }}</td>
                        <td class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell">{{
                            convertFromUtc(workout.started_at, user.timezone, 'h:m A ddd, MMM D YYYY') }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ workout.calories }}</td>

                    </tr>
                </tbody>
            </table>
            <div>
                <PaginationPane :links="workouts.links" :pageSize="workouts.per_page" />
            </div>
        </div>
    </div>
</template>
