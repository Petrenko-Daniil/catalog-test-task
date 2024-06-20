import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import Notifications from '@kyvg/vue3-notification'

let app = await createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Notifications)
            .mount(el)
    },
});

