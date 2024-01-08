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
                :type="type"
                ref="inputRef"
                class="w-full border-none bg-transparent px-4 py-3.5 text-sm placeholder:text-neutral-400/80 focus:ring-0"
                @input="$emit('update:modelValue', $event.target.value)"
            />

            <div
                v-if="$slots.suffix && !props.showPassword"
                class="absolute right-2.5 top-1/2 -translate-y-1/2 transform items-center"
            >
                <slot name="suffix" />
            </div>

            <!-- Show Password -->
            <span
                v-if="props.showPassword"
                class="absolute inset-y-0 right-0 my-2.5 grid cursor-pointer place-content-center pe-1.5 text-neutral-600 transition duration-300 hover:text-neutral-700"
            >
                <McEye2Fill
                    :title="__('Show')"
                    :class="{ hidden: hidePassword, block: !hidePassword }"
                    class="h-6 w-6"
                    @click="toggleShow"
                />

                <McEyeCloseFill
                    :title="__('Hidden')"
                    :class="{ block: hidePassword, hidden: !hidePassword }"
                    class="h-6 w-6"
                    @click="toggleShow"
                />
            </span>
            <!-- Show Password -->
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

const hidePassword = ref(true);

const type = ref("password");

const props = defineProps({
    error: {
        type: String,
        default: null,
    },
    label: {
        type: String,
        default: null,
    },
    modelValue: {
        type: String,
        default: null,
    },
    showPassword: {
        type: Boolean,
        default: true,
    },
});

defineOptions({
    inheritAttrs: false,
});

const toggleShow = () => {
    hidePassword.value = !hidePassword.value;
    type.value = !hidePassword.value ? "text" : "password";
};

const emit = defineEmits(["update:modelValue"]);

onMounted(() => {
    if (inputRef.value.hasAttribute("autofocus")) {
        inputRef.value.focus();
    }
});

defineExpose({ focus: () => inputRef.value.focus() });
</script>
