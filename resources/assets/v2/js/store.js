import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        authLogin: true
    },
    mutations: {
        reSetAuthStatus (state) {
            state.authLogin = Math.random() > 0.5 ? true :false
        }
    }
})

export default store