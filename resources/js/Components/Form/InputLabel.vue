<template>
    <label class="mb-1 block text-sm capitalize text-neutral-500">
        <span v-if="props.value">
            {{ props.value }}
        </span>
        <span v-else>
            <slot />
        </span>
    </label>
</template>
<script setup>
const props = defineProps({
    value: {
        type: String,
        default: "",
    },
});
</script>
