<template>
    <div>
        <InputLabel
            v-if="props.label"
            :for="$attrs.id"
            :class="{
                ' text-red-600': props.error,
            }"
        >
            {{ props.label }}:
        </InputLabel>

        <div
            :class="{
                '!border-red-300 !bg-red-100/70 text-red-600': props.error,
            }"
            class="relative group w-full rounded border border-neutral-300/70 bg-neutral-100 focus-within:border-gray-400 focus-within:bg-neutral-50 focus-within:shadow-sm focus-within:shadow-gray-300"
        >
            <input
                v-bind="$attrs"
                :value="props.modelValue"
                :maxlength="props.maxLength"
                ref="inputRef"
                class="w-full border-none bg-transparent px-4 py-3.5 text-sm placeholder:text-neutral-400/80 focus:ring-0"
                @input="$emit('update:modelValue', $event.target.value)"
            />

            <div
                v-if="$slots.suffix"
                class="absolute right-2.5 top-1/2 -translate-y-1/2 transform items-center"
            >
                <slot name="suffix" />
            </div>

            <!-- Max Length -->
            <div
                v-if="props.maxLength"
                class="absolute right-6 -bottom-2.5 rounded-full bg-gray-400 px-2.5 py-0.5 text-xs border border-transparent hidden group-focus-within:inline-block text-white"
                :class="{
                    'font-medium !bg-red-200 !inline-block text-red-600':
                        props.modelValue &&
                        props.modelValue.length == props.maxLength,
                }"
            >
                <span
                    v-text="props.modelValue ? props.modelValue.length : 0"
                ></span>
                / {{ props.maxLength }}
            </div>
            <!-- Max Length -->
        </div>

        <!-- error -->
        <InputValidationError v-if="props.error" :message="props.error" />
        <!-- error -->
    </div>
</template>
<script setup>
import { onMounted, ref } from "vue";
import InputLabel from "@Components/Form/InputLabel.vue";
import InputValidationError from "@Components/Form/InputValidationError.vue";

const inputRef = ref(null);

const props = defineProps({
    error: {
        type: String,
        default: null,
    },
    label: {
        type: String,
        default: null,
    },
    maxLength: {
        type: Number,
        default: null,
    },
    modelValue: {
        type: String,
        default: null,
    },
});

defineOptions({
    inheritAttrs: false,
});

const emit = defineEmits(["update:modelValue"]);

onMounted(() => {
    if (inputRef.value.hasAttribute("autofocus")) {
        inputRef.value.focus();
    }
});

defineExpose({ focus: () => inputRef.value.focus() });
</script>