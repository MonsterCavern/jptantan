<template lang="html">
    
    <div class="col-lg-12 card">
        <div class="card-body">
          <fab 
            :actions="createFABs"
            @goPage = "goPage('list')"
            @submit = "submit"
          >
          </fab>
          <vform :schema="schema" :model="model"></vform>
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
                        label: "網址",
                        model: "url",
                        required: true,
                        placeholder: "http://",
                    },
                    {
                        id: "TitleInput",
                        type: "input",
                        inputType: "text",
                        label: "標題",
                        model: "title",
                        max: 2,
                        required: true,
                        placeholder: "MetaTitle"
                    },
                    {
                        type: "select",
                        label: "Skills",
                        model: "skills",      
                        values: ["Javascript", "VueJS", "CSS3", "HTML5"]
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
        get: function (model) {
            console.log(model);
        },
        onValidated(isValid, errors) {
            console.log("Validation result: ", isValid, ", Errors:", errors);
        },
        goPage: function (val) {
            this.$emit('changeComponent', val);
        },
        submit: function () {
            console.log('Submit');
        }
    }
};
</script>

<style lang="css">
</style>
