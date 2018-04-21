<template>
  <div class="app">
    <AppHeader></AppHeader>
    <div class="app-body">
      <Sidebar :navItems="nav"/>
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
import nav from "../_nav";
import AppHeader from "../components/Header";
import Sidebar from "../components/Sidebar/Sidebar";
import AppAside from "../components/Asides/Aside";

export default {
  name: "layout",
  components: {
    AppHeader,
    Sidebar,
    AppAside
  },
  data() {
    console.log(nav.items);
    return {
      nav: nav.items
    };
  },
  computed: {}
};
</script>
