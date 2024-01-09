<template>
    <div>
        <AppButton
            :disabled="form.processing"
            type="button"
            class="absolute bottom-0 left-0 inline-flex w-[9em] items-center justify-center rounded-b-full border border-transparent bg-black bg-opacity-85 px-4 pb-4 pt-2.5 text-xs font-semibold text-white transition-all hover:bg-gray-900/75 focus:outline-none focus:outline-0 focus:ring-0 focus:ring-gray-800 focus:ring-offset-2"
            @click="avatarRef.click()"
        >
            {{ __("Change") }}
        </AppButton>

        <LoaderCard v-if="form.processing" />

        <input
            ref="avatarRef"
            type="file"
            class="hidden"
            accept="image/*"
            @change="uploadAvatar"
            @input="form.avatar = $event.target.files[0]"
        />
    </div>
</template>
<script setup>
import { ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import AppButton from "@Components/Form/AppButton.vue";
import LoaderCard from "@Components/Shared/LoaderCard.vue";
import { trans } from "laravel-vue-i18n";

const avatarRef = ref(null);

const form = useForm({ avatar: null });

const uploadAvatar = () => {
    form.post(route("users.profile.upload.avatar"), {
        onBefore: () => form.clearErrors(),
        onFinish: () => (avatarRef.value.value = null),
        onError: (error) => {
            usePage().props.flash = {
                error: {
                    message: "There is something wrong",
                    description: error.avatar,
                },
            };
        },
    });
};
</script>
