<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { useForm } from 'laravel-precognition-vue-inertia';
import { ExclamationCircleIcon } from '@heroicons/vue/20/solid'
import StepsDisplay from '@/Components/StepsDisplay.vue';
import { Switch } from '@headlessui/vue'
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import MealFormStep from '@/Components/MealFormStep.vue'
import { DatePicker } from 'v-calendar';
import RecentMealItems from './RecentMealItems.vue';
import MealItemList from './MealItemList.vue';
import 'v-calendar/style.css';
import MealView from './MealView.vue';
import { debounce } from 'lodash';

const user = usePage().props.auth.user;
const defultDebounce = 300;
const steps = ref([
    { name: 'Step 1', active: true, status: 'current', step: 1 },
    { name: 'Step 2', active: false, status: 'upcoming', step: 2},
    { name: 'Step 3', active: false, status: 'upcoming', step: 3 },
    { name: 'Step 4', active: false, status: 'upcoming', step: 4},
    { name: 'Step 5', active: false, status: 'upcoming', step: 5 },
    { name: 'Step 6', active: false, status: 'upcoming', step: 6 },
]);
const props = defineProps({
    recent_meal_items:{
        type: Array
    },
    macroList:{
        type: Array
    }
});

const form = useForm('post', '/meals', {
    name: '',
    desc: '',
    consumed_at: new Date(),
    type: 'snack',
    public: false,
    meal_items: []
});

function submit() {
    form.submit()
};
form.setValidationTimeout(1000);

function removeMealItem(meal_item) {
    meal_item.selected = false;
    form.meal_items.forEach((meal_item_el, index) => {
        if (meal_item_el.id == meal_item.id && meal_item_el.name == meal_item.name) {
            form.meal_items.splice(index,1);
        }
    });

}

const addMealItem = debounce(function addMealItem(meal_item) {
    meal_item.selected = true;
    let found = false;
    form.meal_items.forEach(meal_item_el => {
        if (meal_item_el.id == meal_item.id && meal_item_el.name == meal_item.name) {
            found = true;
            meal_item_el.quantity += 1;
        }
    });
    if (!found) {
        let newMealItem = { ...meal_item, quantity: 1 };
        form.meal_items.push(newMealItem);
    }
}, defultDebounce)

const nextStep = debounce(function nextStep() {
    let currStep = getCurrentStep();
    if (currStep < 5) {
        transitionStep(currStep, currStep + 1)
    }

},defultDebounce);

const goToStep = debounce(function goToStep(targetStep) {
    let currStep = getCurrentStep();
    if (currStep < 6) {
        transitionStep(currStep, targetStep)
    }

}, defultDebounce);

function getCurrentStep() {
    let currentStep = -1;
    steps.value.forEach((step, index) => {
        if (step.active == true) {
            currentStep = index;
        }
    });
    return currentStep;
}

function transitionStep(currentStep, targetStep) {
    let valid = true;
    //Check for empty fields on first step
    if(currentStep==0){
        valid = form.valid('name') && form.valid('desc');
        if(form.name==''){
            form.setError('name','You must enter a name for your meal.');
        }
        if(form.desc==''){
            form.setError('desc','You must enter a description.');
        }
    }
    console.log(currentStep);
    if (valid) {
        steps.value[currentStep].active = false;
        steps.value[currentStep].status = 'complete';
        steps.value[targetStep].status = 'current';
        setTimeout(() => {
            steps.value[targetStep].active = true;
        }, 600);
    }
}

</script>
<template>
    <div class="flex justify-center bg-white">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight p-4">New Meal</h2>
    </div>

    <div class="bg-white px-4 sm:px-6 lg:px-8">
        <div class="flex justify-center">
            <StepsDisplay :steps="steps" @goToStep="goToStep" />
        </div>
        <form @submit.prevent="submit">
            <div class="space-y-12">
                <div class=" min-h-[50vh]">
                    <MealFormStep :active="steps[0].active">
                        <div class="flex flex-col max-w-sm mx-auto p-4">
                            <div class="p-4">
                                <label for="name"
                                    class="block text-sm font-medium font-semibold leading-6 text-gray-900">Name</label>
                                <div class="mt-2">
                                    <div class="relative mt-2 rounded-md shadow-sm">
                                        <input v-model="form.name" type="text" name="name" id="name" autocomplete="name" required
                                            @change="form.validate('name')" :class="[
                                                form.invalid('name') ? 'border-2 border-rose-500' : 'border-0',
                                                'block w-full rounded-md py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6'
                                            ]" />
                                        <div v-if="form.invalid('name')"
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                            <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                        </div>
                                    </div>
                                </div>
                                <p v-if="form.invalid('name')" class="mt-2 text-sm text-red-600" id="name-error">{{
                                    form.errors.name }}</p>
                            </div>
                            <div class="p-4">
                                <label for="desc"
                                    class="block text-sm font-medium font-semibold leading-6 text-gray-900">Description</label>
                                <div class="mt-2">
                                    <div class="relative mt-2 rounded-md shadow-sm">
                                        <textarea v-model="form.desc" id="desc" name="desc" rows="3" required
                                            @change="form.validate('desc')" :class="[
                                                form.invalid('desc') ? 'border-2 border-rose-500' : 'border-0',
                                                'block w-full rounded-md py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']
                                                " />
                                        <div v-if="form.invalid('desc')"
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                            <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                                        </div>
                                    </div>
                                </div>
                                <p v-if="form.invalid('desc')" class="mt-2 text-sm text-red-600" id="desc-error">{{
                                    form.errors.desc }}</p>
                                <p class="mt-3 text-sm leading-6 text-gray-600">Describe the meal in a few short sentences.
                                </p>
                            </div>
                        </div>
                    </MealFormStep>
                    <MealFormStep :active="steps[1].active">
                        <div class="flex flex-col max-w-sm mx-auto p-4">
                            <div class="p-4">
                                <label for="public"
                                    class="block text-sm font-medium font-semibold leading-6 text-gray-900">Make this meal
                                    public?</label>
                                <div class="flex justify-start mt-2">
                                    <Switch v-model="form.public" name="public" id="public"
                                        :class="[form.public ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']">
                                        <span class="sr-only">Public</span>
                                        <span aria-hidden="true"
                                            :class="[form.public ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                                    </Switch>
                                    <span class="ml-4">{{ form.public?'Yes':'No' }}</span>
                                </div>
                                <p class="mt-3 text-sm leading-6 text-gray-600">This would allow users to look up your meals
                                    and share them.
                                </p>
                            </div>
                            <div class="p-4">
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
                                                <input id="breakfast" name="type" value="breakfast" type="radio"
                                                    v-model="form.type"
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
                                                <input id="dinner" name="type" value="dinner" type="radio"
                                                    v-model="form.type"
                                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                                <label for="dinner"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Dinner</label>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </MealFormStep>
                    <MealFormStep :active="steps[2].active">
                        <div class="flex flex-col items-center max-w-sm mx-auto p-4">
                            <label for="consumed_at"
                                class="block text-sm font-medium font-semibold leading-6 text-gray-900">Date/Time
                                Consumed</label>
                            <div class="mealDatePicker mt-2">
                                <DatePicker id="consumed_at" name="consumed_at" mode="dateTime" color="indigo"
                                    v-model="form.consumed_at" :timezone="user.timezone" />
                            </div>
                        </div>
                    </MealFormStep>
                    <MealFormStep :active="steps[3].active">
                        <div class="flex flex-col items-center max-w-sm mx-auto p-4">
                            <label for="consumed_at"
                                class="block text-sm font-medium font-semibold leading-6 text-gray-900">Would you like to
                                add some recently eaten items?</label>
                            <div class="mt-2">
                                <RecentMealItems :recent_meal_items="recent_meal_items" @add-meal-item="addMealItem" @remove-meal-item="removeMealItem" />
                            </div>
                        </div>
                    </MealFormStep>
                    <MealFormStep :active="steps[4].active">
                        <dt class="text-sm font-medium leading-6 text-gray-900 font-semibold">Items</dt>
                        <dd class="text-sm text-gray-900">
                            <MealItemList :meal_items="form.meal_items" header_inactive="bg-white rounded rounded-md"
                                :allow-editing="true" :macro-list="macroList" @add-meal-item="addMealItem" @remove-meal-item="removeMealItem"/>
                        </dd>
                    </MealFormStep>

                    <MealFormStep :active="steps[5].active">
                        <MealView :meal="form" :macroList="macroList"/>
                        <div class="mt-6 flex items-center justify-end gap-x-6 p-4">
                            <Link class="text-sm font-semibold leading-6 text-gray-900" :href="route('meals.index')">Cancel
                            </Link>
                            <button type="submit"
                                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                        </div>
                    </MealFormStep>
                </div>
                <div v-if="!steps[5].active" class="flex justify-end p-4">
                    <PrimaryButton type="button" @click="nextStep">Next</PrimaryButton>
                </div>
            </div>
        </form>
    </div>
</template>
<style scoped>
.mealDatePicker>>>.vc-base-select select {
    border: none;
}
</style>
