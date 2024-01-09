<template>
    <transition name="fade" tag="div">
        <div
            v-if="props.show"
            class="fixed z-50 w-full max-w-md space-y-3"
            :class="toastClass"
        >
            <slot />
        </div>
    </transition>
</template>
<script setup>
import { computed } from "vue";

const props = defineProps({
    placement: {
        type: String,
        default: "top-end",
    },
    show: {
        type: Boolean,
        default: false,
    },
});

const toastClass = computed(() => {
    return {
        top: "top-10 left-1/2 transform -translate-x-1/2",
        "top-end": "top-10 right-10",
        "top-start": "top-10 left-10",
        bottom: "bottom-10 left-1/2 transform -translate-x-1/2",
        "bottom-start": "bottom-10 left-10",
        "bottom-end": "bottom-10 right-10",
    }[props.placement];
});
</script>
<style scoped>
.fade-enter-active,
.fade-leave-active {
    @apply duration-500 ease-out;
}
.fade-enter-from {
    @apply translate-y-full opacity-0;
}
.fade-leave-to {
    @apply opacity-0;
}
</style>
