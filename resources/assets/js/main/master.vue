<template>
    <div class='app'>
        <!-- Header -->
        <AppHeader/>
        <!-- .Header -->
        <div class="app-body">
            <Sidebar :navItems="nav" />
            <main class="main">
              <router-view></router-view>
            </main>
            <AppAside/>
        </div>
    </div>

</template>

<script>
import nav from './_nav'
import AppHeader from '../components/Header'
import Sidebar from '../components/Sidebar/Sidebar'
import AppAside from '../components/Asides/Aside'

export default {
    components: {
        AppHeader,
        Sidebar,
        AppAside
    },
    methods: {
        log: function(val) {
            console.log(val);
        }
    },
    data() {
        return {
            nav: nav.items
        }
    },
};
</script>

<style lang="css">
</style>
