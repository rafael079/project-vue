<template>
    <div>
        <v-select
            v-model="selected"
            label="name"
            :placeholder="__('Select a Category')"
            :options="categories"
            :loading="isLoadingCategories"
            :reduce="(category) => category.id"
        >
            <template #selected-option="{ name, color }">
                <div
                    :style="'background:' + color"
                    class="rounded px-2 pb-0.5 pt-1 text-white"
                >
                    {{ name }}
                </div>
            </template>
            <template #option="{ name, description, color }">
                <div class="pb-0.5 pt-2.5">
                    <h3
                        class="m-0 text-sm font-semibold leading-3"
                        :style="'color:' + color"
                    >
                        {{ name }}
                    </h3>
                    <span class="text-xs">{{ description }}</span>
                </div>
            </template>
            <template #open-indicator="{ attributes }">
                <span v-bind="attributes">
                    <FlFilledChevronDoubleDown
                        class="h-5 w-5 text-neutral-400"
                    />
                </span>
            </template>
            <template #spinner="{ loading }">
                <div v-if="loading">
                    <CgSpinner class="h-7 w-7 animate-spin text-primary-800" />
                </div>
            </template>
        </v-select>
    </div>
</template>
<script setup>
import { onMounted, ref, watch } from 'vue';
import vSelect from 'vue-select';
import ApiCategory from '@/Api/category';

import 'vue-select/dist/vue-select.css';

const isLoadingCategories = ref(false);

const selected = ref('');

const categories = ref([]);

const getCategories = async () => {
    isLoadingCategories.value = true;

    await ApiCategory.index().then(function (response) {
        categories.value = response.data.data;
        isLoadingCategories.value = false;
    });
};

const emit = defineEmits(['selected']);

watch(selected, () => {
    emit('selected', selected.value ?? null);
});

onMounted(() => {
    getCategories();
});
</script>
<style lang="scss">
.v-select {
    @apply rounded border border-neutral-300/70 bg-neutral-100 p-0 text-sm focus-within:border-gray-400 focus-within:bg-neutral-50 focus-within:shadow-sm focus-within:shadow-gray-300;

    .vs__dropdown-toggle {
        @apply border-none bg-transparent p-0;

        .vs__selected-options {
            @apply border-none;

            .vs__selected {
                @apply m-0 py-0 pl-3 font-medium;
            }

            .vs__search {
                @apply border-none bg-transparent px-3.5 py-3 pb-3.5 text-sm ring-0 placeholder:text-neutral-400/80;
            }
        }
        .vs__actions {
            @apply py-0;

            .vs__spinner {
                @apply bg-secundary-600;
            }
        }
    }

    .vs__dropdown-menu {
        @apply border-neutral-200 bg-white shadow-lg;

        .vs__dropdown-option--highlight {
            @apply bg-neutral-200 text-neutral-500;
        }
    }
}

.vs--single {
    &.vs--open .vs__selected,
    &.vs--loading .vs__selected {
        @apply absolute top-1/2 -translate-y-1/2 transform;
    }
}
</style>
