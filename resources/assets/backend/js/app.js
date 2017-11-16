window.Vue = require('vue')

import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import ElementUI from 'element-ui'

Vue.use(ElementUI)
Vue.use(VueRouter)
Vue.use(VueAxios, axios)

let token = document.head.querySelector('meta[name="csrf-token"]')
token = token.getAttribute('content')
Vue.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': token,
    'X-Requested-With': 'XMLHttpRequest'
}
Vue.axios.defaults.baseURL = window.Dashboard.apiUrl

import App from './App.vue'
import Main from './components/Main.vue'
import Menu from './components/Menu.vue'
import Login from './components/Login.vue'

import Posts from './components/pager/post/Posts.vue'
import Post from './components/pager/post/Post.vue'

import Files from './components/pager/file/Files.vue'
import File from './components/pager/file/File.vue'

import Categorys from './components/pager/category/Categorys.vue'

import Tags from './components/pager/tag/Tags.vue'

import Comments from './components/pager/comment/comments.vue'

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
            name: '主页',
            icon: 'ion-home',
            children: [
                {
                    path: '/main',
                    component: Main,
                    name: '主页',
                    icon: 'ion-home',
                    meta: {
                        requireAuth: true
                    }
                }
            ]
        },
        {
            path: '/',
            component: Menu,
            name: '文章管理',
            icon: 'ion-navicon-round',
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
                    name: '修改文章',
                    hidden: true,
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
                },
                {
                    path: '/tags',
                    component: Tags,
                    name: '标签管理',
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
            icon: 'ion-ios-folder',
            leaf: true,
            children: [
                {
                    path: '/files',
                    component: Files,
                    name: '文件列表',
                    meta: {
                        requireAuth: true
                    }
                },
                {
                    path: '/files/add',
                    component: File,
                    name: '上传文件',
                    meta: {
                        requireAuth: true
                    }
                }
            ]
        },
        {
            path: '/',
            component: Menu,
            name: '评论管理',
            icon: 'ion-ios-chatbubble',
            leaf: true,
            children: [
                {
                    path: '/comments',
                    component: Comments,
                    name: '评论列表',
                    meta: {
                        requireAuth: true
                    }
                }
            ]
        }
    ]
})
// 路由监听
router.beforeEach((to, from, next) => {
    if(!from.meta.requireAuth  && to.meta.requireAuth) {
        if (JSON.parse(sessionStorage.getItem('lemon'))) {
            next()
        }else {
            next({
                path: '/login',
                query: {redirect: to.fullPath}  // 将跳转的路由path作为参数，登录成功后跳转到该路由
            })
        }
    }else {
        next()
    }
})
Vue.component('App', App)

// 请求拦截
Vue.axios.interceptors.request.use(
    config  =>  {
        return config
    },
    error   =>  {
        if(error.response){
            switch (error.response.status){
                case 403:
                    router.push({path: '/login'})
                    break
                case 200:
                    router.push({path: '/main'})
                    break
            }
        }
        return Promise.reject(error.response.data)
    }
)

// 响应拦截
Vue.axios.interceptors.response.use(
    response    =>  {
        return response
    },
    error   =>  {
        if(error.response){
            switch (error.response.status){
                case 403:
                    router.push({path: '/login'})
                    break
                case 200:
                    router.push({path: '/main'})
                    break
                case 401:
                    router.push({path: '/login'})
                    break
            }
        }
        return Promise.reject(error.response.data)
    }
)

const app = new Vue({
    el: '#app',
    template: '<App/>',
    router,
    components: { App }
}).$mount('#app')