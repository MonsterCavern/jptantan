<template lang="html">
    <v-container>
      Hello World 
      <div v-for="vaule in bokete">
        {{ vaule }}
      </div>
    </v-container>
</template>

<script>
export default {
    // Options / Data
    data() {
        return {}
    },
    // props: [],
    // propsData: {},
    computed: {
        bokete() {
            return this.$store.state.bokete.data
        }
    },
    // methods: {},
    // watch: {},
    // Options / DOM
    // el () {},
    // template: '',
    // render () {},
    // Options / Lifecycle Hooks
    // beforeCreate () {},
    // created () {},
    // beforeMount () {},
    mounted() {
        this.$store.dispatch('bokete/init')
    }
    // beforeUpdate () {},
    // updated () {},
    // activated () {},
    // deactivated () {},
    // beforeDestroy () {},
    // destroyed () {},
    // Options / Assets
    // directives: {},
    // filters: {},
    // components: {},
    // Options / Misc
    // parent: null,
    // mixins: [],
    // name: '',
    // extends: {},
    // delimiters: [ '{{', '}}' ],
    // functional: false
}
</script>

<style lang="css">
</style>
