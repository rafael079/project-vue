<template>
    <div
        class="block h-auto w-full rounded-t bg-gradient-to-r from-orange-400 via-secundary-600 to-fuchsia-500 bg-fixed py-16"
        :style="[
            props.cover
                ? {
                      background:
                          '#505050 url(' +
                          route('image', {
                              path: `users/cover/${props.cover}`,
                              q: 50,
                              fm: 'webp',
                          }) +
                          ') no-repeat center center',
                      'background-size': 'cover',
                  }
                : '',
        ]"
    >
        <UserUploadCover
            v-if="$page.props.auth.user && $page.props.permissions.edit"
        />
    </div>
</template>
<script setup>
import UserUploadCover from "@Components/User/UserUploadCover.vue";

const props = defineProps({
    cover: {
        type: String,
        default: null,
    },
});
</script>
