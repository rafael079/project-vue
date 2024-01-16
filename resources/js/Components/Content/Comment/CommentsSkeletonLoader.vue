<template>
    <div>
        <div
            role="status"
            class="animate-pulse space-y-8 md:flex md:items-center md:space-x-3 md:space-y-0"
        >
            <div
                class="relative flex h-[3em] w-[3.25em] items-center justify-center overflow-hidden rounded-full bg-neutral-200"
            >
                <CaUserFilled
                    class="absolute top-1 h-full w-full text-neutral-50"
                />
            </div>
            <div
                class="ms-1.5 mt-1 w-full flex-col bg-neutral-200/50 px-4 py-4 sm:rounded-lg"
            >
                <div
                    class="mb-2.5 h-2 max-w-[480px] rounded-full bg-neutral-200"
                ></div>
                <div class="mb-2.5 h-2 rounded-full bg-neutral-200"></div>
                <div
                    class="mb-2.5 h-2 max-w-[440px] rounded-full bg-neutral-200"
                ></div>
                <div
                    class="mb-2.5 h-2 max-w-[460px] rounded-full bg-neutral-200"
                ></div>
                <div
                    class="h-2 max-w-[360px] rounded-full bg-gray-200 dark:bg-gray-700"
                ></div>
            </div>
            <span class="sr-only">{{ __('Loading') }}...</span>
        </div>
    </div>
</template>
<script setup></script>
