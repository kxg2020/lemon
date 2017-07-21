
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

import marked from 'marked';
Vue.prototype.marked = marked;

import App from './App.vue';
import Main from './components/Main.vue';
import Menu from './components/Menu.vue';
import Login from './components/Login.vue';

import Posts from './components/pager/post/Posts.vue';
import Post from './components/pager/post/Post.vue';

import Files from './components/pager/file/Files.vue';

import Categorys from './components/pager/category/Categorys.vue'

import Links from './components/Links.vue';

const router = new VueRouter ({
    root: '/main',
    routes: [
        {
            path: '/login',
            component: Login,
            meta: {
                requireAuth: false
            }
        },
        {
            path: '/',
            component: Menu,
            name: '文章管理',
            leaf: true,
            children: [
                {
                    path: '/posts',
                    component: Posts,
                    name: '文章列表',
                    meta: {
                        requireAuth: true
                    }
                },
                {
                    path: '/posts/add',
                    component: Post,
                    name: '新建文章',
                    meta: {
                        requireAuth: true
                    }
                },
                {
                    path: '/posts/edit/:id',
                    component: Post,
                    meta: {
                        requireAuth: true
                    }
                },
                {
                    path: '/categorys',
                    component: Categorys,
                    name: '分类管理',
                    meta: {
                        requireAuth: true
                    }
                }
            ]
        },
        {
            path: '/',
            component: Menu,
            name: '文件管理',
            leaf: false,
            children: [
                {
                    path: '/files',
                    component: Files,
                    name: '文件列表',
                    meta: {
                        requireAuth: true
                    }
                }
            ]
        }
    ]
});
// 路由监听
router.beforeEach((to, from, next) => {
    if(!from.meta.requireAuth  && to.meta.requireAuth) {
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