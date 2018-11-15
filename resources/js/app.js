
require('./bootstrap');

window.Vue = require('vue');
import Buefy from 'buefy';
import router from './routes.js';
import VueCarousel from 'vue-carousel';
window.Slug = require('slug');
Slug.defaults.mode = 'rfc3986';
window.VueRouter = require('vue-router').default;
window.axios = require('axios').default;

Vue.use(Buefy,{ defaultIconPack: 'fa' },VueRouter, axios,VueCarousel );

const AppLayout = Vue.component('app-layout', require('./components/appLayout.vue'))
const slugWidget = Vue.component('slug-widget', require('./components/slugWidget.vue'));


new Vue(
    Vue.util.extend(
        {router},
        AppLayout,
        slugWidget,
    )
).$mount('#mainLayout');