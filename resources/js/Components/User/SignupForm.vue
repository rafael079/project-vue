<template>
    <form @submit.prevent="submit">
        <LoaderCard v-if="form.processing" />

        <div class="grid gap-y-6">
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:gap-6">
                <div>
                    <InputText
                        id="signup-first-name"
                        v-model="form.first_name"
                        :label="__('Your First Name')"
                        autofocus
                        autocomplete="given-name"
                        :error="form.errors.first_name"
                        :placeholder="__('First Name')"
                        required
                    >
                        <template #suffix>
                            <FlPerson class="h-5 w-5 opacity-20" />
                        </template>
                    </InputText>
                </div>
                <div>
                    <InputText
                        id="signup-last-name"
                        v-model="form.last_name"
                        autocomplete="family-name"
                        :label="__('Your Last Name')"
                        :error="form.errors.last_name"
                        :placeholder="__('Last Name')"
                        required
                    >
                        <template #suffix>
                            <FlPerson class="h-5 w-5 opacity-20" />
                        </template>
                    </InputText>
                </div>
            </div>

            <div>
                <InputText
                    id="signup-email"
                    v-model="form.email"
                    type="email"
                    autocomplete="email"
                    :label="__('Email Address')"
                    :error="form.errors.email"
                    :placeholder="__('Email Address')"
                    required
                    @change="checkIfEmailExists(form.email)"
                >
                    <template #suffix>
                        <McLoadingFill
                            v-if="isLoadingCheck"
                            class="h-5 w-5 animate-spin text-primary-700"
                        />
                        <FlMailOpenPerson v-else class="h-5 w-5 opacity-15" />
                    </template>
                </InputText>
            </div>

            <div>
                <InputPassword
                    id="signup-password"
                    v-model="form.password"
                    :placeholder="__('Password')"
                    :label="__('Password')"
                    autocomplete="new-password"
                    required
                />
            </div>

            <!-- TODO: add terms and conditions and privacy page -->
            <div
                class="my-3.5 block max-w-sm text-left text-sm text-neutral-500"
            >
                {{ __('By registering, you are agreeing to our') }}
                <Link
                    :title="__('Terms of use')"
                    href="#"
                    class="font-medium capitalize text-blue-600 decoration-2 hover:underline"
                >
                    {{ __('Terms of use') }}
                </Link>
                {{ __('and') }}
                <Link
                    :title="__('Privacy policy')"
                    href="#"
                    class="font-medium capitalize text-blue-600 decoration-2 hover:underline"
                >
                    {{ __('Privacy policy') }}
                </Link>
            </div>
            <PrimaryButton
                :loading="form.processing || form.hasErrors || isLoadingCheck"
                type="submit"
                class="rounded py-3.5 font-semibold uppercase shadow-sm"
            >
                {{ __('Sign Up') }}
            </PrimaryButton>
        </div>
    </form>
</template>
<script setup>
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';
import PrimaryButton from '@Components/Form/PrimaryButton.vue';
import InputText from '@Components/Form/InputText.vue';
import InputPassword from '@Components/Form/InputPassword.vue';
import LoaderCard from '@/Components/Shared/LoaderCard.vue';

import ApiUser from '@/Api/users';

const isLoadingCheck = ref(false);

const checkIfEmailExists = async (data) => {
    isLoadingCheck.value = true;

    await ApiUser.checkEmail(data).then(function (response) {
        if (response.data) {
            form.setError('email', trans('E-mail is already in use'));
        } else {
            form.clearErrors('email');
        }

        isLoadingCheck.value = false;
    });
};

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    password: ''
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password'),
        onSuccess: () => form.reset()
    });
};
</script>
