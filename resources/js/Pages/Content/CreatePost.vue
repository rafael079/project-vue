<template>
    <div>
        <Head>
            <title>{{ __('Create a New Content') }}</title>
        </Head>
        <div class="mx-auto mt-5 max-w-6xl">
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2 grid gap-y-2">
                    <div
                        class="relative overflow-hidden rounded bg-white shadow"
                    >
                        <div class="rounded-t border-b border-neutral-100 px-8 py-3">
                            <h2
                                class="block items-center text-xl font-bold uppercase tracking-tight text-neutral-500"
                            >
                                <McClassify2Line
                                    class="me-1 mt-2 inline-block h-7 w-7 opacity-35"
                                />
                                {{ __('Create new Content') }}
                            </h2>
                            <p
                                class="ms-9 text-xs tracking-tight text-neutral-400"
                            >
                                {{
                                    __(
                                        'This space is yours to create your content. You can post news, photos, videos, etc.'
                                    )
                                }}?
                            </p>
                        </div>
                        <div class="px-8 py-5">
                            <CreateContentForm />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Head } from '@inertiajs/vue3';
import CreateContentForm from '@Components/Content/Post/CreateContentForm.vue';
</script>
