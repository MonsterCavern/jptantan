import Vue from 'vue'
import App from './App.vue'
// import VueClipboards from 'vue-clipboards'
// import VueLazyload from 'vue-lazyload'
// import VueMarkdown from 'vue-markdown'
//
// import axios from 'axios'
// import _ from 'lodash'
import Vuetify from 'vuetify'

// import * as Components from './components/_index.js'

import { createStore } from './store'
import { createRouter } from './router'
import { sync } from 'vuex-router-sync'

import theme from './stylus/theme.js'
Vue.use(Vuetify, { theme })
// index.js or main.js
import 'vuetify/dist/vuetify.min.css' // Ensure you are using css-loader

// Vue.prototype.$_ = _
// Vue.prototype.$axios = axios
Vue.prototype.$log = (...args) => console.log(`[${new Date().toLocaleTimeString()}]:`, ...args)

// create store and router instances
const store = createStore()
const router = createRouter()

// App initialization
// store.dispatch('init')

// sync the router with the vuex store.
// this registers `store.state.route`
// sync(store, router)

const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
})
