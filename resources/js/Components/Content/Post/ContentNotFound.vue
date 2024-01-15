<template>
    <div class="flex min-h-[15rem] flex-col rounded bg-white shadow">
        <div
            class="flex flex-auto flex-col items-center justify-center p-4 md:p-5"
        >
            <HeFilledDizzy class="h-12 w-12 text-secundary-600" />
            <p
                class="mt-5 text-lg font-medium text-neutral-700 dark:text-gray-300"
            >
                {{ __("There's still nothing here") }}
                <Link
                    :href="route('posts.create')"
                    class="block text-center text-sm font-medium text-blue-600 hover:underline"
                    >{{ __('Create New Content Here') }}</Link
                >
            </p>
        </div>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
</script>
