<template>
    <div>
        <AppButton
            class="flex items-center gap-x-1.5 rounded bg-neutral-700 px-2 py-1.5 font-medium text-white"
            @click="openUserEditModal = true"
        >
            <FlFilledPersonEdit class="h-4 w-4 opacity-35" />
            {{ __('Edit You Data') }}
        </AppButton>
        <AppModal
            max-width="2xl"
            :closeable="false"
            :show="openUserEditModal"
            @close="closeUserEditModal"
        >
            <div>
                <div
                    class="border-b border-neutral-200 bg-neutral-100 px-5 py-5 pb-5 text-left lg:px-5"
                >
                    <h2
                        class="relative flex ps-14 text-lg font-bold uppercase leading-6 text-neutral-600"
                    >
                        <FlFilledPersonEdit
                            class="absolute left-0 inline-flex h-11 w-11 align-middle opacity-15"
                        />{{ __('Profile Information') }}
                    </h2>
                    <p class="ms-14 text-sm text-neutral-500">
                        {{
                            __(
                                'Please fill out this form to edit your profile information.'
                            )
                        }}
                    </p>
                </div>

                <div class="px-8 py-6">
                    <UserEditProfileForm @close="closeUserEditModal" />
                </div>
            </div>
        </AppModal>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import AppButton from '@Components/Form/AppButton.vue';
import AppModal from '@Components/Shared/AppModal.vue';
import UserEditProfileForm from '@Components/User/UserEditProfileForm.vue';

const openUserEditModal = ref(false);

const closeUserEditModal = () => (openUserEditModal.value = false);
</script>
