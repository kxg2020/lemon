window.Vue = require('vue')

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass')

import axios from 'axios'
import VueAxios from 'vue-axios'

window.hljs = require('../../vendor/highlight.min');

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

require('./header.js')

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
