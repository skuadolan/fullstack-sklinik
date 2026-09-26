import '@/bootstrap';
import '@/../assets/scripts/css/app.css';

import Router from '@/Router';
import Toast from 'vue-toastification';
import { createInertiaApp } from '@inertiajs/vue3';
import { createApp, DefineComponent, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .use(Toast, {
        transition: 'Vue-Toastification__fade',
        maxToasts: 20,
        newestOnTop: true,
      })
      .use(Router)
      .mount(el);
  },
  progress: {
    color: '#4B5563',
  },
});
