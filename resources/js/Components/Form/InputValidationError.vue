<template>
    <div v-show="props.message">
        <p
            class="mt-0.5 w-full rounded bg-red-300/50 px-3 py-1.5 text-xs leading-tight font-semibold shadow-sm text-red-700"
        >
            {{ props.message }}
        </p>
    </div>
</template>
<script setup>
const props = defineProps({
    message: {
        type: String,
        default: null
    }
})
</script>
