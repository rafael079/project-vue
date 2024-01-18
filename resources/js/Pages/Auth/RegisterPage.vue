<template>
    <div>
        <Head>
            <title>{{ __('Signup') }}</title>
        </Head>
        <div class="mx-auto max-w-5xl">
            <div class="grid grid-cols-2 gap-7">
                <div class="col-span-1 my-auto text-left">
                    <h2
                        class="text-4xl font-bold text-neutral-700 drop-shadow-sm"
                    >
                        {{ __('Sign up') }}
                    </h2>
                    <p
                        class="mt-7 text-sm text-neutral-600 dark:text-neutral-400"
                    >
                        {{ __('Already have an account') }}?
                        <Link
                            :href="route('login')"
                            :title="__('Login Here')"
                            class="ms-1 font-medium text-blue-600 decoration-2 hover:underline"
                        >
                            {{ __('Login Here') }}
                        </Link>
                    </p>
                </div>
                <div>
                    <div class="relative rounded-lg bg-white p-5 shadow">
                        <SignupForm />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Head, Link } from '@inertiajs/vue3';

import GuestLayout from '@/Layouts/GuestLayout.vue';
import SignupForm from '@/Components/User/SignupForm.vue';

defineOptions({ layout: GuestLayout });
</script>
