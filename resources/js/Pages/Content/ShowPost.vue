<template>
    <div>
        <Head>
            <title>{{ props.post.data.title }}</title>
        </Head>
        <div class="mx-auto mt-5 max-w-6xl">
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2 grid gap-y-3">
                    <div class="overflow-hidden rounded bg-white shadow">
                        <div class="px-7 pt-3">
                            <!-- author -->
                            <ContentItemAuthor :post="props.post.data" />
                            <!-- author -->
                        </div>

                        <article>
                            <h2
                                class="mb-5 mt-2 block px-7 py-3 text-2xl font-semibold leading-7 tracking-tight text-neutral-700"
                            >
                                {{ props.post.data.title }}
                            </h2>
                        </article>
                    </div>
                </div>
                <div class="rounded bg-gray-300"></div>
            </div>
        </div>
    </div>
</template>
<script setup>
import ContentItemAuthor from '@/Components/Content/Post/ContentItemAuthor.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    post: {
        type: Object,
        required: true
    }
});
</script>
