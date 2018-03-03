import Vue from 'vue';
import Router from 'vue-router';

import HelloWorld from '../components/HelloWorld';
import dataTable from '../components/tables/dataTable';

Vue.use(Router);
export default new Router({
    //mode: 'history',
    routes: [{
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
        //name: 'translate',
        component: dataTable,
        props: (route) => ({}),
    }
    ]
});
