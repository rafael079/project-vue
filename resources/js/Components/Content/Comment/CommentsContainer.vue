<template>
    <div>
        <!-- form -->
        <div class="overflow-hidden rounded bg-white px-6 py-4 shadow">
            <CommentForm
                :placeholder="__('Place your comments')"
                :post-id="props.postId"
                @refresh-comments="forceRerenderComments"
            />
        </div>
        <!-- form -->

        <!-- comments list -->
        <div class="mt-2 grid grid-cols-1 gap-2">
            <CommentList
                :key="componentKey"
                :post-id="props.postId"
                @refresh-comments="forceRerenderComments"
            />
        </div>
        <!-- comments list -->
    </div>
</template>
<script setup>
import { ref } from 'vue';

import CommentForm from '@Components/Content/Comment/CommentForm.vue';
import CommentList from '@Components/Content/Comment/CommentList.vue';

const props = defineProps({
    postId: {
        type: String,
        required: true
    }
});

const componentKey = ref(0);

const forceRerenderComments = () => (componentKey.value += 1);
</script>
