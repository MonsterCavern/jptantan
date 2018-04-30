<template>
  <div class="container">
    <dataTable v-model="dataTableConfig"></dataTable>
  </div>
</template>

<script>
import dataTable from "@components/DataTable";
const vTableDefaultConf = {
    url: "",
    api: "api/admin/permissions",
    primaryKey: "admin_id",
    columns: {
        id: {
            // required: true,
            label: "編號",
            type: "input",
            // inputType: "url",
            inputName: "id", // name
            styleClasses: "", // .form-group
            placeholder: "系統編號",
            disabled: true,
            render: function(data, type, full, meta) {
                // console.log(data, type, full, meta);
                data = $("<a/>", {
                    text: data,
                    href: "./permissions/" + data
                    // target: "_blank"
                }).prop("outerHTML");
                return data;
            }
        },
        name: {
            required: true,
            label: "名稱",
            type: "input",
            inputType: "text",
            inputName: "title",
            styleClasses: "", // .form-group
            placeholder: "MetaTitle"
        },
        slug: {
            required: true,
            label: "標示",
            type: "input",
            inputType: "text",
            inputName: "title",
            styleClasses: "", // .form-group
            placeholder: "xxx.xxx"
        },
        method: {
            required: true,
            label: "Method",
            type: "input",
            inputType: "text",
            inputName: "title",
            styleClasses: "", // .form-group
            placeholder: "GET,PUT,POST,DELETE"
        },
        path: {
            required: true,
            label: "URL",
            type: "input",
            inputType: "text",
            inputName: "title",
            styleClasses: "", // .form-group
            placeholder: "/"
        },
        prefix: {
            required: true,
            label: "前綴",
            type: "input",
            inputType: "text",
            inputName: "title",
            styleClasses: "" // .form-group
        },
        created_at: {
            label: "建立時間",
            type: "input",
            inputType: "url",
            inputName: "url",
            styleClasses: "" // .form-group
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
    props: ["id"],
    components: { dataTable },
    data() {
        console.log(this);
        return {
            dataTableConfig: vTableDefaultConf
        };
    },
    mounted() {}
};
</script>
