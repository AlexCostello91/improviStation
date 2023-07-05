<script setup>
import { ArrowLongLeftIcon, ArrowLongRightIcon } from '@heroicons/vue/20/solid';
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import PaginationPageSizeSelect from './PaginationPageSizeSelect.vue';



const props = defineProps({
    links: {
        type: Array,
        default: []
    },
    current_page: {
        type: Number
    },
    total_pages: {
        type: Number
    },
    pageSizeOptions: {
        type: Array,
        default: [
            { id: 5, name: "5" },
            { id: 10, name: "10" },
            { id: 15, name: "15" },
            { id: 20, name: "20" },
            { id: 25, name: "25" },
            { id: 50, name: "50" }
        ]
    },
    pageSize: {
        type: Number,
        default: ref(10)
    }
});

function pageSizeUpdated(option) {
    router.reload({
        data: {
            page_size: option.id,
            page: 1
        }
    });
}
</script>
<template>
    <div>
        <nav class="flex items-center justify-between border-t border-gray-200">
            <div v-if="links.slice(0, 1).pop().url" class="-mt-px flex flex-1">
                <Link :href="links.slice(0, 1).pop().url ? links.slice(0, 1).pop().url : 'null'"
                    class="text-indigo-600 inline-flex items-center border-t-2 border-transparent p-2 text-base font-medium md:text-gray-500 md:hover:border-indigo-500 md:hover:text-indigo-600 group">
                <ArrowLongLeftIcon class="text-indigo-600 mr-3 h-5 w-5 md:text-gray-400 md:group-hover:text-indigo-600" aria-hidden="true" />
                Previous
                </Link>
            </div>
            <!-- disabled previous link -->
            <div v-else class="-mt-px flex flex-1">
                <div class="inline-flex items-center border-t-2 border-transparent p-2 text-base font-medium text-gray-500">
                    <ArrowLongLeftIcon class="mr-3 h-5 w-5 text-gray-400" aria-hidden="true" />
                    Previous
                </div>
            </div>
            <div class="hidden md:mx-auto md:flex">
                <Link v-for="link in links.slice(1, -1)" active="false" :class="{
                    'inline-flex text-base items-center border-t-2 p-2 text-gray-500 hover:text-gray-700 hover:border-gray-300': true,
                    'border-indigo-500 text-indigo-600': link.active,
                    'border-transparent hover:border-indigo-500 hover:text-indigo-600': !link.active
                }" :href="link.url ? link.url : 'null'"> {{ link.label }} </Link>
            </div>
            <div class="flex mx-auto md:hidden"><span class="text-gray-500">Page {{ current_page }}/{{ total_pages }}</span></div>
            <div v-if="links.slice(-1).pop().url" class="-mt-px flex flex-1 justify-end">
                <Link :href="links.slice(-1).pop().url ? links.slice(-1).pop().url : 'null'"
                    class="text-indigo-600 inline-flex items-center border-t-2 border-transparent p-2 text-base font-medium md:text-gray-500 md:hover:border-indigo-500 md:hover:text-indigo-600 group">
                Next
                <ArrowLongRightIcon class="text-indigo-600 ml-3 h-5 w-5 md:text-gray-400 md:group-hover:text-indigo-600" aria-hidden="true" />
                </Link>
            </div>
            <!-- disabled next link -->
            <div v-else class="-mt-px flex flex-1 justify-end">
                <div class="inline-flex items-center border-t-2 border-transparent p-2 text-base font-medium text-gray-500">
                    Next
                    <ArrowLongRightIcon class="ml-3 h-5 w-5 text-gray-400" aria-hidden="true" />
                </div>
            </div>
        </nav>
    </div>
    <div class="flex justify-center">
        <PaginationPageSizeSelect @pageSizeChange="pageSizeUpdated" label="Per Page:" :options="pageSizeOptions"
            :pageSize="pageSize"></PaginationPageSizeSelect>

    </div>
</template>
