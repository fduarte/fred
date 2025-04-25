<script setup lang="ts">
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';
import { Heart } from 'lucide-vue-next';

const page = usePage()
const favorites = ref(page.props.favorites || [])
const { news, links } = page.props
const loading = ref(false)

/**
 * Builds url for cursor pagination
 * @param cursor
 */
function cursorUrl(cursor: string) {
    return route('news.index', { cursor }).toString()
}

/**
 * Checks for existing favorited news for logged user
 * @param newsId
 */
function isFavorited(newsId) {
    return favorites.value.includes(newsId)
}

/**
 * Saves/deletes particular news item for logged user
 * @param newsId
 */
function toggleFavorite(newsId) {
    loading.value = true
    axios.post(`/news/${newsId}/favorite`)
        .then(() => {
            if (isFavorited(newsId)) {
                favorites.value = favorites.value.filter(id => id !== newsId)
            } else {
                favorites.value.push(newsId)
            }
        })
        .finally(() => {
            loading.value = false
        })
}
</script>

<template>
    <GuestLayout>
        <Head title="News" />
        <h2 class="text-2xl font-bold mb-4">Latest News</h2>
        <div v-if="news && news.length" class="space-y-4 p-4 bg-gray-800 rounded-lg ">
            <div v-for="item in news" :key="item.id" class="flex border-b pb-4 mb-4">

                <div v-if="$page.props.auth.user" class="flex-none w-8 mt-1">
                    <button
                        @click="toggleFavorite(item.id)"
                        :disabled="loading"
                    >
                        <Heart
                            :class="isFavorited(item.id) ? 'fill-red-500 stroke-red-500' : 'fill-gray-400 stroke-gray-400'"
                            :size="22"
                        />
                    </button>
                </div>

                <div class="flex-auto">
                    <div class="text-gray-500 text-sm">
                        <span>Published: {{ item.published_at }} on {{ item.source }}</span>
                    </div>
                    <h2 class="font-semibold">
                        <a :href="item.url" target="_blank" class="text-blue-400 hover:underline">
                            {{ item.title || item.summary }}
                        </a>
                    </h2>
                    <p class="text-gray-400" v-if="item.title">{{item.summary }}</p>
                    <div class="text-gray-500 text-sm">
                        <span>Author: {{ item.author ?? 'Unknown' }}</span><br />
                    </div>
                </div>
            </div>
            <!-- Cursor Pagination -->
            <div class="flex gap-2 justify-center">
                <Link
                    v-if="links.prev"
                    :href="cursorUrl(links.prev)"
                    class="btn btn-sm join-item"
                >Prev
                </Link>
                <Link
                    v-if="links.next"
                    :href="cursorUrl(links.next)"
                    class="btn btn-sm join-item"
                >Next
                </Link>
            </div>
        </div>
    </GuestLayout>
</template>
