<template>
    <div class="flex min-h-[7rem] flex-col">
        <div
            class="flex flex-auto flex-col items-center justify-center p-4 md:p-5"
        >
            <FlCommentOff class="h-10 w-10 text-secundary-600 opacity-25" />
            <p
                class="mt-2.5 text-lg font-medium text-neutral-700 dark:text-gray-300"
            >
                {{ __('There are no comments here yet') }}
            </p>
        </div>
    </div>
</template>
<script setup></script>
