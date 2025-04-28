<script setup lang="ts">
import { Head, usePage, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import axios from 'axios';
import { ref, watch } from 'vue';
import { Archive, BookOpen, Loader2Icon } from 'lucide-vue-next';

// Import shadcn/vue components
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Button } from '@/components/ui/button';

const page = usePage()
const favorites = ref<any[]>(page.props.favorites || []);
const links = ref(page.props.links ?? {})
const loading = ref(false)

watch(
    () => page.props,
    (newProps) => {
        favorites.value = newProps.favorites || []
        links.value = newProps.links ?? {}
    }
);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Favorites',
        href: '/favorites',
    },
];
function archive(newsId: number) {
    axios.post(`/favorites/${newsId}/archive`)
        .then(() => {
            favorites.value = favorites.value.filter(item => item.id !== newsId)

            if (favorites.value.length === 0 && links.value.prev) {
                goToCursor(links.value.prev);
            }

            if (favorites.value.length === 0) {
                if (links.value.prev) {
                    goToCursor(links.value.prev);
                } else {
                    // reset to first page
                    router.get(route('favorites.index'));
                }
            }
        })
        .catch(console.error)
}

function toggleRead(newsId: number) {
    loading.value = true
    axios.post(`/favorites/${newsId}/toggle-read`)
        .then(response => {
            const updatedItem = favorites.value.find(item => item.id === newsId);
            if (updatedItem) {
                updatedItem.pivot.is_read = response.data.is_read;
            }
        })
        .finally(() => {
            loading.value = false
        })
}

function goToCursor(cursor: string) {
    loading.value = true;

    router.get(
        route('favorites.index', { cursor }),
        {},
        {
            preserveState: true,
            preserveScroll: true,
            onFinish: () => loading.value = false,
        }
    );
}

</script>

<template>
    <Head title="Favorites" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="p-8">
                <h1 class="text-3xl font-bold mb-8">Favorite News</h1>

                <div class="rounded-xl border border-gray-700 shadow-md overflow-x-auto">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Title</TableHead>
                                <TableHead>Published</TableHead>
                                <TableHead>Source</TableHead>
                                <TableHead class="text-right">Actions</TableHead>
                            </TableRow>
                        </TableHeader>

                        <TableBody>
                            <TableRow v-for="item in favorites" :key="item.id">
                                <TableCell>
                                    <a
                                        :href="item.url"
                                        target="_blank"
                                        :class="[
                                            item.pivot.is_read ? 'text-green-400' : 'text-blue-400',
                                            'hover:underline'
                                        ]"
                                    >
                                        {{ item.title || item.summary }}
                                    </a>
                                </TableCell>
                                <TableCell>
                                    {{ item.published_at ? new Date(item.published_at).toLocaleDateString() : '-' }}
                                </TableCell>
                                <TableCell>{{ item.source ?? '-' }}</TableCell>
                                <TableCell class="flex justify-end space-x-1">
                                    <div class="tooltip" data-tip="Mark as Read">
                                        <Button size="icon" variant="ghost" @click="toggleRead(item.id)" :class="{'text-green-400': item.pivot.is_read, 'hover:text-green-400': !item.is_read}">
                                            <BookOpen class="w-5 h-5" />
                                        </Button>
                                    </div>
                                    <div class="tooltip" data-tip="Archive">
                                        <Button size="icon" variant="ghost" @click="archive(item.id)" class="hover:text-yellow-400">
                                            <Archive class="w-5 h-5" />
                                        </Button>
                                    </div>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>
                <!-- Cursor Pagination -->
                <div class="flex gap-2 justify-center mt-4">
                    <Button
                        v-if="links.prev"
                        variant="outline"
                        size="sm"
                        @click="goToCursor(links.prev)"
                        :disabled="loading"
                    >
                        <template v-if="loading">
                            <Loader2Icon class="w-4 h-4 animate-spin" />
                        </template>
                        <template v-else>
                            Prev
                        </template>
                    </Button>

                    <Button
                        v-if="links.next"
                        variant="outline"
                        size="sm"
                        @click="goToCursor(links.next)"
                        :disabled="loading"
                    >
                        <template v-if="loading">
                            <Loader2Icon class="w-4 h-4 animate-spin" />
                        </template>
                        <template v-else>
                            Next
                        </template>
                    </Button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
