<template lang="html">
    <form>
        <vue-form-generator :schema="schema" :model="model" :formOptions="formOptions"></vue-form-generator>
        <input type="submit" value="送出">
    </form>
</template>

<script>
require('jquery-serializejson');
require('jquery-validation');
require('jquery-validation/dist/localization/messages_zh_TW.js');
import VueFormGenerator from "vue-form-generator";

export default {
    props:{
        schema: Object,
        model: Object,
        formOptions: {
            type: Object,
            default: function () {
                return {};
            }
        },
    },
    // props: [
    //     'schema', 'model','formOptions'
    // ],
    components:{
        "vue-form-generator": VueFormGenerator.component
    },
    data() {
        return {
        };
    },
    mounted(){
        if (Object.keys(this.formOptions).length > 0) {
            return true;
        }
        
        let fields = {};

        if (this.schema.hasOwnProperty('groups')) {
            for (var groups in this.schema.groups) {
                fields = $.extend(fields,groups.fields);
            }
        }else {
            fields = this.schema.fields;
        }
      
        let rules = {};

        for (var field in fields) {
            rules[field.model] = field;
        }
        let $validate = $(this.$el).validate({
            rules: rules,
            submitHandler: this.submit
        });
    },
    methods:{
        submit: function (form) {
            let data = $(form).serializeJSON();

            $.ajax({
                url:'/api/url',
                method:'POST',
                data:data
            });
        }
    }
};
</script>

<style lang="css">
</style>
