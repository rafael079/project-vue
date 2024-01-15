<template>
    <div class="flex h-fit w-full rounded bg-white p-1 shadow">
        <div class="grid w-full grid-cols-1">
            <div
                v-for="category in categories"
                :key="category.id"
                class="flex w-full items-center justify-between px-3 odd:bg-neutral-50 hover:bg-primary-50"
            >
                <Link
                    :href="
                        route('category.show', {
                            category: category.id,
                            slug: category.slug
                        })
                    "
                    :title="category.name"
                    class="flex w-full rounded py-2 text-sm font-medium lowercase"
                    :style="'color:' + category.color"
                >
                    {{ category.name }}
                </Link>
            </div>
        </div>
    </div>
</template>
<script setup>
import { onMounted, ref } from 'vue';
import { Link } from '@inertiajs/vue3';

import ApiCategory from '@/Api/category';

const isLoadingCategories = ref(false);

const categories = ref([]);

const getCategories = async () => {
    isLoadingCategories.value = true;

    await ApiCategory.index().then(function (response) {
        categories.value = response.data.data;
        isLoadingCategories.value = false;
    });
};

onMounted(() => {
    getCategories();
});
</script>
