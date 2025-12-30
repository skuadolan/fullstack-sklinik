import './bootstrap';
import '../css/app.css';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

import router from "./Router";
import { createApp, h } from 'vue';
import { createStore } from "vuex";
import { createInertiaApp } from '@inertiajs/vue3';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

const store = createStore({
	state() {
		return {
			STORE_SESSION: {
				_token: sessionStorage.getItem("_token"),
				isUserLogin: !!sessionStorage.getItem("_token")
			},
		};
	},
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./${name}.vue`,
            import.meta.glob("./**/*.vue", { eager: true }),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(router)
            .use(store)
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
