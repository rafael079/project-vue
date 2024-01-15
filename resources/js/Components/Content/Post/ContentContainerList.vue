<template>
    <div class="col-span-4 grid grid-cols-1 gap-y-2.5 md:col-span-2">
        <!-- skeleton -->
        <template v-if="isLoadingPosts">
            <ContentItemSkeleton v-for="n in 6" :key="n" />
        </template>
        <!-- skeleton -->

        <template v-else>
            <div
                v-for="post in posts"
                :key="post.id"
                class="relative rounded bg-white shadow transition delay-75 duration-300 hover:bg-slate-50"
            >
                <ContentListItem :post="post" />
            </div>

            <ContentNotFound v-if="posts.length === 0" />
        </template>
    </div>
</template>
<script setup>
import { onMounted, ref } from 'vue';

import ContentListItem from '@Components/Content/Post/ContentListItem.vue';
import ContentItemSkeleton from '@Components/Content/Post/ContentItemSkeleton.vue';
import ContentNotFound from '@Components/Content/Post/ContentNotFound.vue';

import ApiPosts from '@/Api/posts';

const props = defineProps({
    category: {
        type: String,
        default: null
    }
});

const isLoadingPosts = ref(false);

const posts = ref([]);

const getPosts = async () => {
    isLoadingPosts.value = true;

    await ApiPosts.index(props.category).then(function (response) {
        posts.value = response.data.data;
        isLoadingPosts.value = false;
    });
};

onMounted(() => {
    getPosts();
});
</script>
