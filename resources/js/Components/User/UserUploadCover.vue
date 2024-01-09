<template>
    <div>
        <AppButton
            :title="__('Edit Cover')"
            class="absolute right-1.5 top-2.5 mb-2 mr-2 rounded-full bg-neutral-800 bg-opacity-95 px-5 py-1.5 text-sm font-medium text-white shadow transition-all hover:bg-neutral-700 focus:outline-none focus:ring-4 focus:ring-neutral-300"
            @click="coverRef.click()"
        >
            <FlCameraEdit class="inline-block h-6 w-6 opacity-60 sm:mr-1.5" />

            <span class="hidden sm:inline-flex">
                {{ __("Edit Cover") }}
            </span>
        </AppButton>

        <LoaderCard v-if="form.processing">
            {{ __("Updating Your Cover") }}...
        </LoaderCard>

        <input
            ref="coverRef"
            type="file"
            accept="image/*"
            class="hidden"
            @change="uploadCover"
            @input="form.cover = $event.target.files[0]"
        />
    </div>
</template>
<script setup>
import { ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import AppButton from "@Components/Form/AppButton.vue";
import LoaderCard from "@Components/Shared/LoaderCard.vue";
import { trans } from "laravel-vue-i18n";

const coverRef = ref(null);

const form = useForm({ cover: "" });

const uploadCover = () => {
    form.post(route("users.profile.upload.cover"), {
        onBefore: () => form.clearErrors(),
        onFinish: () => (coverRef.value.value = null),
        onError: (error) => {
            usePage().props.flash = {
                error: {
                    message: trans("There is something wrong"),
                    description: error.cover,
                },
            };
        },
    });
};
</script>
