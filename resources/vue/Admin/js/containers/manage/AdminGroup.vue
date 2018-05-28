<template>
  <div class="container">
    <dataTable v-model="dataTableConfig"></dataTable>
  </div>
</template>

<script>
import dataTable from "@components/DataTable";

const vTableDefaultConf = {
    api: "api/admin/admin_groups",
    primaryKey: "admin_group_id",
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
                    href: "./admin_groups/" + data
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
