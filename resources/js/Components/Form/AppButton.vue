<template>
    <button
        :disabled="props.disabled"
        :type="props.type"
        :class="{ 'opacity-30': props.disabled }"
        class="text-sm"
        @click="$emit('click')"
    >
        <slot />
    </button>
</template>
<script setup>
const emit = defineEmits(["click"]);

const props = defineProps({
    disabled: {
        type: Boolean,
        default: false,
    },
    type: {
        type: String,
        default: "button",
    },
});
</script>
