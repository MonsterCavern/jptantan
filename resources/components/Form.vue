<template lang="html">
    <form>
        <vue-form-generator :model="cModel" :schema="cSchema" :options="cFormOptions" />
    </form>
</template>

<script>
require("jquery-serializejson");
require("jquery-validation");
require("jquery-validation/dist/localization/messages_zh_TW.js");
import VueFormGenerator from "vue-form-generator";

export default {
    props: {
        config: Object,
        id: {
            type: String,
            default: "0"
        }
    },
    components: {
        "vue-form-generator": VueFormGenerator.component
    },
    data() {
        if (this.id !== "new") {
        }
        let config = this.setConfig(this.config);

        console.log(config);

        let model = this.model;
        let schema = this.schema;
        let formOptions = this.formOptions;
        let api = "/";

        // if (typeof this.config !== "undefined") {
        //     // 必定需要 this.config.api 和 this.config.type
        //     if (
        //         this.config.hasOwnProperty("api") &&
        // this.config.hasOwnProperty("type")
        //     ) {
        //         // type = edit
        //         // 取得 編輯資料 (ajax)
        //
        //         // 載入設定
        //         let config = this.setConfig(this.config);
        //
        //         model = config.model;
        //         schema = config.schema;
        //         formOptions = config.formOptions;
        //         api = this.config.api;
        //     }
        // }
        return {
            cModel: model,
            cSchema: schema,
            cFormOptions: formOptions,
            api: api
        };
    },
    mounted() {
        if (typeof this.cFormOptions === "undefined") {
            return true;
        }
        let $validate = $(this.$el).validate({
            submitHandler: this.submit
        });
    },
    methods: {
        setConfig: function(config) {
            let model = {};
            let schema = {};
            let formOptions = {};
            let groups = [];
            let fields = [];

            if (config.hasOwnProperty("columns")) {
                for (var column in config.columns) {
                    // EXCEPTION
                    if (this.id === "new" && column === config.primaryKey) {
                        continue;
                    }

                    let field = config.columns[column];

                    if (field.hasOwnProperty("default")) {
                        model[column] = field.default;
                    } else {
                        model[column] = "";
                    }

                    field["id"] = field.inputType + "_" + column + "_" + this["_uid"];
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
        submit: function(form) {
            let data = $(form).serializeJSON();

            $.ajax({
                url: this.api,
                method: "POST",
                data: data
            });
        }
    },
    watch: {
        cModel: {
            handler(newSong, oldSong) {
                this.$emit("input", newSong);
            },
            deep: true
        }
    }
};
</script>

<style lang="css">
</style>
