<template>
    <div class="min-h-screen bg-neutral-200">
        <header>
            <nav class="py-3">
                <div class="mx-auto max-w-5xl">
                    <div class="mb-4 flex items-center gap-x-5 py-2">
                        <!-- logo -->
                        <Link
                            :href="route('home')"
                            :title="$page.props.app.name.toUpperCase()"
                        >
                            <AppLogo class="text-[1.6em] font-black" />
                        </Link>
                        <!-- logo -->

                        <div class="ml-auto hidden items-center lg:flex">
                            <Link
                                v-if="$page.component === 'Auth/Register'"
                                :href="route('login')"
                                class="rounded-full bg-primary-600 px-4 py-1.5 text-sm font-medium text-white transition hover:bg-primary-700"
                            >
                                {{ __('Login') }}
                            </Link>
                            <Link
                                v-if="$page.component === 'Auth/Login'"
                                :href="route('register')"
                                class="rounded-full bg-primary-600 px-4 py-1.5 text-sm font-medium text-white transition hover:bg-primary-700"
                            >
                                {{ __('Signup') }}
                            </Link>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <slot />
        </main>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';

import AppLogo from '@/Components/Shared/AppLogo.vue';
</script>
