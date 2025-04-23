<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const news = usePage().props.news;
</script>

<template>
    <GuestLayout>
        <Head title="News" />
        <h2 class="text-2xl font-bold mb-4">Latest News</h2>
        <div class="space-y-4 p-4 bg-gray-800 rounded-lg ">
            <div v-for="item in news" :key="item.id" class="border-b pb-4 mb-4">
                <div class="text-gray-500 text-sm">
                    <span>Published: {{ item.published_at }} on {{ item.source }}</span>
                </div>
                <h2 class="font-semibold">
                    <a :href="item.url" target="_blank" class="text-blue-400 hover:underline">
                        {{ item.title ? item.title : item.summary }}
                    </a>
                </h2>
                <p class="text-gray-400" v-if="item.title">{{item.summary }}</p>
                <div class="text-gray-500 text-sm">
                    <span>Author: {{ item.author ?? 'Unknown' }}</span><br />

                </div>
            </div>
        </div>
    </GuestLayout>
</template>
