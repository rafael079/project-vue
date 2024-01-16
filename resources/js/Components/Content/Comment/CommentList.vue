<template>
    <div class="overflow-hidden rounded bg-white px-6 py-4 shadow">
        <template v-if="isLoadingComments">
            <CommentsSkeletonLoader v-for="n in 4" :key="n" class="mt-3" />
        </template>
        <template v-else-if="comments">
            <div
                v-for="(comment, index) in comments"
                :key="index"
                class="relative flex w-full flex-col py-2 text-sm"
            >
                <CommentItem
                    :comment="comment"
                    :post-id="props.postId"
                    @refresh-comments="getComments()"
                />
            </div>
        </template>
    </div>
</template>
<script setup>
import { onMounted, ref } from 'vue';

import CommentsSkeletonLoader from '@Components/Content/Comment/CommentsSkeletonLoader.vue';
import CommentItem from '@Components/Content/Comment/CommentItem.vue';

import ApiComments from '@/Api/comments';

const isLoadingComments = ref(false);

const comments = ref(null);

const props = defineProps({
    postId: {
        type: String,
        required: true
    }
});

const getComments = async () => {
    isLoadingComments.value = true;

    ApiComments.index(props.postId).then(function (response) {
        isLoadingComments.value = false;
        comments.value = response.data.data;
    });
};

onMounted(() => getComments());
</script>
