/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import 'vuetify/dist/vuetify.min.css'

import Vue from 'vue'
import Vuetify from 'vuetify'
import Inspire from './components/layouts/baseline'
import router from './router'

Vue.use(Vuetify)

const app = new Vue({
    el: '#app',
    components: {
      'v-main': Inspire
    },
    router
});
