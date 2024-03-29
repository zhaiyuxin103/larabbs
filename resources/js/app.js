import './bootstrap';
import '../sass/app.scss';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { plugin as VueTippy } from 'vue-tippy'
import 'tippy.js/dist/tippy.css' // optional for styling
import { __, trans, setLocale, getLocale, transChoice, MaticeLocalizationConfig, locales } from "matice";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

library.add(fas, far, fab);

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({el, app, props, plugin}) {
    return createApp({render: () => h(app, props)})
      .use(plugin)
      .use(ZiggyVue, Ziggy)
      .use(VueTippy, {
        directive: 'tippy', // => v-tippy
        component: 'tippy', // => <tippy/>
        componentSingleton: 'tippy-singleton', // => <tippy-singleton/>,
        defaultProps: {
          placement: 'auto',
          allowHTML: true,
        }, // => Global default options * see all props
      })
      .component('font-awesome-icon', FontAwesomeIcon)
      .mixin({
        methods: {
          $trans: trans,
          $__: __,
          $transChoice: transChoice,
          $setLocale(locale) {
            setLocale(locale);
            this.$forceUpdate() // Refresh the vue instance(The whole app in case of SPA) after the locale changes.
          },
          // The current locale
          $locale() {
            return getLocale()
          },
          // A listing of the available locales
          $locales() {
            return locales()
          }
        },
      })
      .mount(el);
  },
});

InertiaProgress.init({color: '#4B5563'});
