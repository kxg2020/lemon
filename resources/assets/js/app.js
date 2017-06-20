
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import ElementUI from 'element-ui';

Vue.use(ElementUI);
Vue.use(VueRouter);
Vue.use(VueAxios, axios);

let token = document.head.querySelector('meta[name="csrf-token"]');
Vue.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': token,
    'X-Requested-With': 'XMLHttpRequest'
};
Vue.axios.defaults.baseURL = window.Dashboard.apiUrl;

import App from './App.vue';
import Login from './components/Login.vue';
import Home from './components/Home.vue';

const router = new VueRouter ({
    routes: [
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/Home',
            name: 'Home',
            component: Home
        },
        { path: '/', redirect: '/Home'}
    ]
});

Vue.component('App', App);

const app = new Vue({
    el: '#app',
    template: '<App/>',
    router,
    components: { App }
}).$mount('#app');