
<script setup>
import GuestLayout from '../Layouts/GuestLayout.vue';
import { Link } from '@inertiajs/vue3';

import { ChartBarSquareIcon, ClockIcon, ListBulletIcon, ShareIcon } from '@heroicons/vue/20/solid';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});

const features = [
    {
        name: 'Macro tracking',
        description:
            'See detailed breakdowns of all the macros you want to track. Calories, protein, fats, and more.',
        icon: ChartBarSquareIcon,
    },
    {
        name: 'Exercise Tracking',
        description:
            'From rock climbing to boogie boarding, keep track of burned calories and track your exercise goals.',
        icon: ClockIcon,
    },
    {
        name: 'Meal Logging',
        description:
            'Track everything you eat, and see what foods are standing between you and your goals.',
        icon: ListBulletIcon,
    },
    {
        name: 'Meal Sharing',
        description:
            'Search our database of user meals. Diets that work for others could also work for you!',
        icon: ShareIcon,
    },
]
const faqs = [
    {
        id: 1,
        question: "What is ImproviStation?",
        answer:
            "Improvistation is a tool to help better your life. It enabels you to track your meals and workouts, and see detailed statistics that will help you determine the best ways to hit your goals.",
    },
    {
        id: 2,
        question: "Why use ImproviStation instead of other similar tools?",
        answer:
            "We believe that everyone is different. There is no one size fits all solution to diet or exercise. It's all about finding what works for you, and we aim to help you find it.",
    },
    {
        id: 3,
        question: "How much does a subscription cost?",
        answer:
            "Nothing! ImproviStation is free, and open source. We believe in empowering users to take control of their own diet and exercise!",
    }
]
</script>

<template>
    <GuestLayout :can-login="canLogin" :can-register="canRegister">
        <!-- Hero section -->
        <div class="relative pt-14">
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
            </div>
            <div class="py-8 sm:py-16">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center">
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Improve your life with
                            ImproviStation</h1>
                        <p class="mt-6 text-lg leading-8 text-gray-600">Stay on top of your health and wellness by
                            tracking, analyzing and adapting your diet and exercise</p>
                        <div class="mt-10 flex items-center justify-center gap-x-6">
                            <Link v-if="canRegister" :href="route('register')"
                                class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Get Started <span aria-hidden="true">&rarr;</span></Link>

                            <a href="#learn" class="text-sm font-semibold leading-6 text-gray-900">Learn more <span
                                    aria-hidden="true">→</span></a>
                        </div>
                    </div>
                    <div class="mt-16 flow-root sm:mt-24">
                        <div
                            class="-m-2 rounded-xl bg-gray-900/5 p-2 ring-1 ring-inset ring-gray-900/10 lg:-m-4 lg:rounded-2xl lg:p-4">
                            <img src="/images/homepage/screenshot.webp" alt="App screenshot" width="2432" height="1442"
                                class="rounded-md shadow-2xl ring-1 ring-gray-900/10" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                aria-hidden="true">
                <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
            </div>
        </div>

        <!-- Feature section -->
        <div id="learn" class="mx-auto max-w-7xl px-6 lg:px-8 lg:pt-4">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">Improvise!</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Your health, your way.</p>
                <p class="mt-6 text-lg leading-8 text-gray-600">Whether its walking, weightlifting, surfing, or
                    strolling, ImproviStation lets you keep track of it all! Combine all sorts of exercises and diets,
                    any way you like! See all of your combined progress on our dashboard!</p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                    <div v-for="feature in features" :key="feature.name" class="relative pl-16">
                        <dt class="text-base font-semibold leading-7 text-gray-900">
                            <div
                                class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                <component :is="feature.icon" class="h-6 w-6 text-white" aria-hidden="true" />
                            </div>
                            {{ feature.name }}
                        </dt>
                        <dd class="mt-2 text-base leading-7 text-gray-600">{{ feature.description }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Testimonial section -->
        <div class="mx-auto mt-32 max-w-7xl sm:mt-56 sm:px-6 lg:px-8">
            <div
                class="relative overflow-hidden bg-gray-900 px-6 py-20 shadow-xl sm:rounded-3xl sm:px-10 sm:py-24 md:px-12 lg:px-20">
                <img class="absolute inset-0 h-full w-full object-cover brightness-150 saturate-0"
                    src="https://images.unsplash.com/photo-1601381718415-a05fb0a261f3?ixid=MXwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8ODl8fHxlbnwwfHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1216&q=80"
                    alt="" />
                <div class="absolute inset-0 bg-gray-900/90 mix-blend-multiply" />
                <div class="absolute -left-80 -top-56 transform-gpu blur-3xl" aria-hidden="true">
                    <div class="aspect-[1097/845] w-[68.5625rem] bg-gradient-to-r from-[#ff4694] to-[#776fff] opacity-[0.45]"
                        style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
                </div>
                <div class="hidden md:absolute md:bottom-16 md:left-[50rem] md:block md:transform-gpu md:blur-3xl"
                    aria-hidden="true">
                    <div class="aspect-[1097/845] w-[68.5625rem] bg-gradient-to-r from-[#ff4694] to-[#776fff] opacity-25"
                        style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
                </div>
                <div class="relative mx-auto max-w-2xl lg:mx-0">
                    <figure>
                        <blockquote class="mt-6 text-lg font-semibold text-white sm:text-xl sm:leading-8">
                            <p>“ImproviStation helped me stay on top of my diet and exercise goals, my way, without
                                compromise. I could experiment and see what works best for me without the need to rely
                                on anyone else. I was able to track and adjust as I saw fit.”</p>
                        </blockquote>
                        <figcaption class="mt-6 text-base text-white">
                            <div class="font-semibold">Jane Doe,</div>
                            <div class="mt-1">Happy Customer</div>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>

        <!-- FAQs -->
        <div
            class="pt-12 mx-auto max-w-2xl divide-y divide-gray-900/10 px-6 pb-8 sm:pb-24 sm:pt-12 lg:max-w-7xl lg:px-8 lg:pb-32">
            <h2 class="text-2xl font-bold leading-10 tracking-tight text-gray-900">Frequently asked questions</h2>
            <dl class="mt-10 space-y-8 divide-y divide-gray-900/10">
                <div v-for="faq in faqs" :key="faq.id" class="pt-8 lg:grid lg:grid-cols-12 lg:gap-8">
                    <dt class="text-base font-semibold leading-7 text-gray-900 lg:col-span-5">{{ faq.question }}</dt>
                    <dd class="mt-4 lg:col-span-7 lg:mt-0">
                        <p class="text-base leading-7 text-gray-600">{{ faq.answer }}</p>
                    </dd>
                </div>
            </dl>
        </div>
    </GuestLayout>
</template>
