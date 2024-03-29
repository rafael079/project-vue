<template>
    <div>
        <Head>
            <title>{{ user.first_name }}</title>
        </Head>
        <div class="mx-auto mt-5 max-w-6xl">
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2">
                    <div
                        class="relative overflow-hidden rounded border border-neutral-300 bg-white p-px shadow-sm"
                    >
                        <div class="h-28 overflow-hidden rounded-t">
                            <UserCover :cover="props.user.cover" />
                        </div>
                        <div
                            class="relative -mt-16 ms-8 h-28 w-28 overflow-hidden rounded-full border-4 border-white bg-neutral-200 shadow"
                        >
                            <UserAvatar
                                class="mt-2.5"
                                :user="{
                                    avatar: props.user.avatar,
                                    first_name: props.user.first_name
                                }"
                                :editable="true"
                            />
                        </div>
                        <div
                            class="relative mb-4 mt-3 flex gap-x-2 ps-8 text-left"
                        >
                            <div class="py-2 pe-2">
                                <div>
                                    <h3
                                        class="inline-block text-xl font-bold text-neutral-700"
                                    >
                                        {{ user.first_name }}
                                        {{ user.last_name }}
                                    </h3>
                                </div>
                                <p
                                    class="flex text-xs font-medium text-neutral-500"
                                >
                                    <span> @{{ user.username }} </span>
                                </p>
                                <div
                                    class="my-2 flex gap-x-1.5 divide-x text-xs text-neutral-500"
                                >
                                    <span class="inline-flex">{{
                                        __(':followers followers', {
                                            followers:
                                                abbreviateNumber(
                                                    user.followers_count
                                                ) ?? 0
                                        })
                                    }}</span>
                                    <span class="inline-flex ps-1.5">{{
                                        __(':followings followings', {
                                            followings:
                                                abbreviateNumber(
                                                    user.followings_count
                                                ) ?? 0
                                        })
                                    }}</span>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <UserEditProfile
                                    v-if="
                                        $page.props.auth.user &&
                                        $page.props.permissions.edit
                                    "
                                />
                            </div>
                            <div class="ml-auto flex items-center px-5">
                                <UserFollowButton
                                    v-if="
                                        $page.props.auth.user &&
                                        $page.props.auth.user.username !=
                                            user.username
                                    "
                                    :user="{
                                        username: user.username,
                                        hasFollowed: user.has_followed
                                    }"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="grid grid-cols-1 gap-3 rounded bg-gray-300 p-6"
                ></div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Head } from '@inertiajs/vue3';
import { abbreviateNumber } from '@/Utils/numbers';

import UserCover from '@Components/User/UserCover.vue';
import UserAvatar from '@/Components/User/UserAvatar.vue';
import UserEditProfile from '@/Components/User/UserEditProfile.vue';
import UserFollowButton from '@/Components/User/UserFollowButton.vue';

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    permissions: {
        type: Object,
        required: true
    }
});
</script>
