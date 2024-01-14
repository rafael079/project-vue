<!-- eslint-disable vue/no-v-html -->
<template>
    <div>
        <div class="px-5 pt-2">
            <!-- author -->
            <ContentItemAuthor :post="props.post" />
            <!-- author -->
        </div>
        <Link
            :href="
                route('posts.show', {
                    id: props.post.id,
                    slug: props.post.slug
                })
            "
            :title="props.post.title"
        >
            <!-- title -->
            <h3
                class="hover:underline-offset-3 my-2 block w-full justify-center px-6 py-1.5 text-lg font-bold leading-6 tracking-tight text-neutral-600 transition duration-150 hover:decoration-2 group-hover:text-primary-700"
            >
                {{ props.post.title }}
            </h3>
            <!-- title -->
        </Link>

        <Link
            class="group"
            :href="
                route('posts.show', {
                    id: props.post.id,
                    slug: props.post.slug
                })
            "
        >
            <!-- summary -->
            <template v-if="props.post.content">
                <div class="mb-2.5">
                    <p
                        class="block w-full px-6 text-sm text-neutral-700"
                        v-html="truncate(parseHtml(props.post.content), 250)"
                    />
                    <Link
                        v-if="props.post.content.length > 250"
                        :href="
                            route('posts.show', {
                                id: props.post.id,
                                slug: props.post.slug
                            })
                        "
                        :title="props.post.title"
                        class="mt-1 block w-full py-1 text-center text-sm backdrop-blur-sm"
                    >
                        <span
                            class="rounded-full bg-white px-6 py-1 font-medium capitalize text-neutral-600 shadow group-hover:bg-primary-100 group-hover:text-primary-700"
                            >{{ __('Read more') }}...</span
                        >
                    </Link>
                </div>
            </template>
            <!-- summary -->
        </Link>
        <!-- options -->
        <div class="flex gap-x-1 px-5 pb-3">
            <ContentVoting :post="props.post" />
        </div>
        <!-- options -->
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
import { truncate } from '@/Utils/text';
import { parseHtml } from '@/Utils/html';
import ContentItemAuthor from '@Components/Content/Post/ContentItemAuthor.vue';
import ContentVoting from '@Components/Content/Post/ContentVoting.vue';

const props = defineProps({
    post: {
        type: Object,
        required: true
    }
});
</script>
