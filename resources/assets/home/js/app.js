window.Vue = require('vue')

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass')

import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)

let token = document.head.querySelector('meta[name="csrf-token"]')
token = token.getAttribute('content')
Vue.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': token,
    'X-Requested-With': 'XMLHttpRequest'
}
Vue.axios.defaults.baseURL = window.Home.apiUrl


Vue.component('comment', require('./components/comment.vue'))

new Vue().$mount('#app')


