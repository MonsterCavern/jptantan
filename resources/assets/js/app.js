/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap")

import Vue from "vue"
Vue.prototype.$log = (...args) =>
    console.log(`[${new Date().toLocaleTimeString()}]:`, ...args)

import i18n from "./lang"
import { createStore } from "./store"
import { createRouter } from "./router"
import { sync } from "vuex-router-sync"
import theme from "./stylus/theme.js"

import App from "./App.vue"

const store = createStore()
const router = createRouter()

sync(store, router)

const vm = new Vue({
    el: "#app",
    i18n,
    router,
    store,
    render: h => h(App)
})

/*

 */
window.Vue = Vue
window.vm = vm
