<template>
    <div>
        <!-- Backdrop -->
        <div
            class="absolute inset-0 z-50 h-full w-full bg-white/[.95] transition duration-500"
        ></div>
        <!-- Backdrop -->

        <!-- Spinner -->
        <div
            role="status"
            class="absolute left-1/2 top-1/2 z-[60] m-auto transform -translate-x-1/2 -translate-y-1/2"
        >
            <McLoading3Fill
                class="h-12 w-12 animate-spin fill-primary-900 text-primary-800"
            />
            <span class="sr-only">{{ __("Loading") }}...</span>
        </div>
        <!-- Spinner -->

        <!-- Slot -->
        <div
            v-if="$slots.default"
            class="absolute left-1/2 top-1/2 z-[60] mt-11 w-full -translate-x-1/2 -translate-y-1/2 transform text-center"
        >
            <span
                class="items-center rounded-full px-3 py-0.5 text-sm tracking-tighter uppercase font-semibold text-neutral-600"
            >
                <slot />
            </span>
        </div>
        <!-- Slot -->
    </div>
</template>
<script setup></script>
