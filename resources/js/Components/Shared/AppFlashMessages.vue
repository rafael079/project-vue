<template>
    <div
        class="bg-white rounded border-t-4 bg-opacity-[.97] w-full text-sm p-1 shadow-md"
        :class="{
            'border-green-700 bg-green-50': props.message.type === 'success',
            'border-red-700 bg-red-50': props.message.type === 'error',
        }"
        role="alert"
    >
        <!-- Content -->
        <div class="flex relative w-full items-center p-4">
            <BxHappyAlt
                v-if="props.message.type === 'success'"
                class="me-5 inline-flex h-9 w-9 opacity-50 text-green-900 p-1 rounded-full isolate aspect-video bg-green-900/20"
            />
            <CaFaceDizzyFilled
                v-else-if="props.message.type === 'error'"
                class="me-5 inline-flex h-9 w-9 opacity-50 text-red-900 p-1 rounded-full isolate aspect-video bg-red-900/20"
            />
            <div class="w-[79%]">
                <h4 class="block font-semibold text-neutral-700 capitalize">
                    {{ props.message.message }}
                </h4>
                <p
                    v-if="props.message.description"
                    class="text-justify text-neutral-700 mt-1"
                >
                    {{ props.message.description }}
                </p>
            </div>
            <div class="absolute right-3 top-1/2 -translate-y-1/2 mt-px">
                <AppButton
                    class="inline-flex flex-shrink-0 items-center justify-center rounded-full bg-neutral-200/80 shadow p-px leading-none text-neutral-600 hover:bg-white hover:text-neutral-800 focus:border-0 focus:outline-none focus:ring-0"
                    @click="$emit('remove')"
                >
                    <span class="sr-only">{{ __("Close") }}</span>
                    <IoClose class="h-5 w-5" />
                </AppButton>
            </div>
        </div>
        <!-- Content -->
    </div>
</template>
<script setup>
import { onMounted } from "vue";
import AppButton from "@Components/Form/AppButton.vue";

const props = defineProps({
    message: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(["remove"]);

onMounted(() => {
    setTimeout(() => {
        emit("remove");
    }, props.message.duration);
});
</script>
