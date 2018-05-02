/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Vuex from "vuex";

import router from "./router";
import Master from "./App";
Vue.use(Vuex);
// 路由跳转
Vue.prototype.$goRoute = function(index) {
    this.$router.push(index);
};

const app = new Vue({
    el: "#app",
    router,
    render: h => h(Master) // 直接 render 在 #app 裡面
});
