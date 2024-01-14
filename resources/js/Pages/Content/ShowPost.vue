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

                            <!-- text -->
                            <article
                                v-if="props.post.data.content"
                                class="prose prose-sm my-2 max-w-none px-8 pb-7 text-slate-600 prose-h2:text-neutral-600 prose-p:text-neutral-600"
                                v-html="parseHtml(props.post.data.content)"
                            ></article>
                            <!-- text -->
                        </article>

                        <!-- options -->
                        <div class="flex gap-x-1 px-7 pb-3">
                            <ContentVoting :post="props.post.data" />
                        </div>
                        <!-- options -->
                    </div>
                </div>
                <div class="rounded bg-gray-300"></div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Head } from '@inertiajs/vue3';
import { parseHtml } from '@/Utils/html';
import ContentItemAuthor from '@/Components/Content/Post/ContentItemAuthor.vue';
import ContentVoting from '@/Components/Content/Post/ContentVoting.vue';

const props = defineProps({
    post: {
        type: Object,
        required: true
    }
});
</script>
