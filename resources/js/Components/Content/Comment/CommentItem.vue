<template>
    <div>
        <div class="flex flex-row">
            <!-- avatar -->
            <div
                class="relative top-2 h-12 w-12 overflow-hidden rounded-full bg-neutral-200"
            >
                <Link
                    :href="
                        route('users.profile.show', {
                            username: comment.author.username
                        })
                    "
                    :title="comment.author.username"
                >
                    <UserAvatar :user="comment.author" />
                </Link>
            </div>
            <!-- avatar -->

            <!-- content -->
            <div
                class="ms-2 mt-1 w-[95%] flex-col bg-neutral-200/70 py-4 sm:rounded-lg"
            >
                <div
                    class="flex flex-1 items-center px-4 font-bold lowercase leading-tight"
                >
                    <Link
                        :href="'#'"
                        class="text-blue-500 hover:text-blue-700 hover:underline"
                    >
                        {{ comment.author.username }}
                    </Link>
                    <span class="ml-1.5 text-xs font-normal text-gray-500">
                        {{ comment.created_at }}
                    </span>
                </div>
                <div
                    class="ml-2 flex-1 px-2 text-sm font-medium leading-loose text-gray-600"
                >
                    {{ comment.message }}
                </div>
            </div>
            <!-- content -->
        </div>
        <!-- comment options -->
        <div class="relative ms-0.5 mt-1 flex flex-col ps-4">
            <div class="w-full">
                <AppButton
                    class="flex-column ms-8 inline-flex items-center rounded px-2 py-0.5 text-xs font-semibold text-neutral-400 hover:text-primary-600 hover:underline"
                    :class="{
                        '!text-primary-600': showReply[comment.id]
                    }"
                    @click="toggleReply(props.comment.id)"
                >
                    <MdOutlinedReplyAll class="me-2 inline-block h-3 w-3" />
                    {{ __('Reply') }}
                </AppButton>
            </div>

            <!-- reply form -->
            <div
                v-if="showReply[comment.id]"
                class="mb-3 ms-9 mt-1 block w-[95%] rounded bg-neutral-50 px-1 py-2 shadow-sm"
            >
                <CommentForm
                    :placeholder="__('Place your comments')"
                    :post-id="props.postId"
                    :parent-comment-id="comment.id"
                    :rows="2"
                    @refresh-comments="sendingResponse"
                />
            </div>
            <!-- reply form -->

            <div v-if="comment.replies.length" class="relative ms-1 ps-5">
                <template v-for="reply in comment.replies" :key="reply.id">
                    <CommentItem
                        :comment="reply"
                        :post-id="props.postId"
                        @refresh-comments="sendingResponse"
                    />
                </template>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

import UserAvatar from '@/Components/User/UserAvatar.vue';
import AppButton from '@/Components/Form/AppButton.vue';
import CommentForm from '@/Components/Content/Comment/CommentForm.vue';

const props = defineProps({
    postId: {
        type: String,
        required: true
    },
    comment: {
        type: Object,
        required: true
    }
});

const emit = defineEmits(['refreshComments']);

const showReply = ref([]);

const toggleReply = (comment_id) => {
    showReply.value[comment_id] = !showReply.value[comment_id];
};

const sendingResponse = () => {
    showReply.value = [];
    emit('refreshComments');
};
</script>
