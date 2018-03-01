/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import 'vuetify/dist/vuetify.min.css';

import Vue from 'vue';
import Vuetify from 'vuetify';
import Master from './components/layouts/baseline';

import router from './router';

Vue.use(Vuetify);

// 路由跳转
Vue.prototype.$goRoute = function (index) {
    this.$router.push(index);
};

const app = new Vue(
    {
        el: '#app',
        router,
        render: h => h(Master) // 直接 render 在 #app 裡面
    });
