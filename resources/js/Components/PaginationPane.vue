<script setup>
import { ArrowLongLeftIcon, ArrowLongRightIcon } from '@heroicons/vue/20/solid';
import { Link } from '@inertiajs/vue3';

defineProps(['links']);
</script>
<template>
    <nav class="flex items-center justify-between border-t border-gray-200 px-4 sm:px-0">
        <div class="-mt-px flex flex-1">
            <Link :href="links.slice(0, 1).pop().url"
                class="inline-flex items-center border-t-2 border-transparent p-2 text-base font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
            <ArrowLongLeftIcon class="mr-3 h-5 w-5 text-gray-400" aria-hidden="true" />
            Previous
            </Link>
        </div>
        <div class="hidden md:mx-auto md:flex">
            <Link v-for="link in links.slice(1, -1)" :class="{
                'inline-flex text-base items-center border-t-2 border-transparent p-2 text-gray-500 hover:text-gray-700 hover:border-gray-300': 1,
                'border-indigo-500 text-indigo-600': link.active
            }" :href="link.url"> {{ link.label }} </Link>
        </div>
        <div class="-mt-px flex flex-1 justify-end">
            <Link :href="links.slice(-1).pop().url"
                class="inline-flex items-center border-t-2 border-transparent p-2 text-base font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
            Next
            <ArrowLongRightIcon class="ml-3 h-5 w-5 text-gray-400" aria-hidden="true" />
            </Link>
        </div>
    </nav>
</template>
