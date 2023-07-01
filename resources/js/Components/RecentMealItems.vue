
<script setup>
import PrimaryButton from './PrimaryButton.vue';
import { PlusCircleIcon, MinusCircleIcon } from '@heroicons/vue/20/solid';

let props = defineProps(['recent_meal_items']);

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
        <ul class="text-center min-h-[360px] divide-y divide-solid divide-gray-300 ">
            <li v-for="(meal_item, index) in recent_meal_items" :class="{
                'bg-indigo-200':meal_item.selected,
                'grid grid-cols-3 p-2 align-middle hover:bg-indigo-100': 1
            }">
                <div class="flex items-center justify-start text-ellipsis overflow-hidden">{{ meal_item.name }}</div>
                <div class="flex items-center justify-center">{{ getMacro(meal_item, 'calories') }} Calories</div>
                <div class="flex items-center justify-end">
                    <button v-if="!meal_item.selected"  @click.prevent="$emit('addMealItem', meal_item)"
                       >
                        <PlusCircleIcon class="text-green-500 w-8" />
                    </button>
                    <button v-else @click.prevent="$emit('removeMealItem', meal_item)">
                        <MinusCircleIcon class="text-red-500 w-8" />
                    </button>

                </div>
            </li>
        </ul>
    </div>
</template>
