import Vue from 'vue';
import VueRouter from 'vue-router';

import HelloWorld from '../components/HelloWorld';
import dataTable from '../components/tables/dataTable';

Vue.use(VueRouter);
export default new VueRouter({
    mode: 'history',
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
        path: 'translate',
        name: 'translate',
        component: dataTable,
        props: (route) => ({}),
    }
    ],
    methods: {}

});
