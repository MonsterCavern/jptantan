<template lang="html">
  <v-container>
    Hi,{{name}}
  </v-container>
</template>

<script>
export default {
    data() {
        return {
            name: this.user ? this.user : 'Guest'
        }
    },
    computed: {
        user() {
            return this.$store.state.user
        }
    },
    mounted() {}
}
</script>

<style lang="css">
</style>
