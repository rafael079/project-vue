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
                class="hover:underline-offset-3 my-2 block w-full justify-center px-6 py-2 text-lg font-medium leading-6 tracking-tight text-neutral-700 transition duration-150 hover:decoration-2 group-hover:text-primary-700"
            >
                {{ props.post.title }}
            </h3>
            <!-- title -->
        </Link>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
import ContentItemAuthor from '@Components/Content/Post/ContentItemAuthor.vue';

const props = defineProps({
    post: {
        type: Object,
        required: true
    }
});
</script>
