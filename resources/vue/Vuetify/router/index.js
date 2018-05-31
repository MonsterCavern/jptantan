import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

// pages
import Bokete from '../pages/Bokete'

export function createRouter() {
    return new Router({
        mode: 'history',
        scrollBehavior: () => ({ y: 0 }),
        component: {
            render(c) {
                return c('router-view')
            }
        },
        routes: [
            { path: '/' },
            { path: '/bokete', component: Bokete },
            // Global redirect for 404
            { path: '*', redirect: '/' }
        ]
    })
}
