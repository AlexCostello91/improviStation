<script setup>
import { Switch } from '@headlessui/vue'
import { useStorage } from "../Composables/useStorage.js";
import { computed } from 'vue';
const props = defineProps(['defaultState']);
let enabled = useStorage('showAllMeals', props.defaultState);
const label = computed(() => {
    return enabled.value ? 'All Meals' : 'My Meals';
});
</script>

<template>
    <div>
        <span class="text-white text-xl mr-2">{{ label }}</span>
        <Switch
            @click="$emit('showAllMeals', !enabled)"
            v-model="enabled"
            :class="[enabled ? 'bg-indigo-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2']"
            >
            <span class="sr-only">{{ label }}</span>
            <span aria-hidden="true"
                :class="[enabled ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
        </Switch>
    </div>
</template>
