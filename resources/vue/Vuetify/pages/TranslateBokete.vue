<template lang="html">
    <v-container>
        <h1>Bokete {{number}}</h1>
        <v-layout row wrap>
            <v-flex xs6>
                <v-card>
                    <v-container grid-list-xs,sm,md,lg,xl>
                        <v-layout row wrap>
                            <v-flex xs6>
                                <div class="img-responsive" v-if="(bokete != null && bokete.hasOwnProperty('source'))" v-html="bokete.source"></div>
                            </v-flex>
                            <v-flex xs6>
                                <!--  -->
                                <v-list v-if="bokete != null">
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
                    <v-card-title primary-title>
                      <v-flex xs12 v-for="(content,index) in translateContent" :key="index">
                        <v-text-field box name="input" multi-line  v-model="content.after" @change="updateContent"></v-text-field>
                      </v-flex>
                    </v-card-title>
                    <v-card-actions>
                      <v-btn color="primary" @click="addContent">Add</v-btn>
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
        let { bokete, index } = this.$store.getters['bokete/getBoketeByNumber'](this.number)
        if (bokete === null) {
            this.$router.push({ path: '/bokete' })
        }

        return {
            bokete: bokete,
            boketeIndex: index,
            translateID: null
        }
    },
    computed: {
        translateContent() {
            let translate = this.$store.state.translate.translateSelf
            if ($.isEmptyObject(translate)) {
                return []
            } else {
                this.translateID = translate.id
                return translate.content
            }
        }
    },
    props: ['number'],
    methods: {
        updateTranslatesByBoketeNum(number, index) {
            this.$store.dispatch('bokete/updateTranslates', {
                number: number,
                index: index
            })
        },
        async updateContent() {
            let contents = this.translateContent
            await this.$store.dispatch('translate/updateContent', { contents: contents, id: this.translateID })
            let { bokete } = this.$store.getters['bokete/getBoketeByNumber'](this.number)
            this.bokete = bokete
        },
        addContent() {
            this.translateContent.push({ after: '' })
        }
    },
    created() {},
    mounted() {
        // get Translate Self
        this.$store.dispatch('translate/getTranslateSelf', { targetID: this.number, targetType: 'boketes' })
    },
    watch: {
        translateContent: {
            deep: true,
            handler(newValue, oldValue) {
                if (this.translateID) {
                    let translateIndex = this.bokete.translates.findIndex(translate => translate.id == this.translateID)
                    this.bokete.translates[translateIndex].content = newValue
                }
            }
        }
    }
}
</script>
<style lang="css">
</style>
