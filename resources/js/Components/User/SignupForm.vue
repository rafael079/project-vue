<template>
    <form @submit.prevent="submit">
        <LoaderCard v-if="form.processing" />

        <div class="grid gap-y-6">
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:gap-6">
                <div>
                    <InputText
                        id="signup-first-name"
                        type="text"
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
                        type="text"
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
                    type="email"
                    v-model="form.email"
                    autocomplete="email"
                    :label="__('Email Address')"
                    :error="form.errors.email"
                    :placeholder="__('Email Address')"
                    required
                    @change="validate('email')"
                >
                    <template #suffix>
                        <FlMailOpenPerson class="h-5 w-5 opacity-15" />
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
                {{ __("By registering, you are agreeing to our") }}
                <Link
                    :title="__('Terms of use')"
                    href="#"
                    class="font-medium capitalize text-blue-600 decoration-2 hover:underline"
                >
                    {{ __("Terms of use") }}
                </Link>
                {{ __("and") }}
                <Link
                    :title="__('Privacy policy')"
                    href="#"
                    class="font-medium capitalize text-blue-600 decoration-2 hover:underline"
                >
                    {{ __("Privacy policy") }}
                </Link>
            </div>
            <PrimaryButton
                :loading="
                    form.processing || Object.keys(form.errors).length !== 0
                "
                type="submit"
                class="rounded py-3.5 font-semibold shadow-sm uppercase"
            >
                {{ __("Sign Up") }}
            </PrimaryButton>
        </div>
    </form>
</template>
<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { useValidate } from "momentum-preflight";
import PrimaryButton from "@Components/Form/PrimaryButton.vue";
import InputText from "@Components/Form/InputText.vue";
import InputPassword from "@Components/Form/InputPassword.vue";
import LoaderCard from "@/Components/Shared/LoaderCard.vue";

const form = useForm({
    first_name: "",
    last_name: "",
    email: "",
    password: "",
});

const validate = useValidate(form, route("register"), { debounce: 200 });

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password"),
        onSuccess: () => form.reset(),
    });
};
</script>
