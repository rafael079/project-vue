<template>
    <div class="min-h-screen bg-neutral-200">
        <header class="sticky top-0 z-30">
            <nav class="border-b border-neutral-300 bg-white/95 shadow-sm">
                <div class="mx-auto max-w-6xl">
                    <div class="flex items-center gap-x-5">
                        <!-- logo -->
                        <Link
                            :href="route('home')"
                            :aria-label="$page.props.app.name"
                        >
                            <AppLogo class="text-[1.95em]" />
                        </Link>
                        <!-- logo -->

                        <!-- search -->
                        <div
                            class="hidden w-96 rounded-full bg-neutral-200 py-1.5 px-3 text-sm text-neutral-500 lg:flex"
                        >
                            search
                        </div>
                        <!-- search -->

                        <!-- users -->
                        <div
                            class="ml-auto hidden items-center gap-x-1 lg:flex"
                        >
                            <template v-if="$page.props.auth.user"> </template>
                            <template v-else>
                                <SignupNavigation />
                            </template>
                        </div>
                        <!-- users -->
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <slot />
        </main>
        <footer></footer>
    </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import AppLogo from "@Components/Shared/AppLogo.vue";
import SignupNavigation from '@Components/User/SignupNavigation.vue';
</script>
