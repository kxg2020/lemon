
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
token = token.getAttribute('content')
Vue.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': token,
    'X-Requested-With': 'XMLHttpRequest'
};
Vue.axios.defaults.baseURL = window.Dashboard.apiUrl;

import App from './App.vue';
import Login from './components/Login.vue';
import Main from './components/Main.vue';
import Post from './components/Post.vue';
import Links from './components/Links.vue';

const router = new VueRouter ({
    routes: [
        {
            path: '/login',
            name: 'Login',
            component: Login,
            meta: {
                requireAuth: false
            },
            hidden: true
        },
        {
            path: '/',
            redirect: '/main',
            meta: {
                requireAuth: false
            },
            hidden: true
        },
        {
            path: '/main',
            name: '主页',
            meta: {
                requireAuth: false
            },
            component: Main
        },
        {
            path: '/Links',
            name: '友情链接',
            meta: {
                requireAuth: true
            },
            component: Links
        },
        {
            path: '/post',
            name: '文章',
            meta: {
                requireAuth: true
            },
            component: Post
        },
    ]
});
// 路由监听
router.beforeEach((to, from, next) => {
    if(from.meta.requireAuth == false && to.meta.requireAuth == true) {
        if (JSON.parse(sessionStorage.getItem('lemon'))) {
            next();
        }else {
            next({
                path: '/login',
                query: {redirect: to.fullPath}  // 将跳转的路由path作为参数，登录成功后跳转到该路由
            })
        }
    }else {
        next();
    }
})
Vue.component('App', App);

const app = new Vue({
    el: '#app',
    template: '<App/>',
    router,
    components: { App }
}).$mount('#app');