<template>
    <AppToast :show="isVisible" :placement="placement">
        <AppFlashMessages
            v-for="(message, index) in messages"
            :key="componentKey + index"
            :message="message"
            @remove="remove(index)"
        />
    </AppToast>
</template>
<script setup>
import { computed, onMounted, onUnmounted, ref, watch } from "vue";
import { usePage } from "@inertiajs/vue3";
import AppToast from "@/Components/Shared/AppToast.vue";
import AppFlashMessages from "@/Components/Shared/AppFlashMessages.vue";

const isVisible = ref(false);

const messages = ref([]);

const isRequestFromHistory = ref(false);

const placement = ref("top");

const flash = computed(() => usePage().props.flash || "");

const duration = ref(7000);

const componentKey = ref(0);

const popStateListener = () => (isRequestFromHistory.value = true);

watch(flash, (newFlash) => {
    if (isRequestFromHistory.value) {
        isRequestFromHistory.value = false;
        return;
    }

    const object = Object.entries(newFlash);

    object.forEach(function (value, i) {
        if (value[1]) {
            messages.value.unshift({
                message:
                    typeof value[1] === "object" ? value[1].message : value[1],
                description:
                    typeof value[1] === "object" ? value[1].description : null,
                type: value[0],
                duration:
                    typeof value[1] === "object"
                        ? value[1].duration ?? duration.value
                        : duration.value,
            });

            if (typeof value[1] === "object" && value[1].placement) {
                placement.value = value[1].placement;
            }
        }
    });

    isVisible.value = true;
});

const remove = (index) => {
    messages.value.splice(index, 1);

    if (messages.value.length <= 0) {
        isVisible.value = false;
    }

    componentKey.value += 1;
};

onMounted(() => {
    window.addEventListener("popstate", popStateListener);
});

onUnmounted(() => {
    window.removeEventListener("popstate", popStateListener);
});
</script>
