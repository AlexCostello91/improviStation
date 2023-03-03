<script setup>
import { CheckCircleIcon, ChevronRightIcon, EnvelopeIcon } from '@heroicons/vue/20/solid'

const props = defineProps(['meal']);

</script>
<template>
            <li>
                <a class="block hover:bg-gray-50">
                    <div class="flex items-center px-4 py-4 sm:px-6">
                        <div class="flex min-w-0 flex-1 items-center">
                            <div class="flex-shrink-0">
                                <img class="h-12 w-12 rounded-full" alt="" />
                            </div>
                            <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                <div>
                                    <p class="truncate text-sm font-medium text-indigo-600">{{ meal.name }}</p>
                                    <p class="mt-2 flex items-center text-sm text-gray-500">
                                        <EnvelopeIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                                            aria-hidden="true" />
                                        <span class="truncate">{{ meal.user.name }}</span>
                                    </p>
                                </div>
                                <div class="hidden md:block">
                                    <div>
                                        <p class="text-sm text-gray-900">
                                            Applied on
                                            {{ ' ' }}
                                            <time :datetime="meal.created_at">{{ meal.created_at }}</time>
                                        </p>
                                        <p class="mt-2 flex items-center text-sm text-gray-500">
                                            <CheckCircleIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-green-400"
                                                aria-hidden="true" />
                                                {{ meal.type }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <ChevronRightIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                        </div>
                    </div>
                </a>
            </li>
</template>
