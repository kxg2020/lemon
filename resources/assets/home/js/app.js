window.Vue = require('vue')

import axios from 'axios'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
Vue.use(VueAxios, axios)

import {Loading, Message, Form, FormItem, Button, Input} from 'element-ui'
// Vue.prototype.$ELEMENT = { size: 'small', zIndex: 3000 } // size 用于改变组件的默认尺寸，zIndex 设置弹框的初始 z-index（默认值：2000)
Vue.use(Loading)
Vue.use(Form)
Vue.use(FormItem)
Vue.use(Button)
Vue.use(Input)
Vue.prototype.$message = Message

window.hljs = require('../../vendor/highlight.min')

Vue.directive('highlight', function (el) {
  let blocks = el.querySelectorAll('pre code');
  blocks.forEach((block) => {
    hljs.highlightBlock(block)
  })
})


let token = document.head.querySelector('meta[name="csrf-token"]')
token = token.getAttribute('content')
Vue.axios.defaults.headers.common = {
  'X-CSRF-TOKEN': token,
  'X-Requested-With': 'XMLHttpRequest'
}
Vue.axios.defaults.baseURL = window.Home.apiUrl

Vue.component('comment', require('../../vendor/components/comment.vue'))

import App from './App.vue'
import Posts from './components/pager/post/posts.vue'
import Post from './components/pager/post/post.vue'

const router = new VueRouter({
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
      path: '/post/:id',
      component: Post,
    }
  ]
})

const app = new Vue({
  el: '#app',
  template: '<App/>',
  router,
  components: {App}
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
