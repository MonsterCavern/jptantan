<template lang="html">
  <div class="animated fadeIn">
    <div class="row">
      <fab :actions="createFABs" @goPage="$goRoute('/translate')" @submit="vformSubmit">
      </fab>
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <vform :config="vformConfig" ref="form" v-model="formData"></vform>
            </div>
          </div>
        </div>
    </div>
    <PreView :formData="formData"></PreView>
  </div>
</template>

<script>
import fab from "vue-fab";
import vform from "@components/Form";
import PreView from "./preview";

const vformDefaultConf = {
    api: "/api/url",
    type: "new",
    primaryKey: "id",
    formGroups: [
        {
            legend: "Url Details",
            fields: ["id", "title"]
        }
    ],
    columns: {
        id: {
            // required: true,
            label: "編號",
            type: "input",
            inputType: "url",
            inputName: "id", // name
            styleClasses: "", // .form-group
            placeholder: "流水號",
            disabled: true
        },
        title: {
            required: true,
            label: "標題",
            type: "input",
            inputType: "text",
            inputName: "title",
            styleClasses: "", // .form-group
            placeholder: "MetaTitle"
        },
        url: {
            required: true,
            label: "網址",
            type: "input",
            inputType: "url",
            inputName: "url",
            styleClasses: "", // .form-group
            // default: 'http://',
            placeholder: "http://"
        }
    },
    options: {
        formOptions: {
            validateAfterLoad: false,
            validateAfterChanged: false
        }
    }
};

export default {
    props: {
        configs: {
            type: Object,
            default: Object
        }
    },
    components: {
        fab,
        vform,
        PreView
    },
    methods: {
        goPage: function(val) {
            // 回傳 給父組件
            this.$emit("changeComponent", val);
        },
        vformSubmit: function() {
            // this.$refs.child1.handleParentClick("ssss");
            // 觸發 form submit
            $(this.$refs.form.$el).trigger("submit");
        }
    },
    data() {
    // 使用 本組件內 預設設定檔, 不然繼承 props 的指定設定檔
        let vformConfig = vformDefaultConf;

        if (
            typeof this.configs !== "undefined" &&
      typeof this.configs.vformConfig === "object"
        ) {
            vformConfig = $.extend(vformConfig, this.configs.vformConfig);
        }
        // vformConfig = this.configs.vformConfig;

        return {
            vformConfig: vformConfig,
            createFABs: [
                {
                    name: "submit",
                    icon: "send",
                    tooltip: "送出"
                },
                {
                    name: "goPage",
                    icon: "undo",
                    tooltip: "返回"
                }
            ],
            formData: {}
        };
    },
    mounted() {
    // console.log(this);
    }
};
</script>

<style lang="css">
</style>
