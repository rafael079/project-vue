<template>
    <div>
        <AppButton
            :disabled="openLoginModal"
            class="rounded-full px-5 py-1.5 text-sm font-medium text-neutral-600 transition hover:bg-neutral-100 hover:underline hover:text-neutral-700 focus:bg-neutral-100"
            @click="openLoginModal = true"
        >
            {{ __("Login") }}
        </AppButton>
        <AppModal
            :show="openLoginModal"
            :closeable="false"
            blur-effect="sm"
            max-width="md"
            @close="closeLoginModal"
        >
            <div class="px-5 py-5 lg:px-6">
                <div class="border-b border-neutral-100 pb-5 text-center">
                    <h2
                        class="block text-2xl font-bold uppercase tracking-tight text-neutral-600 drop-shadow-sm"
                    >
                        {{ __("Log in") }}
                    </h2>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">
                        {{ __("Don't have an account yet") }}?
                        <AppButton
                            :title="__('Sign up here')"
                            class="ms-1 font-medium text-blue-600 decoration-2 hover:underline"
                            @click="openRegisterModal"
                        >
                            {{ __("Sign up here") }}
                        </AppButton>
                    </p>
                </div>
                <div>
                    <LoginForm />
                </div>
            </div>
        </AppModal>
    </div>
</template>
<script setup>
import { inject, onMounted, ref } from "vue";
import AppButton from "@Components/Form/AppButton.vue";
import AppModal from "@Components/Shared/AppModal.vue";
import LoginForm from "@Components/User/LoginForm.vue";

const getEmitter = inject('emitter')

const openLoginModal = ref(false);

const closeLoginModal = () => (openLoginModal.value = false);

const openRegisterModal = () => {
    if (getEmitter) {
        getEmitter.emit('openRegisterForm')
        closeLoginModal()
    }
}

onMounted(() => {
    if (getEmitter) {
        getEmitter.on('openLoginForm', (e) => (openLoginModal.value = true))
    }
})
</script>
