<template>
    <div class="mt-2 text-xs text-neutral-500">
        <Link
            :href="
                route('users.profile.show', {
                    username: post.author.username
                })
            "
            :title="post.author.username"
            class="font-semibold text-secundary-600 hover:text-secundary-800 hover:underline"
        >
            <span
                class="relative me-1.5 inline-block h-6 w-6 overflow-hidden rounded-full bg-neutral-200 p-1 align-middle"
            >
                <UserAvatar
                    :user="{
                        avatar: post.author.avatar,
                        first_name: post.author.first_name
                    }"
                /> </span
            >{{ post.author.username }}
        </Link>
        {{ __('at') }}
        {{ post.created_at }}
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import UserAvatar from '@/Components/User/UserAvatar.vue';

const props = defineProps({
    post: {
        type: Object,
        required: true
    }
});
</script>
