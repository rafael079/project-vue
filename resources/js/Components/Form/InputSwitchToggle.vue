<template>
    <div>
        <div class="flex items-center">
            <input
                v-bind="$attrs"
                v-model="checked"
                type="checkbox"
                class="relative h-6 w-11 shrink-0 cursor-pointer appearance-none rounded-full border border-transparent bg-neutral-200 pt-[0.1em] ring-1 ring-transparent ring-offset-white transition-colors duration-200 ease-in-out before:inline-block before:h-5 before:w-5 before:translate-x-0 before:transform before:rounded-full before:bg-white before:shadow before:ring-0 before:transition before:duration-200 before:ease-in-out checked:bg-primary-600 checked:bg-none checked:before:translate-x-full checked:before:bg-primary-200 hover:checked:bg-primary-500 focus:border-primary-600 focus:outline-none focus:ring-primary-600 focus:checked:bg-primary-500"
            />
            <label
                v-if="props.label"
                :for="$attrs.id"
                :class="{ 'text-red-600': props.error }"
                class="ml-3 text-sm text-neutral-500"
            >
                {{ props.label }}
            </label>
            <p
                v-if="props.error"
                class="mx-1 my-2 text-xs font-medium text-red-600"
            >
                {{ props.error }}
            </p>
        </div>
    </div>
</template>
<script setup>
import { computed } from 'vue';

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
        type: Boolean,
        default: false,
    },
});

defineOptions({
    inheritAttrs: false,
});

const emit = defineEmits(["update:modelValue"]);

const checked = computed({
    get() {
        return props.modelValue;
    },
    set(newChecked) {
        emit("update:modelValue", newChecked);
    },
});
</script>
