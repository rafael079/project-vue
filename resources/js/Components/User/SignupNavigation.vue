<template>
    <div>
        <PrimaryButton
            :disabled="openSignupModal"
            class="group relative rounded-full px-5 py-1.5"
            @click="openSignupModal = true"
        >
            <span
                class="absolute -end-full transition-all delay-100 group-hover:end-3"
            >
                <ClUserAdd class="ms-5 h-5 w-5 opacity-35" />
            </span>

            <span
                class="text-sm font-medium transition-all delay-100 group-hover:me-5"
            >
                {{ __("Signup") }}
            </span>
        </PrimaryButton>

        <AppModal
            :show="openSignupModal"
            blur-effect="sm"
            :closeable="false"
            placement="top-center"
            @close="closeSignupModal"
        >
            <div class="px-5 py-5 lg:px-6">
                <div class="border-b border-neutral-100 pb-5 text-center">
                    <h2
                        class="block text-2xl font-bold uppercase tracking-tight text-neutral-600"
                    >
                        {{ __("Sign up") }}
                    </h2>
                    <p class="text-sm text-neutral-600">
                        {{ __("Already have an account") }}?
                        <AppButton
                            class="me-1 rounded-full font-medium text-blue-600 decoration-2 transition hover:underline"
                            :title="__('Login Here')"
                            @click="openLoginModal"
                        >
                            {{ __("Login Here") }}
                        </AppButton>
                    </p>
                </div>
                <div class="mt-7">
                    <SignupForm />
                </div>
            </div>
        </AppModal>
    </div>
</template>

<script setup>
import { ref } from "vue";
import AppButton from "@Components/Form/AppButton.vue";
import PrimaryButton from "@Components/Form/PrimaryButton.vue";
import AppModal from "@Components/Shared/AppModal.vue";
import SignupForm from "@Components/User/SignupForm.vue";

const openSignupModal = ref(false);

const closeSignupModal = () => (openSignupModal.value = false);

const openLoginModal = () => {};
</script>
