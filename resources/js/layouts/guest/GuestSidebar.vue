<script setup lang="ts">

import AppLogo from '@/components/AppLogo.vue';
</script>

<template>
    <aside class="w-full md:w-1/4 bg-gray-800 p-4 rounded-lg">
        <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" alt="Freddy Duarte" class="rounded-full mx-auto w-32 h-32">
        <p class="mt-4 text-center">I'm a PHP & Laravel Programmer. I play guitar and bass. I'm into futsal and fitness.</p>
        <div class="mt-4 space-y-2 text-center">
            <a href="https://linkedin.com/in/freddyduarte" class="block text-blue-400 hover:underline">LinkedIn</a>
            <a href="https://github.com/fduarte" class="block text-blue-400 hover:underline">GitHub</a>
            <a href="mailto:hello@freddyduarte.com" class="block text-blue-400 hover:underline">Email</a>
        </div>
        <AppLogo />
        <div class="mockup-code w-full">
            <pre data-prefix="$"><code>npm i daisyui</code></pre>
            <pre data-prefix=">" class="text-warning"><code>installing...</code></pre>
            <pre data-prefix=">" class="text-success"><code>Done!</code></pre>
        </div>
    </aside>
</template>
