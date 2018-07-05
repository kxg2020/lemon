window.Vue = require('vue')

import axios from 'axios'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import ElementUI from 'element-ui'

Vue.use(ElementUI)
Vue.use(VueRouter)
Vue.use(VueAxios, axios)

window.hljs = require('../../vendor/highlight.min')

let token = document.head.querySelector('meta[name="csrf-token"]')
token = token.getAttribute('content')
Vue.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': token,
    'X-Requested-With': 'XMLHttpRequest'
}
Vue.axios.defaults.baseURL = window.Home.apiUrl

Vue.component('comment', require('./components/comment.vue'))

import App from './App.vue'
import Posts from './components/pager/post/posts.vue'
import Post from './components/pager/post/posts.vue'

const router = new VueRouter ({
  routes: [
    {
      path: '/',
      redirect: '/posts'
    },
    {
      path: '/posts',
      component: Posts,
    },
    {
      path: '/post/:slug',
      component: Post,
    }
  ]
})

const app = new Vue({
  el: '#app',
  template: '<App/>',
  router,
  components: { App }
}).$mount('#app')


window.algoliasearch = require('algoliasearch')

console.log('%c      ___       ___           ___           ___           ___     \n' +
    '     /\\__\\     /\\  \\         /\\__\\         /\\  \\         /\\__\\    \n' +
    '    /:/  /    /::\\  \\       /::|  |       /::\\  \\       /::|  |   \n' +
    '   /:/  /    /:/\\:\\  \\     /:|:|  |      /:/\\:\\  \\     /:|:|  |   \n' +
    '  /:/  /    /::\\~\\:\\  \\   /:/|:|__|__   /:/  \\:\\  \\   /:/|:|  |__ \n' +
    ' /:/__/    /:/\\:\\ \\:\\__\\ /:/ |::::\\__\\ /:/__/ \\:\\__\\ /:/ |:| /\\__\\\n' +
    ' \\:\\  \\    \\:\\~\\:\\ \\/__/ \\/__/~~/:/  / \\:\\  \\ /:/  / \\/__|:|/:/  /\n' +
    '  \\:\\  \\    \\:\\ \\:\\__\\         /:/  /   \\:\\  /:/  /      |:/:/  / \n' +
    '   \\:\\  \\    \\:\\ \\/__/        /:/  /     \\:\\/:/  /       |::/  /  \n' +
    '    \\:\\__\\    \\:\\__\\         /:/  /       \\::/  /        /:/  /   \n' +
    '     \\/__/     \\/__/         \\/__/         \\/__/         \\/__/    ', 'color: coral;background:#282c34');
