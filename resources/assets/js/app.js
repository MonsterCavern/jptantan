/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('bootstrap');
require('bootstrap-material-design');

import Vue from 'vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-material-design/dist/css/bootstrap-material-design.css';

import router from './router';
import Master from './main/master';

// 路由跳转
Vue.prototype.$goRoute = function(index) {
    // console.log(this.$router,index);
    this.$router.push(index);
};

const app = new Vue({
    el: '#app',
    router,
    render: h => h(Master) // 直接 render 在 #app 裡面
});
