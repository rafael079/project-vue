<template>
    <form @submit.prevent="create">
        <LoaderCard v-if="form.processing || loadingUrlContent">
            {{
                loadingUrlContent
                    ? __('Loading Content! Wait a little bit')
                    : __("Please wait, I'm saving your content")
            }}...
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
                <span
                    class="mb-1 inline-block rounded bg-neutral-100 px-2 py-1 text-sm lowercase text-neutral-400"
                    >{{ __('Category') }} ({{ __('Optional') }})</span
                >
                <CategoryComboSelector @selected="selectCategory" />
            </div>

            <div class="mt-2 flex">
                <TabGroup
                    manual
                    :selected-index="selectedTab"
                    as="div"
                    class="flex w-full flex-wrap gap-y-2"
                    @change="changeTabOptions"
                >
                    <TabList class="flex gap-x-1.5 lowercase">
                        <Tab v-slot="{ selected }" as="div">
                            <AppButton
                                :class="{
                                    'bg-primary-500 text-white hover:bg-primary-700':
                                        selected
                                }"
                                class="group flex items-center rounded bg-neutral-100 px-3 py-1.5 text-sm font-medium text-neutral-500 shadow transition duration-150 focus-within:ring-0"
                            >
                                <McLayout5Fill class="me-1.5 h-4 w-4" />{{
                                    __('Content Text')
                                }}
                            </AppButton>
                        </Tab>

                        <Tab v-slot="{ selected }" as="div">
                            <AppButton
                                :class="{
                                    'bg-primary-500 text-white hover:bg-primary-700':
                                        selected
                                }"
                                class="group flex items-center rounded bg-neutral-100 px-3 py-1.5 text-sm text-neutral-400 shadow transition duration-150 focus-within:ring-0"
                            >
                                <McLink3Fill class="me-1.5 h-4 w-4" />{{
                                    __('Content By Link')
                                }}
                            </AppButton>
                        </Tab>
                        <Tab v-slot="{ selected }" as="div">
                            <AppButton
                                :class="{
                                    'bg-primary-500 text-white hover:bg-primary-700':
                                        selected
                                }"
                                class="group flex items-center rounded bg-neutral-100 px-3 py-1.5 text-sm text-neutral-400 shadow transition duration-150 focus-within:ring-0"
                            >
                                <McPhotoAlbum2Fill class="me-1.5 h-4 w-4" />{{
                                    __('Add Photo & Video')
                                }}
                            </AppButton>
                        </Tab>
                    </TabList>
                    <TabPanels class="flex w-full">
                        <TabPanel class="w-full">
                            <div>
                                <AppTipTapEditor
                                    v-model="form.content"
                                    :placeholder="
                                        __('Place your content (optional)')
                                    "
                                />
                            </div>
                        </TabPanel>
                        <TabPanel as="div" class="flex w-full flex-col">
                            <AppTextArea
                                v-model="form.url"
                                :error="form.errors.url"
                                :placeholder="__('URL To Content')"
                                @change="getContentByUrl"
                            />
                        </TabPanel>
                        <TabPanel>Content photos and videos</TabPanel>
                    </TabPanels>
                </TabGroup>
            </div>

            <div
                v-if="isUrlContent"
                class="rounded border border-secundary-300 bg-neutral-50 p-0.5 shadow sm:flex"
            >
                <div
                    class="relative w-full max-w-[40%] flex-shrink-0 overflow-hidden rounded-bl rounded-tl"
                >
                    <AppImage
                        :src="form.links[0]"
                        :alt="form.title"
                        class="absolute left-0 top-0 h-40 w-full object-cover"
                    />
                </div>
                <div class="flex flex-wrap">
                    <div class="flex h-full flex-col p-1 sm:p-3">
                        <h3
                            class="text-lg font-semibold leading-6 text-gray-800 dark:text-white"
                        >
                            {{ form.title }}
                        </h3>
                        <p
                            class="mt-3 text-xs text-gray-800 dark:text-gray-400"
                        >
                            {{ truncate(form.content, 150) }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-4 border-t border-neutral-100 pt-5">
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
import { ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';
import { trans } from 'laravel-vue-i18n';
import { urlValidation } from '@/Utils/url';

import ApiUrl from '@/Api/url';

import InputText from '@/Components/Form/InputText.vue';
import PrimaryButton from '@/Components/Form/PrimaryButton.vue';
import AppButton from '@/Components/Form/AppButton.vue';
import LoaderCard from '@/Components/Shared/LoaderCard.vue';
import AppTipTapEditor from '@/Components/Form/AppTipTapEditor.vue';
import CategoryComboSelector from '@Components/Content/Category/CategoryComboSelector.vue';
import AppTextArea from '@/Components/Form/AppTextArea.vue';
import AppImage from '@/Components/Shared/AppImage.vue';
import { truncate } from '@/Utils/text';

const selectedTab = ref(0);

const loadingUrlContent = ref(false);

const isUrlContent = ref(false);

const form = useForm({
    title: '',
    content: '',
    category: '',
    url: '',
    links: ''
});

const changeTabOptions = (data) => {
    selectedTab.value = data;
};

const selectCategory = (data) => {
    form.category = data;
};

const getContentByUrl = async (event) => {
    const source = event.target.value;

    loadingUrlContent.value = true;

    form.errors.url = '';

    if (!urlValidation(source)) {
        form.errors.url = trans('The provided URL does not seem to be valid');
        loadingUrlContent.value = false;
        return;
    }

    const { title, excerpt, images } = await ApiUrl.getContentByUrl(
        source
    ).then((response) => {
        loadingUrlContent.value = false;
        return response.data.data;
    });

    form.title = title;
    form.content = excerpt;
    form.links = images;

    isUrlContent.value = true;
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
