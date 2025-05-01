<script setup lang="ts">
import { Head, usePage, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue'
import axios from 'axios';
import { ref, watch } from 'vue';
import type { Post } from '@/types';

// Import shadcn/vue components
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Button } from '@/components/ui/button';
import { Delete, Edit2Icon, CircleIcon, LightbulbIcon, Loader2Icon } from 'lucide-vue-next';

const page = usePage()
const posts = ref<Post[]>(page.props.posts || []);
const links = ref(page.props.links ?? {})
const loading = ref(false)

// defineProps<{
//     posts: ref(posts || []),
// }>()

watch(
    () => page.props,
    (newProps) => {
        posts.value = newProps.posts || []
        links.value = newProps.links ?? {}
    }
);

function editPost(post: array) {
    axios.post(`/admin-posts/${post.id}/edit`)
        .then(() => {
            // posts.value = posts.value.filter(item = item.id !== post.id)


        })
        .catch(console.error)
}

function deletePost(postId: number) {
    axios.delete(`/admin-posts/${postId}`)
        .then(() => {
            posts.value = posts.value.filter(item => item.id !== postId)

            if (posts.value.length === 0 && links.value.prev) {
                goToCursor(links.value.prev)
            }
            if (posts.value.length === 0) {
                if (links.value.prev) {
                    goToCursor(links.value.prev);
                } else {
                    // reset to first page
                    router.get(route('admin-posts.index'));
                }
            }
        })
        .catch(console.error)
}

function togglePublished(postId: number) {
    loading.value = true
    axios.get(`/admin-posts/${postId}/toggle-published`)
        .then(response => {
            const updatedItem = posts.value.find(item => item.id === postId);
            if (updatedItem) {
                updatedItem.published = response.data.published;
            }
        })
        .finally(() => {
            loading.value = false
        })
}

function toggleFeatured(postId: number) {
    loading.value = true
    axios.get(`/admin-posts/${postId}/toggle-featured`)
        .then(response => {
            const updatedItem = posts.value.find(item => item.id === postId);
            if (updatedItem) {
                updatedItem.featured = response.data.featured;
            }
        })
        .finally(() => {
            loading.value = false
        })
}

function goToCursor(cursor: string) {
    loading.value = true;

    router.get(
        route('admin-posts.index', { cursor }),
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
  <AppLayout>
    <Head title="Admin - Posts" />
      <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
          <div class="p-8">
              <h1 class="text-3xl font-bold mb-8">Posts</h1>

              <div class="rounded-xl border border-gray-700 shadow-md overflow-x-auto">
                  <Table>
                      <TableHeader>
                          <TableRow>
                              <TableHead></TableHead>
                              <TableHead>Title</TableHead>
                              <TableHead>Status</TableHead>
                              <TableHead>Featured</TableHead>
                              <TableHead>Created At</TableHead>
                              <TableHead class="text-right">Actions</TableHead>
                          </TableRow>
                      </TableHeader>

                      <TableBody>
                          <TableRow v-for="post in posts" :key="post.id">
                              <TableCell>
                                  <span class="py-2 px-3 mr-3 border border-gray-700 rounded-full">
                                  {{ post.id }}
                                        </span>
                                  <a
                                      :href="post.id"
                                      target="_blank"
                                      :class="[
                                            post.published ? 'text-green-400' : 'text-red-600',
                                            'hover:underline'
                                        ]"
                                  >
                                      {{ post.title }}
                                  </a>
                              </TableCell>
                              <TableCell>
                                  <Button size="icon" variant="ghost" @click="togglePublished(post.id)">
                                      <CircleIcon class="w-5 h-5"
                                          :class="[post.published ? 'fill-green-400 stroke-green-400' : 'fill-red-600 stroke-red-600']"
                                      />
                                  </Button>
                              </TableCell>
                              <TableCell>
                                  <Button size="icon" variant="ghost" @click="toggleFeatured(post.id)">
                                      <CircleIcon class="w-5 h-5"
                                         :class="[post.featured ? 'fill-green-400 stroke-green-400' : 'fill-none']"
                                      />
                                      </Button>
                              </TableCell>
                              <TableCell>
                                  {{ post.created_at ? new Date(post.created_at).toDateString() : '-' }}
                              </TableCell>
                              <TableCell class="flex justify-end space-x-1">
                                  <div class="tooltip" data-tip="Edit">
                                      <Button size="icon" variant="ghost" @click="editPost(post)">
                                          <Edit2Icon class="w-5 h-5" />
                                      </Button>
                                  </div>
                                  <div class="tooltip" data-tip="Delete">
                                      <Button size="icon" variant="ghost" @click="deletePost(post.id)">
                                          <Delete class="w-5 h-5" />
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
