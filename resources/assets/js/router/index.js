import Vue from 'vue';
import Router from 'vue-router';
import HelloWorld from '../components/HelloWorld';
import translate from '../main/translate';

import translateRouter from './translate';

Vue.use(Router);
export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: HelloWorld
        },
        {
            path: '/home',
            component: HelloWorld
        },
        {
            path: '/translate',
            component: translate
        },
        translateRouter
    ]
});
