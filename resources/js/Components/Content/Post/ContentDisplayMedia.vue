<template>
    <div
        class="relative flex w-full mb-3 items-center justify-center overflow-hidden bg-neutral-500 text-center"
    >
        <template v-if="props.media.length === 1">
            <Link
                :href="
                    route('posts.show', {
                        id: props.post.id,
                        slug: props.post.slug
                    })
                "
                :style="'height: ' + props.height"
            >
                <img
                    :src="
                        route('image', {
                            path:
                                'media/' +
                                props.media[0].id +
                                '/' +
                                props.media[0].file_name,
                            fm: 'webp',
                            q: 20
                        })
                    "
                    class="absolute left-0 top-1/2 w-full -translate-y-1/2 scale-[1.9] object-cover opacity-20 blur-sm"
                />
                <AppImage
                    :src="
                        route('image', {
                            path:
                                'media/' +
                                props.media[0].id +
                                '/' +
                                props.media[0].file_name,
                            fm: 'webp',
                            q: 25
                        })
                    "
                    class="relative object-contain"
                />
            </Link>
        </template>
        <template v-else>
            <ImagesCarousel
                :images="props.media"
                :post="props.post"
                :height="props.height"
            />
        </template>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';

import AppImage from '@/Components/Shared/AppImage.vue';
import ImagesCarousel from '@/Components/Shared/ImagesCarousel.vue';

const props = defineProps({
    media: {
        type: Object,
        required: true
    },
    height: {
        type: String,
        default: '28rem'
    },
    post: {
        type: Object,
        required: true
    }
});
</script>
