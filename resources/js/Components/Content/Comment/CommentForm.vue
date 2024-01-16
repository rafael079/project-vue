<template>
    <form class="relative" @submit.prevent="create">
        <LoaderCard v-if="form.processing" />

        <div>
            <label class="sr-only">{{ __('Place your comment') }}</label>
            <div class="overflow-hidden rounded">
                <AppTextArea
                    id="comment-input"
                    :key="componentKey"
                    v-model="form.message"
                    required
                    :placeholder="props.placeholder"
                    :rows="props.rows"
                />

                <div class="flex items-center justify-end gap-2 pt-3">
                    <AppButton
                        type="submit"
                        class="ml-auto flex items-center rounded border border-primary-600 bg-primary-600 px-3 py-1.5 text-sm font-medium lowercase text-white shadow-sm transition hover:bg-primary-700"
                    >
                        {{ __('Send Comment') }}
                    </AppButton>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

import LoaderCard from '@Components/Shared/LoaderCard.vue';
import AppTextArea from '@Components/Form/AppTextArea.vue';
import AppButton from '@Components/Form/AppButton.vue';

const componentKey = ref(0);

const props = defineProps({
    placeholder: {
        type: String,
        default: ''
    },
    postId: {
        type: String,
        required: true
    },
    parentCommentId: {
        type: String,
        default: null
    },
    rows: {
        type: Number,
        default: 3
    }
});

const form = useForm({
    message: '',
    post_id: props.postId,
    parent_comment_id: props.parentCommentId
});

const forceRenderComponent = () => (componentKey.value += 1);

const emit = defineEmits(['refreshComments']);

const create = () => {
    form.post(route('posts.comments.store'), {
        onSuccess: () => {
            form.reset();
            forceRenderComponent();
            emit('refreshComments');
        }
    });
};
</script>
