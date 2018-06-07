<template lang="html">
    <v-container grid-list-xs,sm,md,lg,xl>
        <v-layout row wrap>
            <v-flex xs12 lg4 order-xs3 order-lg1 pa-1>
                其他翻譯
            </v-flex>
            <v-flex xs12 lg4 order-xs2 order-lg2 pa-1>
                <v-tabs fixed-tabs centered value="tab-content">
                    <v-tabs-slider color="yellow"></v-tabs-slider>
                    <v-tab href="#tab-source">
                        Source
                    </v-tab>
                    <v-tab href="#tab-content">
                        Content
                    </v-tab>
                    <v-tab-item id="tab-source">
                        <v-card flat>
                            <v-card-media contain height="auto">
                                <div class="img-responsive mx-auto" v-if="(bokete.hasOwnProperty('source'))" v-html="bokete.source"></div>
                            </v-card-media>
                        </v-card>
                    </v-tab-item>
                    <v-tab-item id="tab-content">
                        <v-flex xs12 py-1 v-for="(contextValue,index) in bokete.content" :key="index">
                            <v-card pa-2>
                                <v-card-title>
                                    <v-text-field disabled textarea :name="'input-source-'+index" :value="contextValue"></v-text-field>
                                </v-card-title>
                            </v-card>
                        </v-flex>
                    </v-tab-item>
                </v-tabs>
            </v-flex>
            <v-flex xs12 lg4 order-xs1 order-lg3 pa-1>
                <v-tabs fixed-tabs centered>
                    <v-tabs-slider color="yellow"></v-tabs-slider>
                    <v-tab href="#tab-translate">
                        Translate
                    </v-tab>
                    
                    <v-tab-item id="tab-translate">
                        <v-flex xs12 py-1 v-for="(contextValue,index) in translate.content" :key="index">
                            <v-card class="black--text">
                                <v-card-title>
                                    <v-text-field 
                                      class="trans-textarea" 
                                      textarea 
                                      :name="'input-translate-'+index" 
                                      v-model="contextValue.after"
                                      @change="updateContent"
                                    >
                                    </v-text-field>
                                </v-card-title>
                            </v-card>
                        </v-flex>
                    </v-tab-item>
                </v-tabs>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
export default {
    // Options / Data
    data() {
        return {}
    },
    props: ['number'],
    // propsData: {},
    computed: {
        bokete() {
            // get target bokete by number
            let { bokete, index } = this.$store.getters['bokete/getBoketeByNumber'](this.number)
            if (bokete == null) {
                bokete = this.$store.state.bokete.bokete
                this.$router.push({ name: 'bokete', replace: true })
            }
            return bokete
        },
        translate() {
            let translate = this.$store.state.translate.bokete
            let boketeContent = this.$store.state.boketeContent
            if (translate.content.lenght == 0) {
                translate.content.push(boketeContent)
            }

            for (var i = 0; i < translate.content.length; i++) {
                let content = translate.content[i]
                for (var key in boketeContent) {
                    if (!content.hasOwnProperty(key)) {
                        translate.content[i][key] = boketeContent[key]
                    }
                }
            }

            //  對應 index 把原文存在 before 內, 或補足原文長度
            for (var i = 0; i < this.bokete.content.length; i++) {
                if (typeof translate.content[i] != 'undefined') {
                    translate.content[i].before = this.bokete.content[i]
                } else {
                    boketeContent.before = this.bokete.content[i]
                    translate.content.push(boketeContent)
                }
            }

            return translate
        }
    },
    methods: {
        updateContent() {
            let contents = this.translate.content
            this.$store.dispatch('translate/updateContent', { contents: contents, id: this.translate.id })
        }
    },
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
        this.$store.dispatch('translate/getTranslateSelf', { targetID: this.number, targetType: 'boketes' })
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
.input-group__input {
    padding: 0px !important;
}

textarea {
    padding: 30px 0 0 13px !important;
}

.trans-textarea>.input-group__input {
    background-color: white;
}

.trans-textarea>.input-group__input>textarea {
  color: black !important;
}
</style>
