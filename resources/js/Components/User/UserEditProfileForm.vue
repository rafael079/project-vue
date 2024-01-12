<template>
    <form @submit.prevent="submit">
        <LoaderCard v-if="form.processing" />

        <div class="grid gap-5">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:gap-6">
                <div>
                    <InputText
                        id="edit-first-name"
                        v-model="form.first_name"
                        required
                        :error="form.errors.first_name"
                        :placeholder="__('First Name')"
                        :label="__('First Name')"
                        autocomplete="given-name"
                    >
                        <template #suffix>
                            <FlPerson class="h-5 w-5 opacity-15" />
                        </template>
                    </InputText>
                </div>
                <div>
                    <InputText
                        id="edit-last-name"
                        v-model="form.last_name"
                        required
                        :error="form.errors.last_name"
                        :placeholder="__('Last Name')"
                        :label="__('Last Name')"
                        autocomplete="family-name"
                    >
                        <template #suffix>
                            <FlPerson class="h-5 w-5 opacity-15" />
                        </template>
                    </InputText>
                </div>
            </div>
            <div>
                <InputText
                    id="edit-username"
                    v-model="form.username"
                    required
                    :error="form.errors.username"
                    :placeholder="__('Username')"
                    :label="__('Username')"
                    :disabled="isLoadingCheck"
                    autocomplete="username"
                    class="!py-3 !ps-[12.2rem]"
                    @change="checkIfUsernameExists(form.username)"
                >
                    <template #prefix>
                        <span
                            class="rounded bg-neutral-200/35 px-2.5 py-1 text-xs font-medium text-neutral-400"
                        >
                            {{ $page.props.router.url }}/u/
                        </span>
                    </template>
                    <template #suffix>
                        <McLoadingFill
                            v-if="isLoadingCheck"
                            class="h-5 w-5 animate-spin text-primary-700"
                        />
                        <FlFilledMention v-else class="h-5 w-5 opacity-15" />
                    </template>
                </InputText>
            </div>
            <div class="mt-4 border-t border-neutral-100 pt-4">
                <PrimaryButton
                    :loading="
                        form.processing || form.hasErrors || isLoadingCheck
                    "
                    type="submit"
                    class="w-fit rounded px-5 py-3 text-sm font-medium shadow-sm"
                >
                    {{ __('Save Data') }}
                </PrimaryButton>
                <AppButton
                    class="ms-4 px-3 text-sm font-semibold lowercase text-blue-600 hover:underline"
                    @click="$emit('close')"
                >
                    {{ __('Cancel') }}
                </AppButton>
            </div>
        </div>
    </form>
</template>
<script setup>
import { usePage, useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { trans } from 'laravel-vue-i18n';
import InputText from '@Components/Form/InputText.vue';
import PrimaryButton from '@Components/Form/PrimaryButton.vue';
import AppButton from '@Components/Form/AppButton.vue';
import LoaderCard from '@Components/Shared/LoaderCard.vue';
import ApiUser from '@/Api/users';

const user = computed(() => usePage().props.auth.user);

const isLoadingCheck = ref(false);

const form = useForm({
    first_name: user.value.first_name,
    last_name: user.value.last_name,
    username: user.value.username
});

const emit = defineEmits(['close']);

const checkIfUsernameExists = async (data) => {
    isLoadingCheck.value = true;

    await ApiUser.checkUsername(data).then(function (response) {
        if (response.data) {
            form.setError('username', trans('Username is already in use'));
        } else {
            form.clearErrors('username');
        }

        isLoadingCheck.value = false;
    });
};

const submit = () => {
    form.patch(route('users.profile.update'), {
        onSuccess: () => {
            form.reset();
            emit('close');
        }
    });
};
</script>
