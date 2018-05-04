// initial state
const state = {
    url: "",
    api: "api/admin/admins",
    primaryKey: "id",
    columns: {
        id: {
            // required: true,
            label: "編號",
            type: "input",
            inputType: "text",
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
            placeholder: "MetaTitle",
            minlength: 6
        },
        created_at: {
            label: "建立時間",
            type: "input",
            inputType: "url",
            disabled: true
        },
        tools: {
            ignore: ["form", "table"],
            type: "tools",
            class: "test-tools",
            tools: [
                {
                    "data-ignore": ["table", "form"],
                    "data-type": "submit",
                    text: "送出",
                    class: "btn btn-danger"
                },
                {
                    "data-ignore": ["table", "form"],
                    "data-type": "back",
                    text: "返回",
                    class: "btn btn-primary"
                }
            ]
        }
    },
    options: {
        formOptions: {
            validateAfterLoad: false,
            validateAfterChanged: false
        }
    }
};
// getters
const getters = {};

// actions
const actions = {};

// mutations
const mutations = {};

export default {
    state,
    getters,
    actions,
    mutations
};
