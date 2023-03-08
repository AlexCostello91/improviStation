<script setup>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';

const props = defineProps(['workout']);
dayjs.extend(relativeTime);

</script>
<template>
    <li>
        <div class="flex items-center px-4 py-4 sm:px-6">
            <div class="flex min-w-0 flex-1 items-center">
                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-4 md:gap-4">
                    <div>
                        <p class="truncate text-sm font-medium text-indigo-600">{{ workout.name }}</p>
                        <p class="mt-2 flex items-center text-sm text-gray-500">
                            <span class="truncate">{{ workout.user.name }}</span>
                        </p>
                    </div>
                    <div class="flex">
                        <p class="flex items-center text-sm text-gray-500">
                            <label class="mr-2 font-bold">Duration:</label>
                            {{ workout.duration }}
                        </p>
                    </div>
                    <div class="flex">
                        <p class="flex items-center text-sm text-gray-500">
                            <label class="mr-2 font-bold">Intensity:</label>
                            {{ workout.intensity }}
                        </p>
                    </div>
                    <div class="hidden md:flex">
                        <p class="flex text-sm items-center text-gray-900">
                            <time :datetime="workout.created_at">{{ dayjs(workout.created_at).fromNow() }}</time>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </li>
</template>
