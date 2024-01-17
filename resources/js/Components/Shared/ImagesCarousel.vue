<template>
    <Carousel>
        <Slide v-for="(image, index) in images" :key="index">
            <Link
                :href="
                    route('posts.show', {
                        id: props.post.id,
                        slug: props.post.slug
                    })
                "
            >
                <div class="carousel__item" :style="'height: ' + props.height">
                    <img
                        :src="
                            route('image', {
                                path:
                                    'media/' + image.id + '/' + image.file_name,
                                fm: 'webp',
                                q: 25
                            })
                        "
                        class="absolute left-0 top-1/2 w-full -translate-y-1/2 scale-[1.9] object-cover opacity-20 blur-sm"
                    />
                    <AppImage
                        :src="
                            route('image', {
                                path:
                                    'media/' + image.id + '/' + image.file_name,
                                fm: 'webp',
                                q: 75
                            })
                        "
                        class="relative object-contain"
                    />
                </div>
            </Link>
        </Slide>

        <template #addons>
            <Navigation />
            <Pagination />
        </template>
    </Carousel>
</template>
<script setup>
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';

import AppImage from '@Components/Shared/AppImage.vue';

import 'vue3-carousel/dist/carousel.css';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    images: {
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
<style lang="scss">
.carousel {
    .carousel__item {
        @apply flex h-fit w-full object-contain;
    }
    .carousel__prev,
    .carousel__next {
        @apply mx-2 h-6 w-6 rounded-full bg-black bg-opacity-75 text-white shadow-sm;
    }
    .carousel__prev--disabled,
    .carousel__next--disabled {
        @apply hidden opacity-0;
    }

    .carousel__pagination {
        @apply absolute bottom-7 left-1/2 -translate-x-1/2 -translate-y-1/2 transform rounded-full bg-black bg-opacity-85 px-1.5 py-px;
        .carousel__pagination-button::after {
            @apply w-2 rounded-lg bg-white bg-opacity-65;
        }
        .carousel__pagination-button:hover::after,
        .carousel__pagination-button--active::after {
            @apply bg-opacity-100;
        }
    }
}
</style>
