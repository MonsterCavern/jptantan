import Vue from 'vue';
import Router from 'vue-router';
import Home from '../main/home';
import translate from '../main/translate';

import translateRouter from './translate';

Vue.use(Router);
export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/home',
            component: Home
        },
        // 翻譯頁
        translateRouter,
        // router 轉址
        { path: '/*', redirect: '/' }
    ]
});
