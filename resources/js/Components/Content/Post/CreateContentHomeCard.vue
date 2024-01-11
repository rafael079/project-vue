<template>
    <div class="flex gap-2 rounded bg-white p-2 shadow">
        <div
            class="relative h-12 w-12 overflow-hidden rounded-full bg-neutral-200 p-0.5 text-center"
        >
            <UserAvatar
                :user="{
                    avatar: $page.props.auth.user.avatar,
                    first_name: $page.props.auth.user.first_name
                }"
            />
        </div>
        <div class="ms-1 w-[90%]">
            <div
                class="w-full cursor-pointer rounded border border-neutral-200 bg-neutral-100 px-5 py-3.5 text-sm font-normal lowercase text-neutral-400 transition delay-100 hover:bg-stone-300/40"
                @click="openCreateContentForm"
            >
                {{ __('Create your content here') }}
            </div>
            <div class="mt-2 flex flex-wrap gap-x-2 lowercase">
                <Link
                    href="#"
                    class="flex items-center rounded-full bg-neutral-100 px-3 py-1.5 text-xs font-medium text-neutral-400 shadow hover:bg-primary-100/75 hover:text-secundary-600 hover:underline"
                >
                    <McLink3Fill class="me-1.5 h-4 w-4 text-green-600" />{{
                        __('Add Content By Link')
                    }}
                </Link>
                <Link
                    href="#"
                    class="flex items-center rounded-full bg-neutral-100 px-3 py-1.5 text-xs font-medium text-neutral-400 shadow hover:bg-primary-100/75 hover:text-secundary-600 hover:underline"
                >
                    <GlMediaBroken class="me-1.5 h-4 w-4 text-fuchsia-600" />{{
                        __('Add Images & Video')
                    }}
                </Link>
                <Link
                    href="#"
                    class="flex items-center rounded-full bg-neutral-100 px-3 py-1.5 text-xs font-medium text-neutral-400 shadow hover:bg-primary-100/75 hover:text-secundary-600 hover:underline"
                >
                    <BxDotsHorizontalRounded
                        class="me-1.5 h-4 w-4 text-orange-600"
                    />{{ __('More Options') }}
                </Link>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Link, router } from '@inertiajs/vue3';
import UserAvatar from '@Components/User/UserAvatar.vue';

const openCreateContentForm = () => {
    router.visit(route('posts.create'), {
        preserveScroll: true,
        preserveState: true
    });
};
</script>
