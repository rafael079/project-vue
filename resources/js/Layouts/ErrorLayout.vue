<template>
    <div class="min-h-screen bg-neutral-200">
        <header></header>
        <main><slot /></main>
        <footer></footer>
    </div>
</template>
<script setup>
import AppLogo from '@/Components/Shared/AppLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>
