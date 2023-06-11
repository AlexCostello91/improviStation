<script setup>
import { ArrowLongLeftIcon, ArrowLongRightIcon } from '@heroicons/vue/20/solid';
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import PaginationPageSizeSelect from './PaginationPageSizeSelect.vue';


const props = defineProps(['links', 'pageSizeOptions','pageSize']);
let pageSize = ref(props.pageSize);

let pageSizeOptions = [
    {id:5, name:"5"},
    {id:10, name:"10"},
    {id:15, name:"15"},
    {id:20, name:"20"},
    {id:25, name:"25"},
    {id:50, name:"50"}
];

function pageSizeUpdated(option){
    router.reload({
        data:{
            page_size:option.id
        }
    });
}
</script>
<template>
        <nav class="flex items-center justify-between border-t border-gray-200 px-4 w-1/2 sm:px-0">
            <div class="-mt-px flex flex-1">
                <Link :href="links.slice(0, 1).pop().url?links.slice(0, 1).pop().url:'null'"
                    class="inline-flex items-center border-t-2 border-transparent p-2 text-base font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                <ArrowLongLeftIcon class="mr-3 h-5 w-5 text-gray-400" aria-hidden="true" />
                Previous
                </Link>
            </div>
            <div class="hidden md:mx-auto md:flex">
                <Link v-for="link in links.slice(1, -1)" :class="{
                    'inline-flex text-base items-center border-t-2 p-2 text-gray-500 hover:text-gray-700 hover:border-gray-300': 1,
                    'border-indigo-500 text-indigo-600': link.active,
                    'border-transparent': !link.active
                }" :href="link.url?link.url:'null'"> {{ link.label }} </Link>
            </div>
            <div class="-mt-px flex flex-1 justify-end">
                <Link :href="links.slice(-1).pop().url?links.slice(-1).pop().url:'null'"
                    class="inline-flex items-center border-t-2 border-transparent p-2 text-base font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                Next
                <ArrowLongRightIcon class="ml-3 h-5 w-5 text-gray-400" aria-hidden="true" />
                </Link>
            </div>
        </nav>
        <PaginationPageSizeSelect class="ml-8" @pageSizeChange="pageSizeUpdated" label="Page Size:" :options="pageSizeOptions" :pageSize="pageSize"></PaginationPageSizeSelect>

</template>
