<template lang="html">

    <div class="card">
        <div class="card-body">
            <fab :actions="createFABs" @goPage="goPage('list')" @submit="vformSubmit">
            </fab>
            <vform :config="vformConfig" ref="form"></vform>
        </div>
    </div>
</template>

<script>
import fab from 'vue-fab';
import vform from "../../components/Form";

const vformDefaultConf = {
    api: 'api/translate',
    type: 'new',
    form_groups: [{
        legend: "Url Details",
        fields: ['id', 'title']
    }],
    columns: {
        id: {
            required: true,
            label: '編號',
            type: "input",
            inputType: "url",
            inputName: "url", // name
            styleClasses: "", // .form-group 
            placeholder: '流水號',
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
            label: "標題",
            type: "input",
            inputType: "text",
            inputName: "title",
            styleClasses: "", // .form-group 
            default: 'http://',
            placeholder: ""
        }
    },
    options: {
        formOptions: {
            validateAfterLoad: false,
            validateAfterChanged: false
        },
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
        vform
    },

    methods: {
        goPage: function(val) {
            // 回傳 給父組件
            this.$emit('changeComponent', val);
        },
        vformSubmit: function(form) {
            // this.$refs.child1.handleParentClick("ssss");
            this.$refs.form.submit();
        }
    },
    data() {
        // 使用 本組件內 預設設定檔, 不然繼承 props 的指定設定檔
        let vformConfig = vformDefaultConf;
        if (typeof this.configs !== 'undefined' && typeof this.configs.vformConfig === 'object') {
            vformConfig = $.extend(vformConfig,this.configs.vformConfig);
        }
        // vformConfig = this.configs.vformConfig;

        return {
            vformConfig: vformConfig,
            createFABs: [{
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
    mounted(){
      // console.log(this);
    }
};
</script>

<style lang="css">
</style>
