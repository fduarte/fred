<script setup lang="ts">
  import GuestLayout from '@/layouts/GuestLayout.vue'
  import { Head } from '@inertiajs/vue3'

  defineProps<{}>()
</script>

<template>
  <GuestLayout>
    <Head title="About" />
      About Freddy Duarte
  </GuestLayout>
</template>
