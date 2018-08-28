<style lang="scss" >
</style>

<template>

<ul class="navbar-nav mr-auto">
    <li class="nav-item" v-for="item in items" :key="item.key">
        <a class="nav-link btn btn-link" href="#">
          {{ item.title }}
          <span class="sr-only"></span>
        </a>
    </li>
</ul>

</template>

<script>
export default {
    name: "NavBarItemsList",
    data() {
        return {
            items: [
                {
                    title: "A"
                },
                {
                    title: "B"
                },
                {
                    title: "C"
                },
                {
                    title: "D"
                },
                {
                    title: "E"
                }
            ]
        }
    },
    computed: {
        text() {
            return {}
        },
        getCardColumnCount() {
            let count = 5

            if (this.$store.state.screenWidth < 768) {
                count = 3
            }

            if (this.$store.state.screenWidth < 576) {
                count = 1
            }

            let style =
                "-webkit-column-count: " +
                count +
                ";" +
                "-moz-column-count: " +
                count +
                ";" +
                "column-count: " +
                count +
                ";"

            console.log(style)
            return style
        }
    }
}
</script>
