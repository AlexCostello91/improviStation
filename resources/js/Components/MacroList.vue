<script setup>
import MacroListItem from "@/Components/MacroListItem.vue";
defineProps(['meal_item']);
</script>
<template>
    <div class="container mx-auto">
        <div
            class="block mt-6 max-w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="max-w-full mx-auto p-4 overflow-hidden bg-white shadow rounded-b-md">
                <ul role="list" class="divide-y divide-gray-200">
                    <MacroListItem v-for="macro in meal_item.macros" :key="macro.id" :macro="macro"></MacroListItem>
                </ul>
            </div>
        </div>
    </div>
</template>
