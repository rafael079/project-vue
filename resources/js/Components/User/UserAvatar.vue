<template>
    <div>
        <img
            v-if="props.user.avatar"
            :alt="props.user.first_name"
            :src="
                route('image', {
                    path: `users/avatar/${props.user.avatar}`,
                    fm: 'webp',
                    q: 50,
                })
            "
            class="absolute left-0 top-0 h-full w-full rounded-full object-cover object-center p-px text-gray-300"
        />

        <CaUserFilled
            v-else
            v-bind="$attrs"
            :title="$page.props.user.first_name"
            class="absolute left-0 top-1 h-full w-full object-cover object-center text-white"
        />

        <UserUploadAvatar
            v-if="
                props.editable &&
                $page.props.auth.user &&
                $page.props.permissions &&
                $page.props.permissions.edit
            "
        />
    </div>
</template>
<script setup>
import UserUploadAvatar from "@Components/User/UserUploadAvatar.vue";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    editable: {
        type: Boolean,
        default: false,
    },
});

defineOptions({
    inheritAttrs: false,
});
</script>
