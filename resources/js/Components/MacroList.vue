<script setup>
import { ref } from 'vue';
import {capitalizeFirstLetter, formatDecimal, isInteger} from '@/Composables/formatHelper.js';

const props = defineProps({
    macros:{
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
    }
});

</script>
<template>
    <div class="flow-root pt-4">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">
                                Nutrient</th>
                            <th  scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Value</th>
                            <th v-if="quantity > 1" scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr v-for="macro in macros" :key="macro.name" class="even:bg-gray-50">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">
                                {{ capitalizeFirstLetter(macro.name) }}</td>
                            <td v-if="allowEditing && editing" class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <input v-model="macro.value" type="number" class="text-black text-sm">
                                <select v-if="macro.name!='calories'" v-model="macro.display_unit" name="display_units">
                                    <option value="g">g</option>
                                    <option value="mg">mg</option>
                                </select>
                            </td>
                            <td v-else class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ formatDecimal(macro.value) }}{{ macro.name !=
                                    'calories' ? macro.display_unit : '' }}</td>
                            <td v-if="quantity > 1" class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ formatDecimal(macro.value * quantity) }}{{
                                    macro.name !=
                                    'calories' ? macro.display_unit : '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
