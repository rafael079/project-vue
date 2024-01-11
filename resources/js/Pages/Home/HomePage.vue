<template>
    <div class="mx-auto mt-7 max-w-6xl">
        <div class="grid grid-cols-4 gap-4">
            <div class="hidden rounded bg-gray-300 md:flex"></div>
            <div class="col-span-4 grid grid-cols-1 gap-y-3 md:col-span-2">
                <!-- create content -->
                <CreateContentHomeCard v-if="$page.props.auth.user" />
                <!-- create content -->

                <!-- content list -->
                <div class="relative">
                    <ContentContainerList />
                </div>
                <!-- content list -->
            </div>
            <div class="hidden rounded bg-gray-300 md:flex"></div>
        </div>
    </div>
</template>
<script setup>
import ContentContainerList from '@/Components/Content/Post/ContentContainerList.vue';
import CreateContentHomeCard from '@Components/Content/Post/CreateContentHomeCard.vue';
</script>
