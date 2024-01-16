<template>
    <div
        class="group flex flex-row items-center gap-x-0.5 rounded-full text-xs font-semibold text-neutral-600 hover:text-neutral-800"
    >
        <HiSolidChatBubbleOvalLeftEllipsis
            class="me-1 inline-block h-5 w-5 text-neutral-700 opacity-75 group-hover:opacity-85"
        />{{ abbreviateNumber(total) }}
    </div>
</template>
<script setup>
import { abbreviateNumber } from '@/Utils/numbers';

defineProps({
    total: {
        type: Number,
        default: 0
    }
});
</script>
