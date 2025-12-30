import './bootstrap';
import '../css/app.css';


const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

import { createSSRApp, h } from 'vue';
import createServer from '@inertiajs/vue3/server';
import { createInertiaApp } from '@inertiajs/vue3';
import { renderToString } from '@vue/server-renderer';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

createServer((page) =>
    createInertiaApp({
        page,
        render: renderToString,
        title: (title) => `${title} - ${appName}`,
        resolve: (name) =>
            resolvePageComponent(
                `./${name}.vue`,
                import.meta.glob("./**/*.vue", { eager: true }),
            ),
        setup({ App, props, plugin }) {
            return createSSRApp({ render: () => h(App, props) })
                .use(plugin)
                .use(ZiggyVue, {
                    ...page.props.ziggy,
                    location: new URL(page.props.ziggy.location),
                });
        },
    }),
);
