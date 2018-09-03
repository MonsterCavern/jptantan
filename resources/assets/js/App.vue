<style lang="scss">
</style>

<template>

  <div id="app">
    <HeaderRoot></HeaderRoot>

    <main role="main">
      <router-view name="Jumbotron"></router-view>
      <router-view></router-view>
    </main>
  </div>

</template>

<script>
import HeaderRoot from '@pages/Header/Header'
export default {
  name: 'App',
  components: {
    HeaderRoot
  },
  data() {
    return {
      items: []
    }
  },
  computed: {
    text() {
      return {}
    }
  },
  created() {
    if (localStorage.getObject('user')) {
      console.log(localStorage.getObject('user'))
      this.$store.commit('setUser', localStorage.getObject('user'))
    }

    // resize
    window.addEventListener('resize', this.handleResize)
    this.handleResize()
  },
  methods: {
    handleResize() {
      this.$store.commit('handleResize')
    }
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.handleResize)
  }
}
</script>
