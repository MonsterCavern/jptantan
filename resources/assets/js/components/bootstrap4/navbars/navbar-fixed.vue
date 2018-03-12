<template lang="html">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="/">JPTANTAN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item" v-for="item in items" :key="item.route"  @click="$goRoute(item.route)">
                  <a class="nav-link">
                  <i :class="item.icon" class="fa" aria-hidden="true"></i>
                  <span class="">{{ item.text }}</span>
                  </a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            items: [
                { icon: 'fa-home', text: 'Home', route: '/home' },
                { icon: 'fa-history', text: 'Translate', route: '/translate' },
                //{ icon: 'fa-history', text: 'TranslateRoute', route: '/translate_r' }
            ]
        };
    }
};
</script>
<style>
  .navbar {
    z-index: 999;
  }
</style>
