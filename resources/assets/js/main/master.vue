<template lang="html">
  <div id='app'>
    <navbarFixed></navbarFixed>
    <main role="main" class="container">
      <router-view :key="this.$route.fullPath">
      </router-view>
    </main>
  </div>
  
</template>

<script>
import navbarFixed from '../components/bootstrap4/navbars/navbar-fixed';

export default {
    components:{
        navbarFixed
    },
    methods: {
        log: function(val) {
            console.log(val);
        }
    }
};
</script>

<style lang="css">
body {
  min-height: 75rem;
  padding-top: 4.5rem;
}
</style>
