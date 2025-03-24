<script setup lang="ts">

</script>

<template>
    <body class="bg-gray-900 text-white">

    <!-- Header -->
    <header class=" bg-gray-800 py-4 px-6 flex justify-between items-center">
        <h1 class="text-xl font-bold">Freddy Duarte</h1>
        <nav class="hidden md:flex space-x-6">
            <a href="#posts" class="hover:text-gray-400">Posts</a>
            <a href="#about" class="hover:text-gray-400">About</a>
            <a href="#contact" class="hover:text-gray-400">Contact</a>
        </nav>
        <button class="md:hidden btn btn-ghost btn-sm">☰</button>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto flex flex-col md:flex-row gap-6 p-6 max-w-5xl">
        <!-- Main Section -->
        <main class="w-full md:w-3/4">
            <h2 class="text-2xl font-bold mb-4">Latest Posts</h2>
            <div class="space-y-4">
                <!-- Example post snippet -->
                <div class="p-4 bg-gray-800 rounded-lg">
                    <h3 class="text-lg font-semibold">Post Title</h3>
                    <p class="text-gray-400">Short description of the post...</p>
                    <a href="#" class="text-blue-400 hover:underline">Read more</a>
                </div>
            </div>
        </main>

        <!-- Sidebar -->
        <aside class="w-full md:w-1/4 bg-gray-800 p-4 rounded-lg">
            <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" alt="Freddy Duarte" class="rounded-full mx-auto w-32 h-32">
            <p class="mt-4 text-center">I'm a PHP & Laravel Programmer. I play guitar and bass. I'm into futsal and fitness.</p>
            <div class="mt-4 space-y-2 text-center">
                <a href="https://linkedin.com/in/freddyduarte" class="block text-blue-400 hover:underline">LinkedIn</a>
                <a href="https://github.com/fduarte" class="block text-blue-400 hover:underline">GitHub</a>
                <a href="mailto:hello@freddyduarte.com" class="block text-blue-400 hover:underline">Email</a>
            </div>
            <div class="mockup-code w-full">
                <pre data-prefix="$"><code>npm i daisyui</code></pre>
                <pre data-prefix=">" class="text-warning"><code>installing...</code></pre>
                <pre data-prefix=">" class="text-success"><code>Done!</code></pre>
            </div>
        </aside>
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

    <slot />
</template>
