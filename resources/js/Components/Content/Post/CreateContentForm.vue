<template>
    <form @submit.prevent="create">
        <LoaderCard v-if="form.processing">
            {{ __("Please wait, I'm saving your content") }}...
        </LoaderCard>

        <div class="grid gap-y-4 py-3">
            <div>
                <InputText
                    id="post-title"
                    v-model="form.title"
                    :placeholder="__('Post Title Here')"
                    :error="form.errors.title"
                    autofocus
                    type="text"
                    required
                    :max-length="300"
                    class="py-4 text-lg placeholder:text-neutral-400"
                >
                    <template #suffix>
                        <FlSlideContent class="h-5 w-5 opacity-15" />
                    </template>
                </InputText>
            </div>
            <div>
                <PrimaryButton
                    :loading="form.processing"
                    type="submit"
                    class="rounded px-5 py-3 font-semibold"
                >
                    {{ __('Publish') }}
                </PrimaryButton>

                <AppButton
                    class="ms-5 text-sm font-semibold lowercase text-blue-600 hover:underline"
                    @click="close"
                >
                    {{ __('Cancel') }}
                </AppButton>
            </div>
        </div>
    </form>
</template>
<script setup>
import { router, useForm } from '@inertiajs/vue3';
import InputText from '@/Components/Form/InputText.vue';
import PrimaryButton from '@/Components/Form/PrimaryButton.vue';
import AppButton from '@/Components/Form/AppButton.vue';
import LoaderCard from '@/Components/Shared/LoaderCard.vue';

const form = useForm({
    title: ''
});

const create = () => {
    form.post(route('posts.store'), {
        onSuccess: () => {
            form.reset();
        }
    });
};

const close = () => {
    router.visit(route('home'), { preserveScroll: true });
};
</script>
