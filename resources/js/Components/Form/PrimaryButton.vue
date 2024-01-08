<template>
    <AppButton
        :type="props.type"
        :disabled="props.loading"
        class="bg-primary-600 text-white hover:bg-primary-700 focus:bg-primary-800"
        @click="$emit('click')"
    >
        <slot />
    </AppButton>
</template>
<script setup>
import AppButton from "@/Components/Form/AppButton.vue";

const emit = defineEmits(["click"]);

const props = defineProps({
    type: {
        type: String,
        default: "button",
    },
    loading: {
        type: Boolean,
        default: false,
    },
});
</script>
