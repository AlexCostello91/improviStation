<script setup>
import { ArrowDownIcon, ArrowUpIcon } from '@heroicons/vue/20/solid'
import { computed, onMounted } from 'vue';

const props = defineProps(['mealStats', 'mealStatsNew']);

onMounted(() => {
  // Delay the fading in of elements by 1 second
  setTimeout(() => {
    document.querySelectorAll('.fade-in-bg').forEach(element => {
      element.classList.remove('opacity-0');
      element.classList.add('opacity-100');
    });
  }, 300);
});
</script>

<template>
    <div class="mt-6 px-8">
      <h3 class="text-lg font-semibold leading-6 text-gray-900">Week by week...</h3>
      <dl class="mt-5 grid grid-cols-1 divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow md:grid-cols-4 md:divide-y-0 md:divide-x">
        <div v-for="item in mealStats" :key="item.name" class="px-4 py-5 sm:p-6">
          <dt class="text-base font-normal text-gray-900">{{ item.name }}</dt>
          <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
            <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
              {{ item.stat }}
            </div>

            <div :class="[item.changeType === 'increase' ? 'bg-green-100' : 'bg-red-100', 'inline-flex items-baseline rounded-full px-2.5 py-0.5 text-sm font-medium md:mt-2 lg:mt-0 fade-in-bg opacity-0']">
              <template v-if="item.changeType === 'increase'">
                <ArrowUpIcon class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-green-500" aria-hidden="true" />
                <span class="sr-only">Increased by </span>
              </template>
              <template v-else>
                <ArrowDownIcon class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-red-500" aria-hidden="true" />
                <span class="sr-only">Decreased by </span>
              </template>
              <span>{{ item.change }}</span>
            </div>
          </dd>
        </div>
      </dl>
    </div>
    <div class="mt-6 px-8">
      <div class="fade-in opacity-0">
        {{ mealStatsNew }}
      </div>
    </div>
  </template>


<style scoped>
.fade-in-bg {
  transition: opacity 1s ease-in-out;
}
</style>
