<template>
  <header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button" @click="mobileSidebarToggle">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" @click="sidebarMinimize">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- 靠左邊 -->
    <ul class="nav navbar-nav d-md-down-none">
      <li class="nav-item px-3" v-for="item in items" :key="item.route"  @click="$goRoute(item.route)">
        <a class="nav-link">
        <i :class="item.icon" class="fa" aria-hidden="true"></i>
        <span class="">{{ item.text }}</span>
        </a>
      </li>
      <!-- <li class="nav-item px-3">
        <a class="nav-link" href="#">Dashboard</a>
      </li>-->
    </ul>
    
    <!-- 靠右邊 && 填充寬度 -->
    <ul class="nav navbar-nav ml-auto">
      <!-- <li class="nav-item d-md-down-none">
        <a class="nav-link" href="#"><i class="icon-bell"></i><span class="badge badge-pill badge-danger">5</span></a>
      </li>
      <li class="nav-item d-md-down-none">
        <a class="nav-link" href="#"><i class="icon-list"></i></a>
      </li>
      <li class="nav-item d-md-down-none">
        <a class="nav-link" href="#"><i class="icon-location-pin"></i></a>
      </li> -->
    </ul>
    
    <button class="navbar-toggler aside-menu-toggler" type="button" @click="asideToggle">
      <span class="navbar-toggler-icon"></span>
    </button>
  </header>
</template>
<script>
export default {
  data() {
      return {
          items: [
              { icon: 'fa-home', text: 'Home', route: '/home' },
              { icon: 'fa-history', text: 'Translate', route: '/translate' },
          ]
      };
  },
  methods: {
    sidebarToggle (e) {
      e.preventDefault()
      document.body.classList.toggle('sidebar-hidden')
    },
    sidebarMinimize (e) {
      e.preventDefault()
      document.body.classList.toggle('sidebar-minimized')
    },
    mobileSidebarToggle (e) {
      e.preventDefault()
      document.body.classList.toggle('sidebar-mobile-show')
    },
    asideToggle (e) {
      e.preventDefault()
      document.body.classList.toggle('aside-menu-hidden')
    }
  }
}
</script>
