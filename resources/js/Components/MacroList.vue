<script setup>
import { ref, computed, watch, nextTick } from 'vue';
import { PlusCircleIcon, MinusCircleIcon } from '@heroicons/vue/20/solid';
import { capitalizeFirstLetter, formatDecimal, isInteger } from '@/Composables/formatHelper.js';

const props = defineProps({
    macros: {
        type: Array,
        default: []
    },
    quantity: {
        type: Number,
        validator: (value) => isInteger(value),
        default: 1
    },
    allowEditing: {
        type: Boolean,
        default: false
    },
    editing: {
        type: Boolean,
        default: false
    },
    macroList: {
        type: Array,
        default: []
    }
});

const unusedMacros = computed(() => {
    return props.macroList.filter(item => {
        return !props.macros.some(macro => macro.name === item);
    });
});

// const newMacro = ref({});
const newMacro = ref(unusedMacros.value.length > 0 ? { name: unusedMacros.value[0], value: 1, display_unit: 'g' } : {});
watch(unusedMacros, (newUnusedMacros) => {
    if (newUnusedMacros.length > 0) {
        let du = newUnusedMacros[0] === 'sodium' ? 'mg' : 'g';
        newMacro.value = { name: newUnusedMacros[0], value: 1, display_unit: du };
    } else {
        newMacro.value = {}; // Handle case when no unused macros available
    }
});



</script>
<template>
    <div class="pt-4">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">
                                Nutrient</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Value</th>
                            <th v-if="quantity > 1" scope="col"
                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr v-for="macro in macros" :key="macro.name" class="even:bg-gray-50">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">
                                {{ capitalizeFirstLetter(macro.name ? macro.name : '') }}</td>
                            <td v-if="allowEditing && editing"
                                class="whitespace-nowrap py-4 text-sm text-gray-500 flex justify-between max-w-[13rem]">
                                <input v-model="macro.value" type="number" min="1"
                                    class="text-black max-w-[5rem] rounded-md">
                                <select v-if="macro.name != 'calories'" v-model="macro.display_unit" name="display_units"
                                    class="rounded-md">
                                    <option value="g">g</option>
                                    <option value="mg">mg</option>
                                </select>
                                <button @click.prevent="macros.splice(macros.indexOf(macro), 1)">
                                    <MinusCircleIcon class="p-2 w-12 text-red-500 hover:text-red-600"></MinusCircleIcon>
                                </button>

                            </td>
                            <td v-else class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ formatDecimal(macro.value) }}{{ macro.name !=
                                    'calories' ? macro.display_unit : '' }}


                            </td>
                            <td v-if="quantity > 1" class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ formatDecimal(macro.value * quantity) }}{{
                                    macro.name !=
                                    'calories' ? macro.display_unit : '' }}

                            </td>
                        </tr>
                        <tr v-if="editing && unusedMacros.length > 0" class=" bg-green-100">
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <select v-model="newMacro.name" name="macro" class="rounded-md h-12">
                                    <option v-for="(macro, index) in unusedMacros" :selected="index === 0">{{ macro }}
                                    </option>
                                </select>
                            </td>
                            <td class="whitespace-nowrap py-4 text-sm text-gray-500 flex justify-between max-w-[12rem]">
                                <input v-model="newMacro.value" type="number" min="1"
                                    class="text-black max-w-[5rem] rounded-md">
                                <select v-model="newMacro.display_unit" name="display_units" class="rounded-md">
                                    <option value="g" :selected="newMacro.display_unit=='g'">g</option>
                                    <option value="mg" :selected="newMacro.display_unit=='mg'">mg</option>
                                </select>
                                <button @click.prevent="macros.push({ ...newMacro });">
                                    <PlusCircleIcon class="p-2 w-12 text-green-500 hover:text-green-600"></PlusCircleIcon>
                                </button>
                            </td>
                            <td v-if="quantity > 1"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
