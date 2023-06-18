<script setup>
import { ref } from 'vue';
import MacroList from './MacroList.vue';

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
        default: 'py-4 px-8 bg-indigo-100'
    },
    view_link_active: {
        type: String,
        default: 'font-bold text-white'
    },
    view_link_inactive: {
        type: String,
        default: 'font-semilbold text-indigo-600 hover:text-indigo-500'
    },
    allowEditing:{
        type: Boolean,
        default: false
    }

});


const toggleDropdown = (itemId) => {
    isOpen.value[itemId] = !isOpen.value[itemId];
};

const toggleEdit = (itemId) => {
    editing.value[itemId] = !editing.value[itemId];
}

const isOpen = ref({});
const editing = ref({});

</script>
<template>
    <dl class="grid grid-cols-1 sm:grid-cols-2 pb-4">
        <div class="border-gray-100 sm:px-4 py-2 sm:col-span-2 sm:px-0">
            <dd class="mt-2 text-sm text-gray-900">
                <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200">
                    <template v-for="meal_item in meal_items" :key="meal_item.id+meal_item.name">
                        <li :class="[
                            isOpen[meal_item.id] ? header_active
                                : header_inactive,
                            'relative flex items-center justify-between py-4 sm:pl-4 pr-5 text-sm leading-6'
                        ]">
                            <div class="flex w-0 flex-1 items-center">
                                <div v-if="editing[meal_item.id]  && allowEditing" class="ml-4 flex min-w-0 flex-1 gap-2">
                                    <input v-model="meal_item.name" type="text" class="rounded-md text-black text-sm">
                                </div>
                                <div v-else class="ml-4 flex min-w-0 flex-1 gap-2">
                                    <span :class="[
                                        isOpen[meal_item.id] ? 'font-bold' : 'font-semibold',
                                        'truncate'
                                    ]">{{ meal_item.name }}</span>
                                </div>

                                <div v-if="editing[meal_item.id]  && allowEditing" class="ml-4 flex shrink sm:shrink-0 sm:min-w-0 sm:flex-1 gap-2">
                                    <span :class="[
                                        isOpen[meal_item.id] ? 'font-bold' : 'font-semibold',
                                        'truncate'
                                    ]"> x </span>
                                    <input v-model="meal_item.quantity" type="number" class="rounded-md text-black text-sm max-w-xs">
                                </div>
                                <div v-else class="ml-4 flex shrink sm:shrink-0 sm:min-w-0 sm:flex-1 gap-2">
                                    <span :class="[
                                        isOpen[meal_item.id] ? 'font-bold' : 'font-semibold',
                                        'truncate'
                                    ]"> x {{ meal_item.quantity
}}</span>
                                </div>
                            </div>
                            <div v-if="isOpen[meal_item.id] && allowEditing" class="ml-4 flex-shrink-0">
                                <a :class="[
                                        isOpen[meal_item.id] ? view_link_active : view_link_inactive,
                                        'hover:underline cursor-pointer'
                                    ]" @click="toggleEdit(meal_item.id)">{{isOpen[meal_item.id] && editing[meal_item.id]?'Save':'Edit'}}</a>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <a :class="[
                                        isOpen[meal_item.id] ? view_link_active : view_link_inactive,
                                        'hover:underline cursor-pointer'
                                    ]" @click="toggleDropdown(meal_item.id)">View</a>
                            </div>

                        </li>
                        <li v-if="isOpen[meal_item.id]" :key="`dropdown-${meal_item.id}`" :class="content_active">
                            <p class="p-2">{{ meal_item.desc }}</p>
                            <MacroList allow-editing="true" :editing="editing[meal_item.id]" :macros="meal_item.macros" :quantity="meal_item.quantity" />
                        </li>
                    </template>
                </ul>
            </dd>
        </div>
    </dl>
</template>
