<template>
    <div
        class="group relative flex h-12 items-center gap-x-1 overflow-hidden font-bold lowercase"
    >
        <span class="absolute left-0 top-0 text-red-600/10">
            <McEarthFill class="h-12 w-12 fill-white" />
        </span>
        <span
            class="z-10 -mt-2 flex items-center bg-primary-500 bg-gradient-to-l from-secundary-700 bg-clip-text pe-0.5 font-['Gantari'] tracking-tighter text-transparent"
        >
            {{ $page.props.app.name }}
        </span>
    </div>
</template>

<script setup></script>
