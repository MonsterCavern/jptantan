<template lang="html">
    <form>
        <vue-form-generator :model="cModel" :schema="cSchema" :options="cFormOptions"/>
        <!-- <input type="submit" value="送出"> -->
    </form>
</template>

<script>
require('jquery-serializejson');
require('jquery-validation');
require('jquery-validation/dist/localization/messages_zh_TW.js');
import VueFormGenerator from "vue-form-generator";

export default {
    props: {
        config: Object,
        schema: {
            default: Object,
            type: Object
        },
        model: {
            default: Object,
            type: Object
        },
        formOptions: {
            default: function() {
                return {
                    validateAfterLoad: false,
                    validateAfterChanged: false,
                }
            },
            type: Object
        },
    },
    components: {
        "vue-form-generator": VueFormGenerator.component
    },
    data() {
        let model = this.model;
        let schema = this.schema;
        let formOptions = this.formOptions;
        let api = '/';

        if (typeof this.config !== 'undefined') {
            // 必定需要 this.config.api 和 this.config.type
            if (this.config.hasOwnProperty()) {
              
            }
            // type = edit
            // 取得 編輯資料 (ajax)
            
            // 載入設定
            let config = this.setConfig(this.config);
            model = config.model;
            schema = config.schema;
            formOptions = config.formOptions;
            api = config.api;
        }
        return {
            cModel: model,
            cSchema: schema,
            cFormOptions: formOptions,
            api: api
        };
    },
    mounted() {
        if (typeof this.formOptions === 'undefined') {
            return true;
        }

        let fields = {};

        if (this.schema.hasOwnProperty('groups')) {
            for (var groups in this.schema.groups) {
                fields = $.extend(fields, groups.fields);
            }
        } else {
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
    methods: {
        setConfig: function(config) {
          console.log('85',config);
          let model = {};
          if (config.hasOwnProperty('columns')) {
            for (var column in config.columns) {
              let field = config.columns[column];
              if (field.hasOwnProperty('default')) {
                model[column] = field.default
              }else {
                  
              }
            }
          }
          // return {
          //     model: model,
          //     schema: schema,
          //     formOptions: formOptions,
          //     api: api
          // }; 
        },
        submit: function(form) {
            let data = $(form).serializeJSON();

            $.ajax({
                url: this.api,
                method: 'POST',
                data: data
            });
        }
    }
};
</script>

<style lang="css">
</style>
