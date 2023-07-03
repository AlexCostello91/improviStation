<script setup>

import { Dialog, DialogPanel } from '@headlessui/vue'
import { Head, Link } from '@inertiajs/vue3';
import { Bars3Icon,XMarkIcon } from '@heroicons/vue/20/solid';
import { ref } from 'vue';
import Footer from '@/Components/Footer.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});

const mobileMenuOpen = ref(false)
</script>

<template>
    <slot name="title">
        <Head title="ImproviStation - Improve your life!" />
    </slot>
    <div class="bg-white">
        <!-- Header -->
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8" style="min-height: 104px" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="/" class="-m-1.5 p-1.5">
                        <span class="sr-only">ImproviStation</span>
                        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                            alt="" />
                    </a>
                </div>
                <div class="flex lg:hidden">
                    <button type="button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                        @click="mobileMenuOpen = true">
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>

                <div class="hidden lg:flex lg:gap-x-8 ">
                    <Link :href="route('home')" class="text-sm font-semibold leading-6 text-gray-900 lg:hover:underline">Home</Link>
                    <Link :href="route('about')" class="text-sm font-semibold leading-6 text-gray-900 lg:hover:underline">About</Link>
                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    <div v-if="canLogin" class="hidden px-6 py-4 sm:block">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-sm text-gray-700">
                        Dashboard</Link>
                        <template v-else>
                            <Link :href="route('login')" class="text-sm text-gray-900 font-semibold lg:hover:underline">Log in
                            </Link>
                            <Link v-if="canRegister" :href="route('register')"
                                class="ml-4 text-sm text-gray-900 font-semibold lg:hover:underline">Register <span
                                aria-hidden="true">&rarr;</span></Link>
                        </template>
                    </div>
                </div>
            </nav>
            <Dialog as="div" class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
                <div class="fixed inset-0 z-50" />
                <DialogPanel
                    class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                    <div class="flex items-center justify-between">
                        <a href="/" class="-m-1.5 p-1.5">
                            <span class="sr-only">ImproviStation</span>
                            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                                alt="" />
                        </a>
                        <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = false">
                            <span class="sr-only">Close menu</span>
                            <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">
                                <a v-for="item in navigation" :key="item.name" :href="item.href"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">{{
                                        item.name }}</a>
                            </div>
                            <div class="py-6">
                                <Link :href="route('home')" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Home</Link>
                                <Link :href="route('about')" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">About</Link>
                            </div>
                            <div class="py-6">
                                <div v-if="canLogin" class="sm:block">
                                    <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                                        class="text-sm text-gray-700">Dashboard</Link>
                                    <template v-else>
                                        <Link :href="route('login')"
                                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                                        Log in
                                        </Link>

                                        <Link v-if="canRegister" :href="route('register')"
                                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                                        Register <span aria-hidden="true">&rarr;</span></Link>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </DialogPanel>
            </Dialog>
        </header>

        <main class="isolate pt-24 px-2 sm:pt-0 sm:px-4">
            <slot></slot>
        </main>

        <!-- Footer -->
        <Footer />
    </div>
</template>
