<template lang="html">
  <v-container>
    Hi,{{name}}
  </v-container>
</template>

<script>
export default {
    data() {
        return {
            name: this.$store.state.user.account
        }
    },
    mounted() {}
}
</script>

<style lang="css">
</style>
