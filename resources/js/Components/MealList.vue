<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';
import PaginationPane from "./PaginationPane.vue";
import { Switch } from '@headlessui/vue'
import { capitalizeFirstLetter } from '@/Composables/formatHelper.js';
import { convertFromUtc } from '@/Composables/convertFromUtc.js';
import { ref } from 'vue';
const user = usePage().props.auth.user;
let props = defineProps({
    meals: {
        type: Object,
        default: {}
    },
    showAllMeals: {
        type: Boolean,
        default: false
    }
});

function getCalories(meal) {
    let calories = 0;
    meal.macroSummary.forEach(macro => {
        if (macro.name == "calories") {
            calories = macro.value;
        }
    });
    return calories;
};
const showAllMeals = ref(props.showAllMeals);

function toggleShowAll() {
    router.reload({
        data: {
            show_all: !showAllMeals.value,
        }
    });
}

</script>
<template>
    <div class="px-4 sm:px-6 lg:p-8 bg-white">

        <div class="flex py-4 justify-between items-center sm:justify-end">
            <div class="flex sm:hidden">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Meals</h2>
            </div>

            <div class="flex">
                <Link :href="route('meals.create')"
                    class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Add Meal</Link>
            </div>
        </div>
        <div class="flex py-2 justify-center">
            <div class="px-2"><span>My Meals</span></div>
            <Switch v-model="showAllMeals" @click="toggleShowAll"
                :class="[showAllMeals ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                <span class="sr-only">Show All Meals</span>
                <span aria-hidden="true"
                    :class="[showAllMeals ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
            </Switch>
            <div class="px-2"><span>All Meals</span></div>
        </div>
        <div class="mt-2">
            <table class="min-w-full divide-y divide-gray-300 table-fixed sm:table-auto">
                <thead>
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name
                        </th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">Type</th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">User</th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">Consumed
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Calories</th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                            <span class="sr-only">View</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <tr v-for="(meal, index) in meals.data" :key="meal.id">
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0 truncate w-100 max-w-[12rem]" >{{ meal.name
                        }}</td>
                        <td class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 sm:table-cell">{{
                            capitalizeFirstLetter(meal.type) }}</td>
                        <td class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell">{{ meal.user.name
                        }}</td>
                        <td class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell">{{
                            convertFromUtc(meal.consumed_at, user.timezone, 'h:mm A ddd, MMM D YYYY') }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ getCalories(meal) }}</td>
                        <td class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                            <Link :href="route('meals.show', meal.id)" class="text-indigo-600 hover:text-indigo-900">
                            View<span class="sr-only">, {{ meal.name }}</span></Link>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <PaginationPane :links="meals.links" :pageSize="meals.per_page" />
            </div>
        </div>
    </div>
</template>
