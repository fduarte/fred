<script setup lang="ts">

import { Link, usePage } from '@inertiajs/vue3';
import AppLogo from '@/components/AppLogo.vue';
import GuestSidebar from '@/layouts/guest/GuestSidebar.vue';

const user = usePage().props.auth?.user;
</script>

<template>
    <body class="bg-gray-900 text-white">

    <!-- Header -->
    <header class=" bg-gray-800 py-4 px-6 flex justify-between items-center">
        <h1 class="text-xl font-bold">Freddy Duarte</h1>
        <nav class="hidden md:flex space-x-6">
            <div  class="p-2 space-x-6">
                <Link class="hover:text-gray-400" :href="route('posts.index')">Posts</Link>
                <Link class="hover:text-gray-400" :href="route('news.index')">News</Link>
                <Link class="hover:text-gray-400" :href="route('about')">About</Link>
                <Link class="hover:text-gray-400" :href="route('contact')">Contact</Link>
            </div>
            <div class="bg-gray-700 rounded p-2 space-x-4">
                <template v-if="user">
                    <Link class="hover:text-gray-400" href="/dashboard">Dashboard</Link>
                    <Link class="hover:text-gray-400" href="/logout" method="post">Logout</Link>
                </template>
                <template v-else>
                    <Link class="hover:text-gray-400" href="/login">Login</Link>
                    <Link class="hover:text-gray-400" href="/register">Register</Link>
                </template>
            </div>
        </nav>
        <button class="md:hidden btn btn-ghost btn-sm">☰</button>
    </header>
    <Link :href="route('dashboard')" class="flex items-center gap-x-2">
    </Link>

    <!-- Main Content -->
    <div class="container mx-auto flex flex-col md:flex-row gap-6 p-6 max-w-5xl">

        <!-- Main Section -->
        <main class="w-full md:w-3/4">
            <slot />
        </main>

        <!-- Sidebar -->
        <GuestSidebar />

    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 py-4 px-6 mt-6 text-center">
        <nav class="space-x-6">
            <a href="#posts" class="hover:text-gray-400">Posts</a>
            <a href="#about" class="hover:text-gray-400">About</a>
            <a href="#contact" class="hover:text-gray-400">Contact</a>
        </nav>
        <p class="text-gray-500 mt-2">&copy; 2025 Freddy Duarte. All rights reserved.</p>
        <button class="btn btn-primary">One</button>
        <button class="btn btn-secondary">Two</button>
        <button class="btn btn-accent btn-outline">Three</button>
    </footer>

    </body>

</template>
