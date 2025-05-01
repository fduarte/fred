<script setup lang="ts">

import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/layouts/GuestLayout.vue';
</script>

<template>
    <GuestLayout>
        <Head title="Posts" />
        <h2 class="text-2xl font-bold mb-4">Latest Posts</h2>
        <div class="space-y-4">
            <div class="p-4 bg-gray-800 rounded-lg">
                <h3 class="text-lg font-semibold">Post Title</h3>
                <p class="text-gray-400">Short description of the post...</p>
                <a href="#" class="text-blue-400 hover:underline">Read more</a>
            </div>
        </div>
    </GuestLayout>
</template>
