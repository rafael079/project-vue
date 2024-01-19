<template>
    <AppButton
        class="flex items-center gap-x-2 rounded bg-secundary-500 px-3 py-1.5 font-medium text-white hover:bg-secundary-700 hover:shadow"
        @click="follow"
    >
        <CaUserFavorite class="h-4 w-4" />
        {{ hasFollowed ? __('Unfollow') : __('Follow') }}
    </AppButton>
</template>
<script setup>
import { ref } from 'vue';
import { trans } from 'laravel-vue-i18n';
import { usePage } from '@inertiajs/vue3';

import AppButton from '@/Components/Form/AppButton.vue';

import ApiUser from '@/Api/users';

const props = defineProps({
    user: {
        type: Object,
        required: true
    }
});

const hasFollowed = ref(props.user.hasFollowed);

const follow = async () => {
    await ApiUser.following(props.user.username).then(function (response) {
        if (response.data === 'follow') {
            usePage().props.flash = {
                success: {
                    message: trans('Now you are following: @:username', {
                        username: props.user.username
                    }),
                    placement: 'top'
                }
            };

            hasFollowed.value = true;
        }

        if (response.data === 'unfollow') {
            usePage().props.flash = {
                success: {
                    message: trans('You stopped following: @:username', {
                        username: props.user.username
                    }),
                    placement: 'top'
                }
            };
            hasFollowed.value = false;
        }
    });
};
</script>
