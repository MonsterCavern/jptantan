<template lang="html">
    
    <div class="card">
        <div class="card-body">
          <fab
            :actions="createFABs"
            @goPage = "goPage('list')"
            @submit = "submit"
          >
          </fab>
          <vform :schema="schema" :model="model" @submit="submit"></vform>
        </div>
    </div>
</template>

<script>
import fab from 'vue-fab';
import vform from "../../components/form/form";

export default {
    props: ['config'],
    components: {
        fab,
        vform
    },
    data() {
        let configs = this.configs;

        return {
            model: {
                url: "",
                title: "",
            },
            schema: {
                fields: [
                    {
                        id: "UrlInput",
                        type: "input",
                        inputType: "url",
                        inputName:"url",
                        label: "網址",
                        model: "url",
                        //required: true,
                        placeholder: "http://",
                    },
                    {
                        id: "TitleInput",
                        type: "input",
                        inputType: "text",
                        inputName:"title",
                        label: "標題",
                        model: "title",
                        //required: true,
                        placeholder: "MetaTitle"
                    }
                ]
            },
            formOptions: {
                validateAfterLoad: false,
                validateAfterChanged: false
            },
            createFABs: [
                {
                    name: 'submit',
                    icon: 'send',
                    tooltip: '送出'
                },
                {
                    name: 'goPage',
                    icon: 'undo',
                    tooltip: '返回'
                }
            ]
        };
    },
    methods: {
        goPage: function (val) {
            this.$emit('changeComponent', val);
        },
        submit: function (form) {
            // this.$refs.child1.handleParentClick("ssss");
            console.log(this.$refs);
        }
    }
};
</script>

<style lang="css">
</style>
