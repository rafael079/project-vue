<!-- eslint-disable vue/no-v-html -->
<template>
    <div>
        <Head>
            <title>{{ props.post.data.title }}</title>
        </Head>
        <div class="mx-auto mt-5 max-w-6xl">
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2 grid gap-y-3">
                    <div class="overflow-hidden rounded bg-white shadow">
                        <div class="px-8 pt-4">
                            <!-- author -->
                            <ContentItemAuthor :post="props.post.data" />
                            <!-- author -->
                        </div>

                        <article>
                            <h2
                                class="mb-3.5 mt-1.5 block px-7 py-3 text-2xl font-bold leading-7 tracking-tight text-neutral-700"
                            >
                                {{ props.post.data.title }}
                            </h2>

                            <!-- media -->
                            <ContentDisplayMedia
                                v-if="
                                    props.post.data.media &&
                                    props.post.data.media.length > 0
                                "
                                height="34rem"
                                :media="props.post.data.media"
                                :post="{
                                    id: props.post.data.id,
                                    slug: props.post.data.slug
                                }"
                            />
                            <!-- media -->

                            <!-- text -->
                            <article
                                v-if="props.post.data.content"
                                class="prose prose-sm my-2 max-w-none px-8 pb-7 text-slate-600 prose-h2:text-neutral-600 prose-p:text-neutral-600"
                                v-html="parseHtml(props.post.data.content)"
                            ></article>
                            <!-- text -->
                        </article>

                        <div
                            v-if="props.post.data.source"
                            class="my-4 bg-neutral-100 px-8 py-4 text-sm"
                        >
                            {{ __('See full article at') }}:
                            <a
                                :href="props.post.data.source"
                                target="_blank"
                                rel="nofollow noopener noreferrer"
                                referrerpolicy="no-referrer"
                                class="font-medium text-blue-600 hover:underline"
                                >{{ truncate(props.post.data.source, 50) }}</a
                            >
                        </div>

                        <!-- options -->
                        <ContentOptionsItem :post="props.post.data" />
                        <!-- options -->
                    </div>

                    <CommentContainer :post-id="props.post.data.id" />
                </div>
                <div class="rounded bg-gray-300"></div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { parseHtml } from '@/Utils/html';
import { truncate } from '@/Utils/text';

import ContentItemAuthor from '@/Components/Content/Post/ContentItemAuthor.vue';
import ContentOptionsItem from '@/Components/Content/Post/ContentOptionsItem.vue';
import CommentContainer from '@/Components/Content/Comment/CommentsContainer.vue';
import ContentDisplayMedia from '@/Components/Content/Post/ContentDisplayMedia.vue';

const props = defineProps({
    post: {
        type: Object,
        required: true
    }
});
</script>
