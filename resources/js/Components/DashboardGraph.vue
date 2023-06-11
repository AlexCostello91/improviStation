<script setup>
import LineChart from './LineChart.vue';
let props = defineProps(['dailyValues']);
</script>

<template>
    <div class="mt-6 px-8">
        <h3 class="text-lg font-semibold leading-6 text-gray-900">Last 30 days...</h3>
        <line-chart :daily-values="dailyValues" />
    </div>
</template>
