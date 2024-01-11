<template>
    <div>
        <AppButton
            :disabled="$page.component === 'Content/CreatePost'"
            :title="__('Create your content here')"
            class="me-3 rounded-full border border-transparent bg-neutral-100 px-1 py-1 text-secundary-600 shadow transition delay-100 hover:bg-neutral-200 hover:text-secundary-800"
            @click="openCreateContentForm"
        >
            <MdOutlinedAdd class="h-6 w-6" />
        </AppButton>
    </div>
</template>
<script setup>
import { router } from '@inertiajs/vue3';
import AppButton from '@/Components/Form/AppButton.vue';

const openCreateContentForm = () => {
    router.visit(route('posts.create'), { preserveScroll: true });
};
</script>
