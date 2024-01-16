<template>
    <img :src="props.src" alt="" srcset="" />
</template>
<script setup>
const props = defineProps({
    src: {
        type: String,
        required: true
    }
});
</script>
