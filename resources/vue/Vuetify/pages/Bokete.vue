<template lang="html">
    <v-container>
        <h1>Bokete</h1>

        <v-list two-line>
            <template v-for="(item, index) in bokete">
                <v-list-tile :key="item.title" avatar ripple @click="toggle(index)">
                    <v-list-tile-content v-html="item.source">
                        <v-list-tile-sub-title class="text--primary">{{ item.headline }}</v-list-tile-sub-title>
                    </v-list-tile-content>
                    <v-list-tile-action>
                        <v-list-tile-action-text>{{ item.created_at }}</v-list-tile-action-text>
                        <v-icon v-if="selected.indexOf(index) < 0" color="grey lighten-1">star_border</v-icon>
                        <v-icon v-else color="yellow darken-2">star</v-icon>
                    </v-list-tile-action>
                </v-list-tile>
                <v-divider v-if="index + 1 < items.length" :key="index"></v-divider>
            </template>
        </v-list>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            selected: []
        }
    },
    computed: {
        bokete() {
            return this.$store.state.bokete.data
        }
    },
    mounted() {
        this.$store.dispatch('bokete/init')
    }
}
</script>

<style lang="css">
</style>
