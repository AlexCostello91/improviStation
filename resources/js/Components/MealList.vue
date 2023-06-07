<script setup>
import { Link } from '@inertiajs/vue3';
import PaginationPane from "./PaginationPane.vue";
import dayjs from "dayjs";
let props = defineProps(['meals']);
const people = [


  { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', role: 'Member' },
  { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', role: 'Member' },
  { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', role: 'Member' },
  { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', role: 'Member' },

  // More people...
]
</script>
<template>
    <div class="px-4 sm:px-6 lg:p-8 bg-white rounded">
      <div class="sm:flex sm:items-center float-right">
        <div class="mt-4 sm:ml-16 sm:flex-none lg:mt-0">
          <button type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add meal</button>
        </div>
      </div>
      <div class="-mx-4 mt-8 sm:-mx-0">
        <table class="min-w-full divide-y divide-gray-300">
          <thead>
            <tr>
              <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>
              <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">Type</th>
              <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">User</th>
              <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">Consumed</th>
              <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Calories</th>
              <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                <span class="sr-only">View</span>
              </th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 bg-white">
            <tr v-for="(meal, index) in meals.data" :key="meal.id">
              <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ meal.name }}</td>
              <td class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 sm:table-cell">{{ meal.type }}</td>
              <td class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell">{{ meal.user.name }}</td>
              <td class="hidden whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell">{{ dayjs(meal.created_at).format('h:m A ddd, MMM D YYYY') }}</td>
              <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ 200 }}</td>
              <td class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                <Link :href="route('meals.show', meal.id)" class="text-indigo-600 hover:text-indigo-900">View<span class="sr-only">, {{ meal.name }}</span></Link>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="flex items-center justify-center p-4">
            <PaginationPane :links="meals.links" :pageSize="meals.per_page"/>
        </div>
      </div>
    </div>
  </template>
