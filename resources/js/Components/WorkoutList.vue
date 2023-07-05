<script setup>
import { usePage, Link } from '@inertiajs/vue3';
import PaginationPane from "./PaginationPane.vue";
import { capitalizeFirstLetter } from '@/Composables/formatHelper.js';
import { convertFromUtc } from '@/Composables/convertFromUtc.js';
const user = usePage().props.auth.user;

let props = defineProps(['workouts']);

</script>
<template>
    <div class="p-4 sm:p-6 lg:p-8 bg-white xl:rounded-lg">
        <div class="flex justify-between sm:justify-end items-center pb-4 sm:px-0">
            <div class="flex sm:hidden">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Workouts</h2>
            </div>
            <div class="flex">
                <Link :href="route('workouts.create')"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Add Workout</Link>
            </div>
        </div>
        <div class="">
            <table class="min-w-full divide-y divide-gray-300 table-fixed sm:table-auto">
                <thead>
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name
                        </th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">Duration
                            (mins)</th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">Perceived
                            Intensity</th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">Started
                            At
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Calories Burned
                        </th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                            <span class="sr-only">View</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <tr v-for="workout in workouts.data" :key="workout.id">
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0 truncate w-100 max-w-[12rem]">{{
                            capitalizeFirstLetter(workout.name)
                        }}</td>
                        <td class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 sm:table-cell">{{
                            workout.duration }}</td>
                        <td class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell">{{
                            workout.intensity
                        }}</td>
                        <td class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell">{{
                            convertFromUtc(workout.started_at, user.timezone, 'h:mm A ddd, MMM D YYYY') }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ workout.calories }}</td>
                        <td class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                            <Link :href="route('workouts.show', workout.id)" class="text-indigo-600 hover:text-indigo-900">
                            View<span class="sr-only">, {{ workout.name }}</span></Link>
                        </td>

                    </tr>
                </tbody>
            </table>
            <div>
                <PaginationPane :links="workouts.links" :pageSize="workouts.per_page" :current_page="workouts.current_page" :total_pages="workouts.last_page"/>
            </div>
        </div>
    </div>
</template>
