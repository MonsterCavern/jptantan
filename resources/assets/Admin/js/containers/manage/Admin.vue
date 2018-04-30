<template>
  <div class="container">
    <template v-if="id === '0'">
      <dataTable v-model="DefaultConf"></dataTable>
    </template>
    <template v-else>
      <vform :config="DefaultConf" ref="form"></vform>
    </template>
  </div>
</template>

<script>
import dataTable from "@components/DataTable";
import vform from "@components/Form";

const DefaultConf = {
    url: "",
    api: "api/admin/admins",
    primaryKey: "id",
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
                    href: "./admins/" + data
                    // target: "_blank"
                }).prop("outerHTML");
                return data;
            }
        },
        account: {
            required: true,
            label: "帳號",
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
    props: {
        id: {
            type: String,
            default: "0"
        }
    },
    components: { dataTable, vform },
    data() {
        if (this.id !== "0" && this.id !== "new") {
            let Model = this.getModel(DefaultConf);
        }
        return {
            DefaultConf: DefaultConf
        };
    },
    mounted() {},
    methods: {
        getModel: function(DefaultConf) {
            console.log(DefaultConf);
            let url = "/" + DefaultConf.api + "/" + this.id;
            let data = this.getRequestData(DefaultConf.columns);

            console.log(data);
            let result = demoCase(url, "GET", data);

            console.log(result);
        },
        getRequestData: function(columns) {
            let query = {
                columns: []
            };

            for (var column in columns) {
                query.columns.push({ data: column });
            }

            return query;
        }
    }
};
</script>
