<template>
    <Menu as="div" class="relative">
        <MenuButton as="div" class="cursor-pointer">
            <slot name="trigger" />
        </MenuButton>
        <transition name="fade">
            <MenuItems
                class="absolute right-0 z-40 mt-3.5 min-w-[15rem] origin-top-right divide-y divide-neutral-300/30 rounded border border-neutral-300 bg-white p-1 shadow focus:outline-none"
            >
                <slot name="content" />
            </MenuItems>
        </transition>
    </Menu>
</template>
<script setup>
import { Menu, MenuButton, MenuItems } from "@headlessui/vue";
</script>
<style lang="scss">
.fade-enter-active {
    @apply transition duration-100 ease-out;
}
.fade-enter-to,
.fade-leave-from {
    @apply transform scale-100 opacity-100;
}
.fade-enter-from,
.fade-leave-to {
    @apply transform scale-95 opacity-0;
}
.fade-leave-active {
    @apply transition duration-75 ease-in;
}
</style>
