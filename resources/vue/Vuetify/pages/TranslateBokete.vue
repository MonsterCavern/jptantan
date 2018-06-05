<template lang="html">
    <v-container>
        <h1>Bokete {{number}}</h1>
        <v-layout row wrap>
            <v-flex xs6>
                <v-card>
                    <v-container grid-list-xs,sm,md,lg,xl>
                        <v-layout row wrap>
                            <v-flex xs6>
                                <div class="img-responsive" v-if="(bokete.hasOwnProperty('source'))" v-html="bokete.source"></div>
                            </v-flex>
                            <v-flex xs6>
                                <!--  -->
                                <v-list>
                                    <template v-for="(translate, ind) in bokete.translates">
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
                                        <v-divider v-if="ind + 1 < bokete.translates.length" :key="ind"></v-divider>
                                    </template>
                                    <v-card class="white black--text text-left">
                                        <v-card-actions>
                                            <v-btn block color="primary" @click="updateTranslatesByBoketeNum(bokete.number,boketeIndex)">載入更多</v-btn>
                                        </v-card-actions>
                                    </v-card>
                                </v-list>
                                <!--  -->
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card>
            </v-flex>
            <v-flex xs6>
                <v-card>
                  <v-card-title primary-title>
                    翻譯Block
                  </v-card-title>
                  <v-card-title primary-title >
                    <v-text-field  box name="input" multi-line v-for="(content,index) in translateContent" v-model="content.after" :key="index"></v-text-field>
                  </v-card-title>
                  <v-card-actions>
                    <v-btn color="primary">Save</v-btn>
                  </v-card-actions>
                </v-card>
            </v-flex>

        </v-layout>

    </v-container>
</template>

<script>
export default {
    // Options / Data
    data() {
        return {
            bokete: {},
            boketeIndex: null
            // translateContent: null
        }
    },
    computed: {
        translateContent() {
            if (this.$store.state.translate.translateEditting.hasOwnProperty('content')) {
                return this.$store.state.translate.translateEditting.content
            }
            return []
        }
    },
    props: ['number'],
    methods: {
        updateTranslatesByBoketeNum(number, index) {
            this.$store.dispatch('bokete/updateTranslates', {
                number: number,
                index: index
            })
        }
    },
    created() {
        let { bokete, index } = this.$store.getters['bokete/getBoketeByNumber'](this.number)
        if (bokete === null) {
            // this.$router.push({ path: '/bokete' })
        } else {
            this.bokete = bokete
            this.boketeIndex = index
        }
    },
    mounted() {
        if (typeof this.number != 'undefined') {
            this.$store.dispatch('translate/getTranslateByTargetIDFilterType', { targetID: this.number, targetType: 'boketes' })
        }
    },
    watch: {
        translateContent: {
            deep: true,
            handler(newValue, oldValue) {
                console.log(newValue)
            }
        }
    }
}
</script>
<style lang="css">
</style>
