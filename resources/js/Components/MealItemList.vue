<script setup>
import { ref } from 'vue';
import { PlusCircleIcon, ExclamationTriangleIcon } from '@heroicons/vue/20/solid';
import MacroList from './MacroList.vue';
const emits = defineEmits(['removeMealItem','addMealItem','goToStep']);
const props = defineProps({
    meal_items: {
        type: Array,
        default: []
    },
    header_active: {
        type: String,
        default: 'bg-indigo-600 text-white text-semibold'
    },
    header_inactive: {
        type: String,
        default: ''
    },
    content_active: {
        type: String,
        default: 'p-4 bg-indigo-100 border-none'
    },
    view_link_active: {
        type: String,
        default: 'font-bold text-white'
    },
    view_link_inactive: {
        type: String,
        default: 'font-semilbold text-indigo-600 hover:text-indigo-500'
    },
    allowEditing: {
        type: Boolean,
        default: false
    },
    macroList: {
        type: Array
    }

});


const toggleDropdown = (itemId) => {
    isOpen.value[itemId] = !isOpen.value[itemId];
    if (!isOpen.value[itemId]) {
        editing.value[itemId] = false;
        removeZeroQtyItems()
    }
};

const toggleEdit = (itemId) => {
    editing.value[itemId] = !editing.value[itemId];
    if(editing.value[itemId]==false){
        removeZeroQtyItems()
    }
}

function removeZeroQtyItems(){
    props.meal_items.forEach(meal_item=>{
            if(meal_item.quantity == 0){
                emits('removeMealItem', meal_item);
            }
        })
}
function getNewMealItem() {
    return {
        name: 'New Meal Item',
        id: Date.now(),
        desc: '',
        macros: [],
        quantity: 1
    };
}

const isOpen = ref({});
const editing = ref({});

</script>
<template>
    <dl class="grid grid-cols-1 sm:grid-cols-2 pb-4">
        <div class="border-gray-100 sm:px-4 py-2 sm:col-span-2 sm:px-0">
            <dd class="mt-2 text-sm text-gray-900">
                <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-100">
                    <template v-for="(meal_item, index) in meal_items" :key="meal_item.id">
                        <li :class="[
                            isOpen[meal_item.id] ? header_active
                                : header_inactive,
                                index==0?'rounded-t-md':'',
                            'relative flex items-center justify-between py-4 sm:pl-4 px-4 text-sm leading-6 '
                        ]">
                            <div class="flex w-0 flex-1 items-center">
                                <div v-if="editing[meal_item.id] && allowEditing" class="ml-4 flex min-w-0 flex-1 gap-2">
                                    <input ref="" v-model="meal_item.name" type="text"
                                        class="rounded-md text-black text-sm max-w-[8rem]" />
                                </div>
                                <div v-else class="flex min-w-0 flex-1 gap-2">
                                    <span :class="[
                                        isOpen[meal_item.id] ? 'font-bold' : 'font-semibold',
                                        'truncate'
                                    ]">{{ meal_item.name }}</span>
                                </div>


                                <div v-if="editing[meal_item.id] && allowEditing"
                                    class="ml-4 flex shrink sm:shrink-0 sm:min-w-0 gap-2 items-center">
                                    <span :class="[
                                        isOpen[meal_item.id] ? 'font-bold' : 'font-semibold',
                                        'truncate'
                                    ]"> Qty: </span>
                                    <input v-model="meal_item.quantity" type="number" min="1" inputmode="numeric"
                                        class="rounded-md text-black text-sm max-w-[4rem]">
                                </div>
                                <div v-else class="ml-4 flex shrink sm:shrink-0 sm:min-w-0 gap-2">
                                    <span :class="[
                                        isOpen[meal_item.id] ? 'font-bold' : 'font-semibold',
                                        'truncate'
                                    ]"> Qty: {{ meal_item.quantity }}</span>
                                </div>
                            </div>
                            <div v-if="isOpen[meal_item.id] && allowEditing" class="ml-4 flex-shrink-0">
                                <a :class="[
                                    isOpen[meal_item.id] ? view_link_active : view_link_inactive,
                                    'hover:underline cursor-pointer'
                                ]" @click="toggleEdit(meal_item.id)">{{ isOpen[meal_item.id] && editing[meal_item.id] ? 'Save' : 'Edit' }}</a>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <a :class="[
                                    isOpen[meal_item.id] ? view_link_active : view_link_inactive,
                                    'hover:underline cursor-pointer'
                                ]" @click="toggleDropdown(meal_item.id)">{{isOpen[meal_item.id] ? 'Hide' : 'Show' }}</a>
                            </div>

                        </li>
                        <div v-if="editing[meal_item.id] && allowEditing" class="flex justify-center items-center bg-indigo-100 border-none pt-4">
                                    <button class="flex justify-center bg-red-600 border border-red-900 text-white rounded-md p-1.5 font-bold hover:bg-red-700" @click.prevent="$emit('removeMealItem', meal_item)">
                                        <ExclamationTriangleIcon class="text-white w-5 mr-1"/>
                                        REMOVE ITEM
                                    </button>
                                </div>
                        <li v-if="isOpen[meal_item.id]" :key="`dropdown-${meal_item.id}`" :class="content_active">
                            <div v-if="editing[meal_item.id] && allowEditing">
                                <div class="">
                                    <div class="relative rounded-md shadow-sm">
                                        <textarea v-model="meal_item.desc" rows="3" :class="[
                                            'block w-full rounded-md py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']
                                            " />

                                    </div>
                                </div>
                            </div>
                            <p v-else class="">{{ meal_item.desc }}</p>
                            <MacroList :allow-editing="true" :editing="editing[meal_item.id]" :macros="meal_item.macros"
                                :quantity="meal_item.quantity" :macro-list="macroList" />
                        </li>

                    </template>
                    <li v-if="meal_items.length == 0"
                        class="relative flex items-center justify-center align-middle p-4 text-sm leading-6 bg-red-400 text-white font-bold rounded-md">
                        <ExclamationTriangleIcon class="text-white w-5 mr-1"/>No items added
                    </li>


                </ul>
                <div v-if="allowEditing" class="relative flex items-center justify-end py-4 sm:pl-4 pr-5 text-sm leading-6">
                        <button @click.prevent="$emit('addMealItem', getNewMealItem())"
                            class="flex justify-between bg-indigo-400 p-2 rounded text-white font-semibold hover:bg-indigo-500">
                            <PlusCircleIcon stroke="bg-gray-100" class="w-6 mr-2"/>New  Item
                        </button>
                    </div>
            </dd>
        </div>
    </dl>
</template>
