<script setup>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { Link } from '@inertiajs/vue3';
import { CheckCircleIcon, ChevronRightIcon, EnvelopeIcon } from '@heroicons/vue/20/solid'


const props = defineProps(['meal_item']);
dayjs.extend(relativeTime);

</script>
<template>
    <Link :href="route('mealItems.show', meal_item.id)">
    <li>
        <a class="block hover:bg-gray-50">
            <div class="flex items-center px-4 py-4 sm:px-6">
                <div class="flex min-w-0 flex-1 items-center">
                    <div class="min-w-0 flex-1 px-4 md:grid md:gap-4">
                        <div>
                            <p class="truncate font-medium text-indigo-600">{{ meal_item.name }} <span
                                    class="text-black">x</span> {{ meal_item.quantity }}</p>
                            <p class="text-sm text-gray-900">
                                <time :datetime="meal_item.created_at">{{ dayjs(meal_item.created_at).fromNow() }}</time>
                            </p>
                        </div>
                        <div class="flex items-end">
                            <ChevronRightIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                        </div>
                    </div>
                </div>
            </div>
        </a>

    </li>
    </Link>
</template>
