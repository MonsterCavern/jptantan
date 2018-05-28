<template lang="html">
    <form :action="action">
        <vue-form-generator :model="cModel" :schema="cSchema" :options="cFormOptions" ></vue-form-generator>
    </form>
</template>

<script>
require("jquery-serializejson");
require("jquery-validation");
require("jquery-validation/dist/localization/messages_zh_TW.js");
import Vue from "vue";
import VueFormGenerator from "vue-form-generator";

import fieldDiv from "./FormGenerator/fieldDiv.vue";
import fieldTools from "./FormGenerator/fieldTools.vue";
Vue.component("fieldTools", fieldTools);

export default {
    props: {
        config: Object,
        id: {
            type: String
        }
    },
    components: {
        "vue-form-generator": VueFormGenerator.component
    },
    data() {
        return {
            action: "/"
        };
    },
    mounted() {
    // let $validate = $(this.$el).validate({
    //     submitHandler: this.submit
    // });
    },
    created: function() {
        this.action = "/" + this.config.api;
        if (this.id !== "new") {
            this.action += "/" + this.id;
        }

        let configs = this.setConfig(this.config);

        this.cModel = configs.model;
        this.cSchema = configs.schema;
        this.cFormOptions = configs.formOptions;
    },
    methods: {
        setConfig: function(config) {
            let model = this.getModel(config);
            let schema = {};
            let formOptions = {};
            let groups = [];
            let fields = [];

            if (config.hasOwnProperty("columns")) {
                for (var column in config.columns) {
                    let field = config.columns[column];

                    if (Array.isArray(field)) {
                        continue;
                    }
                    // EXCEPTION
                    if (this.id === "new" && column === config.primaryKey) {
                        continue;
                    }

                    // 預設 inputType == text
                    if (!field.hasOwnProperty("inputType")) {
                        field.inputType = "text";
                    }

                    // 預設 POST name == column key
                    if (!field.hasOwnProperty("inputName")) {
                        field.inputName = column;
                    }

                    if (
                        typeof model[column] !== "undefined" &&
            field.hasOwnProperty("default")
                    ) {
                        model[column] = field.default;
                    }

                    field["id"] = column + "_" + this["_uid"];
                    field["model"] = column;
                    fields.push(field);
                }

                schema.fields = fields;
            }
            if (
                config.hasOwnProperty("options") &&
        config.options.hasOwnProperty("formOptions")
            ) {
                formOptions = config.options.formOptions;
            }

            return {
                model: model,
                schema: schema,
                formOptions: formOptions
            };
        },
        getModel: function(DefaultConf) {
            this.api = "/" + DefaultConf.api;
            if (this.id !== "new") {
                this.api += "/" + this.id;
                let data = this.getRequestData(DefaultConf.columns);
                let result = ajaxCase(this.api, "GET", data);

                if (result.code === 200) {
                    return result.data;
                }
            }
            return {};
        },
        getRequestData: function(columns) {
            let query = {
                columns: []
            };

            for (var column in columns) {
                if (Array.isArray(columns[column])) {
                    continue;
                }

                if (
                    columns[column].hasOwnProperty("ignore") &&
          columns[column].ignore.indexOf("form") !== -1
                ) {
                    continue;
                }

                query.columns.push({ data: column });
            }

            return query;
        }
    }
};
</script>

<style lang="css">
</style>
