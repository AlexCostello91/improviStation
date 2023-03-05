<script setup>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { CheckCircleIcon, ChevronRightIcon, EnvelopeIcon } from '@heroicons/vue/20/solid'

const props = defineProps(['macro']);
dayjs.extend(relativeTime);

</script>
<template>
    <li>
        <a class="block hover:bg-gray-50">
            <div class="flex items-center px-4 py-4 sm:px-6">
                <div class="flex min-w-0 flex-1 items-center">
                    <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-3 md:gap-4">
                        <div>
                            <p class="truncate text-sm font-medium text-indigo-600">{{ macro.name }}</p>
                            <p class="mt-2 flex items-center text-sm text-gray-500">
                                <!-- <span class="truncate">{{ macro. }}</span> -->
                            </p>
                        </div>
                        <div class="flex">
                            <p class="flex items-center text-sm text-gray-500">
                                <CheckCircleIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-green-400" aria-hidden="true" />
                                {{ macro.value }}<span v-if="macro.name!='calories'" class="ml-1">{{ macro.display_unit }}</span>
                            </p>
                        </div>
                        <div class="hidden md:flex">
                            <p class="flex text-sm items-center text-gray-900">
                                <span class="mr-1">Consumed</span>
                                <time :datetime="macro.created_at">{{ dayjs(macro.created_at).fromNow() }}</time>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </li>
</template>
