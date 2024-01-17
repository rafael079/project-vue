<template>
    <div class="inline-flex overflow-hidden h-full w-full">
        <div
            v-if="!isLoaded"
            class="relative block h-full w-full items-center justify-center"
        >
            <span
                class="absolute left-1/2 top-1/2 inline-flex h-full w-full -translate-x-1/2 -translate-y-1/2 transform items-center justify-center bg-white bg-opacity-25 p-5"
            >
                <McLoadingFill
                    class="h-11 w-11 animate-spin text-secundary-500"
                />
            </span>
        </div>
        <img
            v-show="isLoaded"
            v-bind="$attrs"
            :src="props.src"
            class="h-full w-full"
            alt=""
            srcset=""
            @load="loadImage"
        />
    </div>
</template>
<script setup>
import { ref } from 'vue';

const props = defineProps({
    src: {
        type: String,
        required: true
    },
    containerClass: {
        type: String,
        default: null
    }
});

const isLoaded = ref(false);

defineOptions({
    inheritAttrs: false
});

const loadImage = () => (isLoaded.value = true);
</script>
