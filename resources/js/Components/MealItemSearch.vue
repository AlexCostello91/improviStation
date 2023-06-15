
<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { debounce } from 'lodash';
import { ContentLoader } from 'vue-content-loader';

const searchTerm = ref('');
const searchResults = ref([]);
const isLoading = ref(false);
const search = debounce(async () => {
    try {
        isLoading.value = true;
        const response = await axios.get('/meal-items/search', { params: { q: searchTerm.value } });
        searchResults.value = response.data;
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

</script>
<template>
    <div class="min-h-[420px]">
        <div class="relative mt-2 flex items-center sm:px-4 py-2 sm:col-span-2">
            <input type="text" v-model="searchTerm" @input="search" placeholder="Search for meal items..." name="search"
                id="search"
                class="block w-full rounded-md border-0 py-4 pr-14 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
        </div>
        <ContentLoader v-if="isLoading" viewBox="0 0 400 250" :speed="1" primaryColor="#c7d2fe" secondaryColor="#f3f4f6">
            <rect x="3%" y="0" rx="5" ry="5" width="94%" height="20" />
            <rect x="3%" y="30" rx="5" ry="5" width="94%" height="20" />
            <rect x="3%" y="60" rx="5" ry="5" width="94%" height="20" />
            <rect x="3%" y="90" rx="5" ry="5" width="94%" height="20" />
            <rect x="3%" y="120" rx="5" ry="5" width="94%" height="20" />
            <rect x="3%" y="150" rx="5" ry="5" width="94%" height="20" />
            <rect x="3%" y="180" rx="5" ry="5" width="94%" height="20" />
            <rect x="3%" y="210" rx="5" ry="5" width="94%" height="20" />
        </ContentLoader>
        <ul v-if="!isLoading" class="px-4 text-center min-h-[360px]">
            <li class="grid grid-cols-3 p-2 hover:bg-indigo-100 hover:rounded-md aligne-middle" v-if="!isLoading" v-for="meal_item in searchResults.data">
                <div class="flex items-center justify-center">{{ meal_item.name }}</div>
                <div class="flex items-center justify-center">{{ getMacro(meal_item, 'calories') }} Calories</div>
                <div class="flex items-center justify-center"><button class="p-2 bg-indigo-400 rounded-sm" @click.prevent="$emit('addMealItem',meal_item)">Add</button></div>

            </li>
        </ul>
    </div>
</template>
