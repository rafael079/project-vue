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
            <div class="mt-2 flex flex-wrap gap-x-1.5 lowercase">
                <Link
                    href="#"
                    class="group flex items-center rounded rounded-s-none border-l-2 border-orange-400 bg-orange-100 px-2 py-1 text-sm font-medium text-neutral-500 shadow-inner transition duration-150 hover:text-neutral-600"
                >
                    <McLayout5Fill
                        class="me-1.5 h-4 w-4 text-orange-600 group-hover:text-orange-600"
                    />{{ __('Content Text') }}
                </Link>
                <Link
                    href="#"
                    class="group flex items-center rounded bg-neutral-100 px-2 py-1 text-sm text-neutral-400 transition duration-150 hover:bg-fuchsia-100 hover:text-neutral-600 hover:shadow"
                >
                    <McPhotoAlbum2Fill
                        class="me-1.5 h-4 w-4 group-hover:text-fuchsia-600"
                    />{{ __('Add Photo & Video') }}
                </Link>
                <Link
                    href="#"
                    class="group flex items-center rounded bg-neutral-100 px-2 py-1 text-sm text-neutral-400 transition duration-150 hover:bg-green-100 hover:text-neutral-600 hover:shadow"
                >
                    <McLink3Fill
                        class="me-1.5 h-4 w-4 group-hover:text-green-600"
                    />{{ __('Content By Link') }}
                </Link>
            </div>
            <div>
                <AppTipTapEditor
                    v-model="form.content"
                    :placeholder="__('Place your content (optional)')"
                />
            </div>

            <div>
                <span
                    class="mb-1 inline-block rounded bg-neutral-100 px-2 py-1 text-sm lowercase text-neutral-400"
                    >{{ __('Category') }} ({{ __('Optional') }})</span
                >
                <CategoryComboSelector @selected="selectCategory" />
            </div>
            <div class="border-t border-neutral-100 mt-4 pt-5">
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
import { Link, router, useForm } from '@inertiajs/vue3';
import InputText from '@/Components/Form/InputText.vue';
import PrimaryButton from '@/Components/Form/PrimaryButton.vue';
import AppButton from '@/Components/Form/AppButton.vue';
import LoaderCard from '@/Components/Shared/LoaderCard.vue';
import AppTipTapEditor from '@/Components/Form/AppTipTapEditor.vue';
import CategoryComboSelector from '@Components/Content/Category/CategoryComboSelector.vue';

const form = useForm({
    title: '',
    content: '',
    category: ''
});

const selectCategory = (data) => {
    form.category = data;
};

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
