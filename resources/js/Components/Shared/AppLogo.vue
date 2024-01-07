<template>
    <div
        class="group flex gap-x-1 h-12 relative items-center font-bold overflow-hidden lowercase"
    >
        <span class="absolute left-0 top-0.5 text-secundary-100/80">
            <AkChatDots class="h-11 w-11 fill-white" />
        </span>
        <span
            class="flex font-['Gantari'] -mt-2 items-center z-10 bg-primary-500 bg-gradient-to-l from-secundary-700 bg-clip-text pe-0.5 tracking-tighter text-transparent"
        >
            {{ $page.props.app.name }}
        </span>
    </div>
</template>

<script setup></script>
