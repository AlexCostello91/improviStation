<script setup>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { CheckCircleIcon, ChevronRightIcon, EnvelopeIcon } from '@heroicons/vue/20/solid'
import { Link } from '@inertiajs/vue3';

const props = defineProps(['meal']);
dayjs.extend(relativeTime);

</script>
<template>
    <Link :href="route('meals.show', meal.id)">
    <li>
        <a class="block hover:bg-gray-50">
            <div class="flex items-center px-4 py-4 sm:px-6">
                <div class="flex min-w-0 flex-1 items-center">
                    <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-3 md:gap-4">
                        <div>
                            <p class="truncate text-sm font-medium text-indigo-600">{{ meal.name }}</p>
                            <p class="mt-2 flex items-center text-sm text-gray-500">
                                <span class="truncate">{{ meal.user.name }}</span>
                            </p>
                        </div>
                        <div class="flex">
                            <p class="flex items-center text-sm text-gray-500">
                                <CheckCircleIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-green-400" aria-hidden="true" />
                                {{ meal.type }}
                            </p>
                        </div>
                        <div class="hidden md:flex">
                            <p class="flex text-sm items-center text-gray-900">
                                <span class="mr-1">Consumed</span>
                                <time :datetime="meal.created_at">{{ dayjs(meal.created_at).fromNow() }}</time>
                            </p>
                        </div>
                    </div>
                </div>
                <div>
                    <ChevronRightIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                </div>
            </div>
        </a>
    </li>
    </Link>
</template>
