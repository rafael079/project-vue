<template>
    <div class="inline-flex h-full w-full">
        <video ref="player" style="object-fit: contain" playsinline controls>
            <source :src="props.src" type="video/mp4" />
        </video>
    </div>
</template>
<script setup>
import { onMounted, ref } from 'vue';

import Plyr from 'plyr';

import 'plyr/dist/plyr.css';

const player = ref();

onMounted(() => {
    new Plyr(player.value);
});

const props = defineProps({
    src: {
        type: String,
        required: true
    }
});
</script>
<style>
:root {
    --plyr-color-main: #f43f5e;
    --plyr-control-icon-size: 1.2rem;
    --plyr-control-radius: 0.25rem;
    --plyr-badge-border-radius: 0.25rem;
}

.plyr {
    @apply w-full;
}
</style>
