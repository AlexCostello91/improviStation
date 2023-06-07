<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { PaperClipIcon } from '@heroicons/vue/20/solid'
import dayjs from 'dayjs';
const props = defineProps(['meal']);

const originalType = ref(props.meal.type);
const capitalizedType = ref("");

const capitalizeFirstLetter = (str) => {
  return str.charAt(0).toUpperCase() + str.slice(1);
};

onMounted(() => {
  capitalizedType.value = capitalizeFirstLetter(originalType.value);
});

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
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ capitalizedType }}</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Consumed at</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ dayjs(meal.created_at).format('h:m A ddd, MMM D YYYY') }}</dd>
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
                    <dt class="text-sm font-medium leading-6 text-gray-900">Attachments</dt>
                    <dd class="mt-2 text-sm text-gray-900">
                        <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                            <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                <div class="flex w-0 flex-1 items-center">
                                    <PaperClipIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                                    <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                        <span class="truncate font-medium">resume_back_end_developer.pdf</span>
                                        <span class="flex-shrink-0 text-gray-400">2.4mb</span>
                                    </div>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                                </div>
                            </li>
                            <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                <div class="flex w-0 flex-1 items-center">
                                    <PaperClipIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                                    <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                        <span class="truncate font-medium">coverletter_back_end_developer.pdf</span>
                                        <span class="flex-shrink-0 text-gray-400">4.5mb</span>
                                    </div>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</template>
