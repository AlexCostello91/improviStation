<script setup>
import { ref } from 'vue';

defineProps(['modelValue','timezones']);

defineEmits(['update:modelValue']);

defineExpose({ focus: () => input.value.focus() });


</script>
<template>
    <select name="timezone" id="timezone" @input="$emit('update:modelValue', $event.target.value)" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
        <option v-for="timezone in timezones" :value="timezone.name" :selected="modelValue == timezone.name">{{ timezone.name +' ('+timezone.offset+')' }}</option>
    </select>

</template>
