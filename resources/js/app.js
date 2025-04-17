import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { createPinia } from 'pinia';

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue');
    return pages[`./Pages/${name}.vue`]();
  },
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) });
    app.use(plugin);
    app.use(createPinia());
    app.mount(el);
  },
});
