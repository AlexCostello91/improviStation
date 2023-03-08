<script setup>
import PaginationPane from "./PaginationPane.vue";
import WorkoutListItem from "./WorkoutListItem.vue";

let props = defineProps(['workouts']);
</script>
<style>
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateX(30px);
}
</style>
<template>
    <div class="container mx-auto">
        <div
            class="block mt-6 max-w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div>
                <h1 class="p-3 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Workouts
                </h1>
            </div>
            <div class="max-w-full mx-auto p-4 overflow-hidden bg-white shadow rounded-b-md">
                <ul>
                    <WorkoutListItem v-for="workout in workouts.data" :workout="workout"></WorkoutListItem>
                </ul>
                <div class="flex p-4 items-center justify-center">
                    <PaginationPane :links="workouts.links" />
                </div>
            </div>
        </div>
    </div>
</template>
