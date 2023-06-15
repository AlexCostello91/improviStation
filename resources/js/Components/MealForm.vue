<script setup>
import { useForm } from '@inertiajs/vue3';
import { ExclamationCircleIcon } from '@heroicons/vue/20/solid'
import { Switch } from '@headlessui/vue'
import { ref } from 'vue';
import { DatePicker } from 'v-calendar';
import MealItemSearch from './MealItemSearch.vue';
import MealItemList from './MealItemList.vue';

import 'v-calendar/style.css';

const props = defineProps(['user_id']);
const form = useForm({
    name: null,
    desc: null,
    consumed_at: ref(new Date()),
    user_id: props.user_id,
    type: 'snack',
    public: ref(false)
});

const meal_items = ref([]);

const handleSubmit = () => {
    form.post('/meals');
}

function addMealItem(meal_item){
    meal_items.value.push(meal_item);
    console.log(meal_items);
}

</script>
<template>
    <form @submit.prevent="handleSubmit">
        <div class="space-y-12">
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Meal Details</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly if you so
                        choose, so be
                        careful what you share.</p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                    <div class="col-span-full">
                        <label for="name"
                            class="block text-sm font-medium font-semibold leading-6 text-gray-900">Name</label>
                        <div class="mt-2">
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <input v-model="form.name" type="text" name="name" id="name" autocomplete="name" :class="[
                                    form.errors.name && !form.name ? 'border-2 border-rose-500' : 'border-0',
                                    'block w-full rounded-md py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6'
                                ]" />
                                <div v-if="form.errors.name && !form.name"
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                </div>
                            </div>
                        </div>
                        <p v-if="form.errors.name && !form.name" class="mt-2 text-sm text-red-600" id="name-error">{{
                            form.errors.name }}</p>
                    </div>

                    <div class="col-span-full">
                        <label for="desc"
                            class="block text-sm font-medium font-semibold leading-6 text-gray-900">Description</label>
                        <div class="mt-2">
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <textarea v-model="form.desc" id="desc" name="desc" rows="3" :class="[
                                    form.errors.desc && !form.desc ? 'border-2 border-rose-500' : 'border-0',
                                    'block w-full rounded-md py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']
                                    " />
                                <div v-if="form.errors.desc && !form.desc"
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-gray-600">Describe the meal in a few short sentences.</p>
                    </div>
                    <div class="col-span-full">
                        <label for="public"
                            class="block text-sm font-medium font-semibold leading-6 text-gray-900">Public</label>
                        <div class="mt-2">
                            <Switch v-model="form.public" name="public" id="public"
                                :class="[form.public ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                                <span class="sr-only">Public</span>
                                <span aria-hidden="true"
                                    :class="[form.public ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                            </Switch>
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="mealtype"
                            class="block text-sm font-medium font-semibold leading-6 text-gray-900">Type</label>
                        <div class="mt-2 ml-8">
                            <fieldset id="mealtype">
                                <div class="mt-6 space-y-6">
                                    <div class="flex items-center gap-x-3">
                                        <input id="snack" name="type" value="snack" type="radio" v-model="form.type"
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                        <label for="snack"
                                            class="block text-sm font-medium leading-6 text-gray-900">Snack</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="breakfast" name="type" value="breakfast" type="radio" v-model="form.type"
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                        <label for="breakfast"
                                            class="block text-sm font-medium leading-6 text-gray-900">Breakfast</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="lunch" name="type" value="lunch" type="radio" v-model="form.type"
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                        <label for="lunch"
                                            class="block text-sm font-medium leading-6 text-gray-900">Lunch</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input id="dinner" name="type" value="dinner" type="radio" v-model="form.type"
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                        <label for="dinner"
                                            class="block text-sm font-medium leading-6 text-gray-900">Dinner</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="consumed_at"
                            class="block text-sm font-medium font-semibold leading-6 text-gray-900">Date/Time Consumed</label>
                        <div class="mealDatePicker mt-2">
                            <DatePicker class="appearance-none" id="consumed_at" name="consumed_at" mode="dateTime"
                                color="indigo" v-model.string="form.consumed_at" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-2">
                <div class="col-span-1">
                    <dt class="text-sm font-medium leading-6 text-gray-900 font-semibold">Items</dt>
                    <dd class="text-sm text-gray-900">
                        <MealItemList :meal_items="meal_items" header_inactive="bg-white rounded rounded-md"/>
                    </dd>
                </div>
                <div class="col-span-1">
                    <dt class="text-sm font-medium leading-6 text-gray-900 font-semibold">Add Items</dt>
                    <dd class="text-sm text-gray-900">
                        <MealItemSearch @add-meal-item="addMealItem"/>
                    </dd>
                </div>
            </div>

        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>
</template>
<style scoped>
.mealDatePicker>>>.vc-base-select select {
    border: none;
}
</style>
