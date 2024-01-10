<template>
    <div>
        <Head>
            <title>{{ props.status }} - {{ title }}</title>
        </Head>
        <section>
            <div
                class="relative top-16 mx-auto max-w-screen-sm rounded-lg bg-white bg-opacity-90 px-4 py-8 shadow lg:px-6 lg:py-16"
            >
                <div class="mx-auto max-w-screen-sm text-center">
                    <h1
                        class="mb-4 text-7xl font-extrabold tracking-tight text-primary-700 lg:text-9xl"
                    >
                        {{ props.status }}
                    </h1>
                    <p
                        class="mb-3 text-2xl font-bold tracking-tight text-neutral-700 dark:text-white md:text-3xl"
                    >
                        {{ title }}
                    </p>
                    <p class="mb-4 text-lg font-light text-neutral-500">
                        {{ description }}
                    </p>
                    <Link
                        :href="route('home')"
                        class="my-4 inline-flex rounded-full bg-primary-600 px-5 py-3 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300"
                    >
                        <MdOutlinedKeyboardBackspace class="me-1.5 h-5 w-5" />
                        {{ __('Back to Homepage') }}
                    </Link>
                </div>
            </div>
        </section>
    </div>
</template>
<script setup>
import { computed } from 'vue';
import { Link, Head } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';
import NestedLayout from '@/Layouts/ErrorLayout.vue';

const props = defineProps({
    status: {
        type: Number,
        default: 500
    }
});

const title = computed(() => {
    return {
        503: trans('Service Unavailable'),
        500: trans('Server Error'),
        404: trans('Content Not Found'),
        403: trans('Forbidden')
    }[props.status];
});

const description = computed(() => {
    return {
        503: trans(
            'Sorry, we are doing some maintenance. Please check back soon.'
        ),
        500: trans('Whoops, something went wrong on our servers.'),
        404: trans('Sorry, the page you are looking for could not be found.'),
        403: trans('Sorry, you are forbidden from accessing this page.')
    }[props.status];
});

defineOptions({ layout: NestedLayout });
</script>
