
<style lang="scss">
</style>

<template>
  <div class="bokete">
    <div class="container">
      <!-- <BoleteGallery :images="list" :controlTitle="false" :layoutConfig="layoutConfig"></BoleteGallery> -->
    </div>
  </div>
</template>

<script>
// import BoketeIndexCard from "@pages/Bokete/Card"
import BoleteGallery from '@pages/Bokete/Gallery'

export default {
  name: 'BoketeIndex',
  components: {
    BoleteGallery
    // BoketeIndexCard
  },
  data() {
    // let items = []
    // for (var i = 0; i < 50; i++) {
    //   items.push({
    //     title: 'Image' + i,
    //     description: 'Description' + i,
    //     url: 'https://via.placeholder.com/600',
    //     thumbnail: 'https://via.placeholder.com/300',
    //     updated_at: '2018/08/30'
    //   })
    // }

    return {
      // list: items
      layoutConfig: {
        content: {
          node: '<p/>',
          attr: {
            text: 'content',
            class: 'text-content'
          }
        }
      }
    }
  },
  computed: {
    text() {
      return {}
    },
    list() {
      return this.$store.state.bokete.data
    }
  },
  mounted() {
    // init
    // this.getBokete()
  },
  methods: {
    getBokete() {
      return this.$store.dispatch('bokete/getData', { select: [], search: {} })
    }
  }
}
</script>