<script setup>
import { useForm } from 'laravel-precognition-vue-inertia';
import { usePage, Link } from '@inertiajs/vue3';
import { DatePicker } from 'v-calendar';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import 'v-calendar/style.css';
import CancelButton from './CancelButton.vue';
// const props = defineProps['workout'];
const props = defineProps({
    workout:{
        type: Object
    }
});
const user = usePage().props.auth.user;
const form = useForm('post', '/workouts', {
    name: props.workout.name?props.workout.name:'',
    calories: props.workout.calories? props.workout.calories: null,
    intensity: props.workout.intensity? props.workout.intensity: null,
    duration: props.workout.duration? props.workout.duration: 30,
    started_at: new Date(),
    desc: props.workout.desc?props.workout.desc:''
});

form.setValidationTimeout(1000);

const submit = () => form.submit();

</script>
<template>
    <div class="px-4 sm:px-6 lg:px-8 bg-white">
        <div class="flex justify-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight p-4">New Workout</h2>

        </div>
        <form @submit.prevent="submit">
            <div class="grid grid-cols-2 gap-y-6 gap-x-6 mx-auto max-w-screen-sm">
                <div class="col-span-2 justify-center pt-2 pb-1">
                    <div class="relative">
                        <label for="name"
                            class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">Name</label>
                        <input id="name" name="name" type="text"
                            class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 focus:outline-none"
                            placeholder="Enter a name..." v-model="form.name" @change="form.validate('name')" />
                        <div v-if="form.invalid('name')" class="text-sm text-red-600 py-1">
                            {{ form.errors.name }}
                        </div>
                    </div>
                </div>
                <div class="col-span-2 justify-center pt-2 pb-1">
                    <div class="relative">
                        <label for="desc"
                            class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">Description</label>
                        <textarea id="desc" name="desc"
                            class="block w-full overflow-auto rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 focus:outline-none"
                            placeholder="Enter a short description of the workout..." v-model="form.desc"
                            @change="form.validate('desc')"></textarea>
                        <div v-if="form.invalid('desc')" class="text-sm text-red-600 py-1">
                            {{ form.errors.desc }}
                        </div>
                    </div>
                </div>
                <div class="col-span-2 sm:col-span-1 justify-center pt-2 pb-1">
                    <div class="relative">
                        <label for="duration"
                            class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">Duration (in mins)</label>
                        <input id="duration"
                        class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 focus:outline-none"
                        name="duration" v-model="form.duration" @change="form.validate('duration')" type="number">
                        <div v-if="form.invalid('duration')" class="text-sm text-red-600 py-1">
                            {{ form.errors.duration }}
                        </div>
                    </div>
                </div>
                <div class="col-span-2 sm:col-span-1 justify-center pt-2 pb-1">
                    <div class="relative">
                        <label for="intensity"
                            class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">Perceived Intensity (1 - 10)</label>
                        <input id="intensity"
                        class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 focus:outline-none"
                        @change="form.validate('intensity')" name="intensity" v-model="form.intensity" type="number">
                        <div v-if="form.invalid('intensity')" class="text-sm text-red-600 py-1">
                            {{ form.errors.intensity }}
                        </div>
                    </div>
                </div>
                <div class="col-span-2 sm:col-span-1 justify-center pt-2 pb-1">
                    <div class="relative">
                        <label for="calories"
                            class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">Calories Burned</label>
                        <input id="calories"
                        class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 focus:outline-none"
                        @change="form.validate('calories')" name="calories" v-model="form.calories" type="number">
                        <div v-if="form.invalid('calories')" class="text-sm text-red-600 py-1">
                            {{ form.errors.calories }}
                        </div>
                    </div>
                </div>
                <div class="col-span-2 flex justify-center p-2">
                    <div class="relative">
                        <label for="started_at"
                            class="block text-sm font-medium font-semibold leading-6 text-gray-900">Date/Time
                            Workout was started</label>
                        <div class="mealDatePicker mt-2">
                            <DatePicker id="started_at" name="started_at" mode="dateTime" color="indigo"
                                v-model="form.started_at" :timezone="user.timezone"/>
                        </div>
                        <div v-if="form.invalid('started_at')" class="text-sm text-red-600 py-1">
                            {{ form.errors.started_at }}
                        </div>
                    </div>
                </div>
                <div class="col-span-2 flex justify-center p-2">
                    <CancelButton class="mr-4" type="button" :href="route('workouts.index')">Cancel</CancelButton>
                    <PrimaryButton type="submit">Save</PrimaryButton>
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

