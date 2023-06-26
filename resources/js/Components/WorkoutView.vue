<script setup>
import { usePage } from '@inertiajs/vue3';
import { capitalizeFirstLetter } from '@/Composables/formatHelper.js';
import CancelButton from '@/Components/CancelButton.vue';
import PrimaryButtonLink from '@/Components/PrimaryButtonLink.vue';
import { convertFromUtc } from '@/Composables/convertFromUtc.js';
const user = usePage().props.auth.user;

defineProps(['workout']);
</script>
<template>
    <div>
        <div class="bg-white px-4">
            <div class="flex justify-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight py-4 px-4 sm:px-0 break-all">{{ workout.name }}
                </h2>
            </div>
            <div class="flex justify-center">
                <dl class="grid grid-cols-1 sm:grid-cols-2">
                    <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                        <dt class="text-sm font-semibold leading-6 text-gray-900">Duration</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ workout.duration }} minutes</dd>
                    </div>
                    <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                        <dt class="text-sm font-semibold leading-6 text-gray-900">Perceived Intensity</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><span v-if="workout.intensity > 0">{{
                            workout.intensity }} / 10</span></dd>
                    </div>
                    <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                        <dt class="text-sm font-semibold leading-6 text-gray-900">Calories Burned</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><span v-if="workout.calories > 0">{{
                            workout.calories }}</span><span v-else>0</span></dd>
                    </div>
                    <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                        <dt class="text-sm font-semibold leading-6 text-gray-900">Started At</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ convertFromUtc(workout.started_at,
                            user.timezone, "h:mm A ddd, MMM D YYYY") }}</dd>
                    </div>
                    <div class="border-t border-gray-100 px-4 py-6 sm:col-span-2 sm:px-0">
                        <dt class="text-sm font-semibold leading-6 text-gray-900">Description</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ workout.desc }}</dd>
                    </div>
                    <div class="flex justify-start border-t border-gray-100 px-4 py-6 sm:col-span-2 sm:px-0">
                        <div class="flex justify-between gap-x-4">
                            <CancelButton :href="route('workouts.index')">Back</CancelButton>
                            <PrimaryButtonLink :href="route('workouts.create', { copy_id: workout.id })">Copy to New Workout
                            </PrimaryButtonLink>
                        </div>

                    </div>
                </dl>
            </div>
        </div>
    </div>
</template>
