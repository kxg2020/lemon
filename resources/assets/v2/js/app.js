window.Vue = require('vue');

import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import MuseUI from 'muse-ui'
import store from './store.js'

Vue.use(MuseUI)
Vue.use(VueRouter)
Vue.use(VueAxios, axios)

let token = document.head.querySelector('meta[name="csrf-token"]')
token = token.getAttribute('content')
Vue.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': token,
    'X-Requested-With': 'XMLHttpRequest'
}
Vue.axios.defaults.baseURL = window.v2.apiUrl

window.authStatus = false

import App from './App.vue'
import Menu from './components/Menu.vue'
import Login from './components/Login.vue'
import Main from './components/Main.vue'

import Post from './components/post/post.vue'
import Posts from './components/post/posts.vue'
import File from './components/file/file.vue'
import Files from './components/file/files.vue'
import Comments from './components/comment/comments.vue'
import Categorys from './components/category/categorys.vue'
import Tags from './components/tag/tags.vue'


const router = new VueRouter ({
    root: '/main',
    routes: [
        {
            path: '/',
            component: Menu,
            name: '主页',
            icon: 'ion-home',
            meta: {
                requireAuth: false
            },
            children: [
                {
                    path: '/main',
                    component: Main,
                    name: '主页',
                    icon: 'ion-home',
                    meta: {
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
            meta: {
                requireAuth: true
            },
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
            meta: {
                requireAuth: true
            },
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
            meta: {
                requireAuth: true
            },
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

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')