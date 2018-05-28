<template>
    <div class="app">
        <AppHeader :leftToggler="false"></AppHeader> 
        <div class="app-body">
            <main class="main">
                <div class="container-fluid">
                    <router-view></router-view>
                </div>
            </main>
            <!-- <AppAside></AppAside> -->
        </div>
        <!-- <AppFooter></AppFooter> -->
    </div>
</template>

<script>
import AppHeader from '@components/Header'
import Sidebar from '@components/Sidebar/Sidebar'
import AppAside from '@components/Asides/Aside'

export default {
  name: 'app',
  components: {
    AppHeader,
    AppAside
  },
  data() {
    return {}
  },
  computed: {}
}
</script>
