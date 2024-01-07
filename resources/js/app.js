import "./bootstrap";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

import Layout from "@/Layouts/AppWeb.vue";

const appTitle =
    window.document.getElementsByTagName("title")[0]?.innerText || "RoxCorp";

createInertiaApp({
    title: (title) => (title ? `${title} - ${appTitle}` : appTitle),
    resolve: (name) => {
        const pageComponent = resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue", { eager: true })
        );

        pageComponent.then((module) => {
            module.default.layout = module.default.layout || Layout;
        });

        return pageComponent;
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy);

        app.mount(el);
    },
    progress: {
        color: "#e11d48",
    },
});
