<template>
    <Teleport to="body">
        <TransitionRoot :show="props.show" appear as="template">
            <Dialog as="div" class="relative z-50" @close="close">
                <!-- backdrop -->
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="duration-200 ease-in"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div
                        :class="[
                            props.backdrop ? blurEffectClass : '',
                            {
                                'bg-neutral-900 bg-opacity-50': props.backdrop
                            }
                        ]"
                        class="fixed inset-0"
                    />
                </TransitionChild>
                <!-- backdrop -->

                <!-- content -->
                <div :class="placementClass" class="fixed">
                    <div
                        class="flex min-h-full items-center justify-center p-5 text-center"
                    >
                        <TransitionChild
                            as="template"
                            enter="transition ease-out duration-100"
                            enter-from="transform opacity-0 scale-95"
                            enter-to="transform opacity-100 scale-100"
                            leave="transition ease-in duration-75"
                            leave-from="transform opacity-100 scale-100"
                            leave-to="transform opacity-0 scale-95"
                        >
                            <DialogPanel
                                :class="[
                                    maxWidthClass,
                                    { 'shadow-neutral-400': !props.backdrop },
                                    { 'shadow-neutral-600': props.backdrop }
                                ]"
                                class="relative w-full transform overflow-hidden rounded bg-white text-left align-middle shadow transition-all"
                            >
                                <DialogTitle>
                                    <AppButton
                                        class="absolute right-2.5 top-2 inline-flex items-center rounded-full bg-neutral-200 p-1 text-neutral-800 shadow-inner shadow-neutral-300 hover:bg-neutral-300 hover:shadow-none"
                                        :title="__('Close')"
                                        @click="$emit('close')"
                                    >
                                        <McCloseFill
                                            class="h-4 w-4 text-inherit opacity-50"
                                        />
                                        <span class="sr-only">
                                            {{ __('Close') }}
                                        </span>
                                    </AppButton>
                                </DialogTitle>
                                <DialogDescription>
                                    <slot />
                                </DialogDescription>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
                <!-- content -->
            </Dialog>
        </TransitionRoot>
    </Teleport>
</template>
<script setup>
import { computed, onMounted, onUnmounted } from 'vue';
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
    DialogDescription
} from '@headlessui/vue';
import AppButton from '@Components/Form/AppButton.vue';
const props = defineProps({
    backdrop: {
        type: Boolean,
        default: true
    },
    blurEffect: {
        type: String,
        default: null
    },
    closeable: {
        type: Boolean,
        default: true
    },
    maxWidth: {
        type: String,
        default: '2xl'
    },
    placement: {
        type: String,
        default: 'top-center'
    },
    show: {
        type: Boolean,
        default: false
    }
});

const blurEffectClass = computed(() => {
    return {
        sm: 'backdrop-blur-sm',
        lg: 'backdrop-blur-lg',
        xl: 'backdrop-blur-xl',
        '2xl': 'backdrop-blur-2xl',
        '3xl': 'backdrop-blur-3xl'
    }[props.blurEffect];
});

const maxWidthClass = computed(() => {
    return {
        sm: 'sm:max-w-sm',
        md: 'sm:max-w-md',
        lg: 'sm:max-w-lg',
        xl: 'sm:max-w-xl',
        '2xl': 'sm:max-w-2xl',
        '3xl': 'sm:max-w-3xl',
        '4xl': 'sm:max-w-4xl'
    }[props.maxWidth];
});

const placementClass = computed(() => {
    return {
        'top-center': 'inset-x-0 top-1 overflow-y-auto 2xl:top-5',
        center: 'inset-x-0 top-1/2 -translate-y-1/2 overflow-y-auto',
        'bottom-center': 'inset-x-0 bottom-1 overflow-y-auto 2xl:bottom-5'
    }[props.placement];
});

const emit = defineEmits(['close']);

const close = () => {
    if (props.closeable) {
        emit('close');
    }
};

const closeOnEscape = (e) => {
    if (e.key === 'Escape' && props.show) {
        emit('close');
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));

onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);
    document.body.style.overflow = null;
});
</script>
