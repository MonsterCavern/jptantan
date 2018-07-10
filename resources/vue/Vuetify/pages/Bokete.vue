<template lang="html">
    <v-container>
        <template v-for="(item, index) in boketes">
            <v-layout wrap>
                <v-flex xl8 class="mx-auto">
                    <v-card class="white--text">
                        <v-container grid-list-xs,sm,md,lg,xl>
                            <v-layout row wrap>
                                <v-flex xs12>
                                    <p>{{ item.released_at }}</p>
                                </v-flex>
                                <v-flex>
                                    <div class="img-responsive" v-html="item.source"></div>
                                </v-flex>
                                <v-flex d-flex md4 sm12 xs12>
                                    <!--  -->
                                    <v-list>
                                        <v-card class="white black--text text-left" v-if="user !== null">
                                            <v-card-actions>
                                                <v-btn block color="primary" :to="{path:'/bokete/translate/'+item.number}">我的翻譯</v-btn>
                                            </v-card-actions>
                                        </v-card>
                                        <template v-for="(translate, ind) in item.translates">
                                            <v-card class="white black--text text-left">
                                                <v-card-text>
                                                    <span v-for="content in translate.content">
                                                      {{ content.after }}
                                                    </span>
                                                </v-card-text>
                                                <v-card-actions>
                                                    <v-spacer></v-spacer>
                                                    <v-btn icon>
                                                        <v-icon color="yellow darken-2">star</v-icon>
                                                    </v-btn>
                                                </v-card-actions>
                                            </v-card>
                                            <v-divider v-if="ind + 1 < item.translates.length" :key="ind"></v-divider>
                                        </template>
                                        <v-card class="white black--text text-left">
                                            <v-card-actions>
                                                <v-btn block color="primary" @click="updateTranslatesByBoketeNum(item.number,index)">載入更多</v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-list>
                                    <!--  -->
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card>
                    <v-divider v-if="index + 1 < boketes.length" :key="index"></v-divider>
                </v-flex>
            </v-layout>
        </template>
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
        user() {
            return this.$store.state.user
        },
        boketes() {
            return this.$store.state.bokete.data
        }
    },
    mounted() {
        this.$store.dispatch('bokete/init')
    },
    methods: {
        updateTranslatesByBoketeNum(number, index) {
            this.$store.dispatch('bokete/updateTranslates', {
                number: number,
                index: index
            })
        }
    }
}
</script>

<style lang="css">
.img-responsive {
    max-width: 100%;
    overflow: hidden;
}

.img-responsive img {
    width: 100%;
}
</style>
