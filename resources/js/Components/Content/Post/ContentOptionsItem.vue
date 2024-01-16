<template>
    <div>
        <div class="flex gap-x-2 px-5 pb-3">
            <ContentVoting :post="props.post" />

            <Link
                :href="
                    route('posts.show', {
                        id: props.post.id,
                        slug: props.post.slug
                    })
                "
                class="inline-flex items-center hover:underline"
            >
                <ContentCommentCount :total="props.post.total_comments ?? 0" />
            </Link>

            <div v-if="props.post.category" class="ml-auto flex items-center">
                <Link
                    :href="
                        route('category.show', {
                            category: props.post.category.id,
                            slug: props.post.category.slug
                        })
                    "
                    class="inline-flex rounded-full px-3 py-1.5 text-xs font-medium leading-3 text-white"
                    :style="'background: ' + props.post.category.color"
                >
                    {{ props.post.category.name }}
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

import ContentCommentCount from '@Components/Content/Post/ContentCommentCount.vue';
import ContentVoting from '@Components/Content/Post/ContentVoting.vue';

const props = defineProps({
    post: {
        type: Object,
        required: true
    }
});
</script>
