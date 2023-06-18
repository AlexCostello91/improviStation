
<script setup>
import { ref, watch } from 'vue';
import axios from 'axios';
import { debounce } from 'lodash';
import { ContentLoader } from 'vue-content-loader';
import { ArrowLongLeftIcon, ArrowLongRightIcon } from '@heroicons/vue/20/solid';
import { isInteger } from '@/Composables/formatHelper.js';

const searchTerm = ref('');
const searchResults = ref([]);
const isLoading = ref(false);
const page = ref(1);
const search = debounce(async () => {
    try {
        isLoading.value = true;
        const response = await axios.get('/meal-items/search', { params: { q: searchTerm.value, page: page.value } });
        searchResults.value = response.data;
        page.value = response.data.current_page;
    } catch (error) {
        console.error(error);
    } finally {
        isLoading.value = false;
    }
}, 1000);

function getMacro(meal_item, macroName) {
    let val = 0;
    meal_item.macros.forEach(macro => {
        if (macro.name == macroName) {
            val = macro.value;
        }
    });
    return val;
}

const updateResultPage = (newPage) => {
    if(isInteger(newPage)){
        page.value = MAth.max(Number(newPage),1);
    } else if (page.value > 0 && newPage.startsWith('N')){
        page.value+=1;
    } else if (page.value > 0 && newPage.startsWith('P')){
        page.value-=1;
    }

    search();
}

watch(searchTerm, () => {
    isLoading.value = true; // Set isLoading to true immediately when the user types
});

</script>
<template>
    <div class="min-h-[420px]">
        <div class="relative mt-2 flex items-center sm:px-4 py-2 sm:col-span-2">
            <input type="text" v-model="searchTerm" @input="search" placeholder="Search for meal items..." name="search"
                id="search"
                class="block w-full rounded-md border-0 py-4 pr-14 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
        </div>
        <ContentLoader v-if="isLoading" viewBox="0 0 400 344" :speed="1" primaryColor="#c7d2fe" secondaryColor="#f3f4f6">
            <rect x="3%" y="0" rx="5" ry="5" width="94%" height="20" />
            <rect x="3%" y="30" rx="5" ry="5" width="94%" height="20" />
            <rect x="3%" y="60" rx="5" ry="5" width="94%" height="20" />
            <rect x="3%" y="90" rx="5" ry="5" width="94%" height="20" />
            <rect x="3%" y="120" rx="5" ry="5" width="94%" height="20" />
            <rect x="3%" y="150" rx="5" ry="5" width="94%" height="20" />
            <rect x="3%" y="180" rx="5" ry="5" width="94%" height="20" />
            <rect x="3%" y="210" rx="5" ry="5" width="94%" height="20" />
        </ContentLoader>
        <ul v-if="!isLoading" class="px-4 text-center min-h-[360px] divide-y divide-solid divide-gray-300 ">
            <li v-if="!isLoading && searchResults.data && searchResults.data.length > 0"
                v-for="meal_item in searchResults.data"
                class="grid grid-cols-3 p-2 hover:bg-indigo-100 align-middle hover:rounded-md ">
                <div class="flex items-center justify-center">{{ meal_item.name }}</div>
                <div class="flex items-center justify-center">{{ getMacro(meal_item, 'calories') }} Calories</div>
                <div class="flex items-center justify-center"><button class="p-2 bg-indigo-400 rounded-sm"
                        @click.prevent="$emit('addMealItem', meal_item)">Add</button></div>

            </li>
            <li v-if="searchResults.data && searchResults.data.length == 0"
                class="grid grid-cols-1 p-2 rounded-md align-middle bg-red-100">
                <div class="flex items-center justify-center">Sorry, no results for '{{ searchTerm }}'</div>
            </li>
        </ul>
        <!--Result Navigation-->
        <div v-if="searchResults.links">
            <nav class="flex items-center justify-between border-t border-gray-200 px-4">
                <div v-if="searchResults.links.slice(0, 1).pop().url" class="-mt-px flex flex-1">
                    <a @click="updateResultPage(searchResults.links.slice(0, 1).pop().label)"
                        class="inline-flex items-center border-t-2 border-transparent p-2 text-base font-medium text-gray-500 hover:border-indigo-500 hover:text-indigo-600 group">
                        <ArrowLongLeftIcon class="mr-3 h-5 w-5 text-gray-400 group-hover:text-indigo-600"
                            aria-hidden="true" />
                        Previous
                    </a>
                </div>
                <!-- disabled previous link -->
                <div v-else class="-mt-px flex flex-1">
                    <div
                        class="inline-flex items-center border-t-2 border-transparent p-2 text-base font-medium text-gray-500">
                        <ArrowLongLeftIcon class="mr-3 h-5 w-5 text-gray-400" aria-hidden="true" />
                        Previous
                    </div>
                </div>
                <div class="hidden md:mx-auto md:flex">
                    <a v-for="link in searchResults.links.slice(1, -1)" @click="updateResultPage(link.label)" :class="{
                        'inline-flex text-base items-center border-t-2 p-2 text-gray-500 hover:text-gray-700 hover:border-gray-300': true,
                        'border-indigo-500 text-indigo-600': link.active,
                        'border-transparent hover:border-indigo-500 hover:text-indigo-600': !link.active
                    }"> {{ link.label }} </a>
                </div>
                <div v-if="searchResults.links.slice(-1).pop().url" class="-mt-px flex flex-1 justify-end">
                    <a @click="updateResultPage(searchResults.links.slice(-1).pop().label)"
                        class="inline-flex items-center border-t-2 border-transparent p-2 text-base font-medium text-gray-500 hover:border-indigo-500 hover:text-indigo-600 group">
                        Next
                        <ArrowLongRightIcon class="ml-3 h-5 w-5 text-gray-400 group-hover:text-indigo-600"
                            aria-hidden="true" />
                    </a>
                </div>
                <!-- disabled next link -->
                <div v-else class="-mt-px flex flex-1">
                    <div
                        class="inline-flex items-center border-t-2 border-transparent p-2 text-base font-medium text-gray-500">
                        Next
                        <ArrowLongRightIcon class="ml-3 h-5 w-5 text-gray-400" aria-hidden="true" />
                    </div>
                </div>
            </nav>
        </div>
    </div>
</template>
