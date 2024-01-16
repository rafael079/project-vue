<template>
    <div>
        <InputLabel
            v-if="props.label"
            :for="$attrs.id"
            :class="{
                ' text-red-600': props.error
            }"
        >
            {{ props.label }}:
        </InputLabel>

        <div
            :class="{
                '!border-red-300 !bg-red-100/70 text-red-600': props.error
            }"
            class="group relative w-full rounded border border-neutral-300/70 bg-neutral-100 focus-within:border-gray-400 focus-within:bg-neutral-50 focus-within:shadow-sm focus-within:shadow-gray-300"
        >
            <textarea
                v-bind="$attrs"
                ref="textareaRef"
                :value="props.modelValue"
                class="w-full resize-none border-none bg-transparent px-4 py-3.5 text-sm placeholder:text-neutral-400/80 focus:ring-0"
                @input="
                    $emit('update:modelValue', $event.target.value), resize()
                "
            />
        </div>

        <!-- error -->
        <InputValidationError v-if="props.error" :message="props.error" />
        <!-- error -->
    </div>
</template>
<script setup>
import { onMounted, ref } from 'vue';

import InputLabel from '@Components/Form/InputLabel.vue';
import InputValidationError from '@Components/Form/InputValidationError.vue';

const textareaRef = ref(null);

const props = defineProps({
    error: {
        type: String,
        default: null
    },
    label: {
        type: String,
        default: null
    },
    maxLength: {
        type: Number,
        default: null
    },
    modelValue: {
        type: String,
        default: null
    }
});

defineOptions({
    inheritAttrs: false
});

const resize = () => {
    textareaRef.value.style.height = 'auto';
    textareaRef.value.style.height = textareaRef.value.scrollHeight + 'px';
};

defineEmits(['update:modelValue']);

onMounted(() => {
    if (textareaRef.value.hasAttribute('autofocus')) {
        textareaRef.value.focus();
    }
});

defineExpose({ focus: () => textareaRef.value.focus() });
</script>
