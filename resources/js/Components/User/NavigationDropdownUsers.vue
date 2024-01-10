<template>
    <DropdownMenu>
        <template #trigger>
            <div class="group flex shrink-0 items-center">
                <span class="sr-only">{{ __("Menu") }}</span>
                <div
                    class="relative h-9 w-9 overflow-hidden rounded-full bg-neutral-200 p-px text-center"
                >
                    <UserAvatar
                        :user="{
                            avatar: $page.props.auth.user.avatar,
                            first_name: $page.props.auth.user.first_name,
                        }"
                    />
                </div>
                <p class="ml-2 hidden text-left text-xs sm:block">
                    <strong
                        class="hidden text-left capitalize text-neutral-700 sm:block"
                    >
                        {{
                            truncate(
                                $page.props.auth.user.first_name +
                                    " " +
                                    $page.props.auth.user.last_name,
                                19
                            )
                        }}
                    </strong>
                    <span class="font-medium text-neutral-400"
                        ><span class="text-neutral-300">@</span
                        >{{ $page.props.auth.user.username }}
                    </span>
                </p>
                <BxSolidChevronDown
                    class="hidden w-4 h-4 ml-4 text-neutral-400 transition group-hover:text-neutral-700 sm:block"
                />
            </div>
        </template>
        <template #content>
            <div
                class="py-2 text-sm font-medium text-neutral-600 first:pt-0 last:pb-0"
            >
                <span
                    class="block px-3 py-2 text-xs font-semibold uppercase text-neutral-400"
                >
                    {{ __("Account") }}
                </span>
                <Link
                    preserve-state
                    :href="
                        route('users.profile.show', {
                            username: $page.props.auth.user.username,
                        })
                    "
                    class="block w-full rounded px-2.5 py-2 text-left leading-5 transition duration-150 ease-in-out items-center hover:bg-primary-100 hover:text-primary-700 focus:bg-primary-100 focus:text-primary-700 focus:outline-none"
                >
                    <FlFilledPersonLink
                        class="me-1 inline-flex h-5 w-5 opacity-30"
                    />
                    {{ __("Your Page") }}
                </Link>
            </div>
            <div
                class="py-2 text-sm font-medium text-neutral-600 first:pt-0 last:pb-0"
            >
                <Link
                    preserve-state
                    :href="route('logout')"
                    :title="__('Sign Out')"
                    method="post"
                    as="button"
                    type="button"
                    class="block w-full rounded px-2.5 py-2 text-left leading-5 transition duration-150 ease-in-out hover:bg-primary-100 hover:text-primary-700 focus:bg-primary-100 focus:text-primary-700 focus:outline-none"
                >
                    <FlFilledSignOut
                        class="me-1 inline-flex h-5 w-5 opacity-30"
                    />

                    {{ __("Sign Out") }}
                </Link>
            </div>
        </template>
    </DropdownMenu>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import { truncate } from "@/Utils/text";
import DropdownMenu from "@Components/Shared/DropdownMenu.vue";
import UserAvatar from "@Components/User/UserAvatar.vue";
</script>
