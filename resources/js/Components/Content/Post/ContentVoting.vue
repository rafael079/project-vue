<template>
    <div class="flex flex-row items-center gap-x-1 px-2 py-1.5">
        <AppButton
            v-tooltip="{ content: __('I liked'), placement: 'left' }"
            :class="{
                'scale-110 !text-secundary-600': vote === 'up'
            }"
            class="text-neutral-500"
            @click="setVote('up')"
        >
            <HiSolidHandThumbUp
                class="h-5 w-5 transition-all hover:text-primary-600"
            />
        </AppButton>
        <div
            class="inline-block rounded-full bg-neutral-50 px-1.5 py-0.5 align-middle text-[0.79rem] font-semibold leading-5 text-neutral-600"
        >
            {{ abbreviateNumber(totalVotes) }}
        </div>
        <AppButton
            v-tooltip="{ content: __('I did not like'), placement: 'right' }"
            :class="{
                'scale-110 !text-secundary-600': vote === 'down'
            }"
            class="text-neutral-500"
            @click="setVote('down')"
        >
            <HiSolidHandThumbDown
                class="h-5 w-5 transition-all hover:text-primary-600"
            />
        </AppButton>
    </div>
</template>
<script setup>
import { inject, ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { abbreviateNumber } from '@/Utils/numbers';
import { trans } from 'laravel-vue-i18n';
import useAuth from '@/Composable/useAuth';
import ApiVoting from '@/Api/voting';
import AppButton from '@/Components/Form/AppButton.vue';

const getEmitter = inject('emitter');

const isProcessing = ref(false);

const props = defineProps({
    post: {
        type: Object,
        required: true
    }
});

const vote = ref(
    props.post.has_voted ? (props.post.has_upvoted ? 'up' : 'down') : null
);

const currentVote = ref(
    props.post.has_voted ? (props.post.has_upvoted ? 'up' : 'down') : null
);

const totalVotes = ref(props.post.total_votes ?? 0);

const setVote = (data) => {
    if (!useAuth().checkAuth(getEmitter)) {
        return false;
    }

    if (vote.value === data) {
        vote.value = null;
        totalVotes.value =
            data === 'up' ? totalVotes.value - 1 : totalVotes.value + 1;
    } else {
        if (vote.value) {
            if (data === 'up') {
                totalVotes.value =
                    vote.value === 'down'
                        ? totalVotes.value + 2
                        : totalVotes.value + 1;
            }
            if (data === 'down') {
                totalVotes.value =
                    vote.value === 'up'
                        ? totalVotes.value - 2
                        : totalVotes.value - 1;
            }
        } else {
            totalVotes.value =
                data === 'up' ? totalVotes.value + 1 : totalVotes.value - 1;
        }

        vote.value = data;
    }

    if (props.post && props.post.id) {
        ApiVoting.store({
            post_id: props.post.id,
            vote: data,
            current: currentVote.value
        })
            .then((result) => {
                if (result.data.data) {
                    currentVote.value = result.data.data.is_down_vote
                        ? 'down'
                        : 'up';
                } else {
                    currentVote.value = null;
                }

                isProcessing.value = false;
            })
            .catch(() => {
                usePage().props.flash = {
                    error: trans(
                        'An error occurred with your request, please try again'
                    )
                };
                isProcessing.value = false;
            });
    }
    return;
};
</script>
