import Vue from 'vue'
import Router from 'vue-router'

import HelloWorld from '../components/HelloWorld'
import translateTable from '../components/tables/translateTable'

Vue.use(Router)

export default new Router({
    routes: [{
            path: '/',
            name: 'home',
            component: HelloWorld
        },
        {
          path: '/translate',
          name: 'translate',
          components: {
            'ex':translateTable
          }
        }
    ]
})
