<template>
    <form @submit.prevent="submit">
        <LoaderCard v-if="form.processing" />

        <div class="mt-7 grid gap-y-6">
            <div>
                <InputText
                    id="login-email"
                    v-model="form.email"
                    :label="__('Email Address')"
                    :placeholder="__('Email Address')"
                    :error="form.errors.email"
                    type="email"
                    autofocus
                    autocomplete="email"
                    required
                >
                    <template #suffix>
                        <FlMailOpenPerson class="h-5 w-5 opacity-20" />
                    </template>
                </InputText>
            </div>
            <div>
                <InputPassword
                    id="login-password"
                    v-model="form.password"
                    :label="__('Password')"
                    :placeholder="__('Password')"
                    :error="form.errors.password"
                    autocomplete="current-password"
                    required
                />
            </div>
            <!-- TODO: implement forgot password -->
            <div
                class="grid grid-cols-1 items-center gap-4 sm:grid-cols-2 lg:gap-6"
            >
                <div
                    class="my-3 block max-w-sm text-left text-sm text-gray-400"
                >
                    <InputSwitchToggle
                        id="login-remembered"
                        v-model="form.remember"
                        :error="form.errors.remember"
                        :label="__('Remember me')"
                    />
                </div>
                <div
                    class="my-3 block max-w-sm text-right text-sm text-gray-400"
                >
                    <Link
                        :title="__('Forgot password')"
                        href="#"
                        class="font-medium text-blue-600 decoration-2 hover:underline"
                    >
                        {{ __("Forgot password") }}?
                    </Link>
                </div>
            </div>
            <PrimaryButton
                :loading="form.processing"
                type="submit"
                class="rounded py-3.5 font-medium uppercase"
            >
                {{ __("Log in") }}
            </PrimaryButton>
        </div>
    </form>
</template>
<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import InputText from "@Components/Form/InputText.vue";
import InputPassword from "@Components/Form/InputPassword.vue";
import PrimaryButton from "@Components/Form/PrimaryButton.vue";
import InputSwitchToggle from "@Components/Form/InputSwitchToggle.vue";
import LoaderCard from "@Components/Shared/LoaderCard.vue";

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
        onSuccess: () => form.reset(),
    });
};
</script>
