import Vue from 'vue';
import Router from 'vue-router';

// Views
import translateRouter from './translate';

Vue.use(Router);
export default new Router({
    mode: 'history',
    scrollBehavior: () => ({y: 0}),
    routes: [
        {
            path: '/',
            name: 'home'
        },
        // {
        //     path: '/translate',
        //     component: translate,
        // },
        // {
        //     path: '/translate/:id',
        //     component: DisplayContentView,
        //     props: true
        // },
        // 翻譯頁
        translateRouter
    // router 轉址
    //{ path: '/*', redirect: '/' }
    ]
});
