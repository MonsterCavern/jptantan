<style lang="scss" >
</style>

<template>
  <div class="card-columns" :style="getCardColumnCount">
    
    <div class="card" v-for="item in items" :key="item.key">
      <img class="card-img" src="https://placehold.it/50x50" alt="">
    </div>
    
  </div>
</template>

<script>
export default {
    name: "NavBarItemsCard",
    data() {
        return {
            items: [
                {
                    image: ""
                },
                {
                    image: ""
                },
                {
                    image: ""
                },
                {
                    image: ""
                },
                {
                    image: ""
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

            if (this.$store.state.screenWidth < 978) {
                count = 4
            }

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
