window.Vue = require('vue')
window.$ = window.jquery = require('jquery')
import axios from 'axios'
import VueAxios from 'vue-axios'
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

let token = document.head.querySelector('meta[name="csrf-token"]')
token = token.getAttribute('content')
Vue.axios.defaults.headers.common = {
  'X-CSRF-TOKEN': token,
  'X-Requested-With': 'XMLHttpRequest'
}
Vue.axios.defaults.baseURL = window.Home.apiUrl

Vue.component('comment', require('../../vendor/components/comment.vue'))

new Vue().$mount('#app')


window.algoliasearch = require('algoliasearch')

require('./search.js')

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