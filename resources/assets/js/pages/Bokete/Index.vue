<style lang="scss" >
</style>

<template>

<div class="bokete">

    <div class="container">
      <BoleteGallery :images="list"></BoleteGallery>
    </div>
</div>

</template>

<script>
// import BoketeIndexCard from "@pages/Bokete/Card"
import BoleteGallery from "@components/v-gallery/Gallery"
export default {
    name: "BoketeIndex",
    components: {
        BoleteGallery
        // BoketeIndexCard
    },
    data() {
        let items = []

        for (var i = 0; i < 50; i++) {
            items.push({
                title: "Image" + i,
                description: "",
                url: "https://via.placeholder.com/600",
                thumbnail: "https://via.placeholder.com/300",
                updated_at: "2018/08/30"
            })
        }

        return {
            list: items
        }
    },
    computed: {
        text() {
            return {}
        }
    }
}
</script>
