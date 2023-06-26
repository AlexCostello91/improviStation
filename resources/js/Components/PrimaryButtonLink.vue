<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    href: {
        type: String,
        default: '/'
    }
});
</script>

<template>
    <Link
        as="button"
        :type="type"
        :href="href"
        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"

    >
        <slot />
    </Link>
</template>
