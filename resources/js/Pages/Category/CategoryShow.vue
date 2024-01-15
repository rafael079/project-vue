<template>
    <div>
        <Head>
            <title>{{ props.category.data.name }}</title>
        </Head>
        <div class="mx-auto mt-7 max-w-6xl">
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2">
                    <div class="mb-3 px-2 pb-2 text-right">
                        <h2
                            class="text-xl font-bold lowercase"
                            :style="'color: ' + props.category.data.color"
                        >
                            {{ props.category.data.name }}
                        </h2>
                        <p class="text-sm text-neutral-500">
                            {{ props.category.data.description }}
                        </p>
                    </div>

                    <!-- content list -->
                    <div class="relative">
                        <ContentContainerList
                            :category="props.category.data.id"
                        />
                    </div>
                    <!-- content list -->
                </div>
                <div class="hidden rounded bg-gray-300 md:flex"></div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Head } from '@inertiajs/vue3';
import ContentContainerList from '@/Components/Content/Post/ContentContainerList.vue';

const props = defineProps({
    category: {
        type: Object,
        required: true
    }
});
</script>
