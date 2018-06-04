import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

// pages
import Bokete from '../pages/Bokete'
import Login from '../pages/Login'
import User from '../pages/User'

export function createRouter() {
    return new Router({
        // mode: 'abstract', //mode
        // scrollBehavior: () => ({ y: 0 }),
        // component: {
        //     render(c) {
        //         return c('router-view')
        //     }
        // },
        routes: [
            { path: '/' },
            { path: '/auth/login', component: Login },
            { path: '/auth/user', component: User },
            { path: '/bokete', component: Bokete },
            // Global redirect for 404
            { path: '*', redirect: '/' }
        ]
    })
}
