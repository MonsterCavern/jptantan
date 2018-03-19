<template lang="html">
  <div class="animated fadeIn">
    <!-- 列表 DataTable -->
    <div class="row">
      <!-- 浮動按鈕 -->
      <fab :actions="createFABs" @goPage="$goRoute('/translate/create')">
      </fab>
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <!-- 標籤過濾 -->
              <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item" v-for="category in categories" :key="category.value" @click="changeTable(category.value)">
                  <a class="nav-link">{{category.title}}</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <dataTable v-model="dataTableConfig"></dataTable>
            </div>
          </div>
        </div>
    </div>  
  </div>
</template>

<script>
import dataTable from '../../components/DataTable';
import fab from 'vue-fab';

const vTableDefaultConf = {
    api: 'api/all',
    // type: 'new',
    primaryKey: 'id',
    // formGroups: [{
    //     legend: "Url Details",
    //     fields: ['id', 'title']
    // }],
    columns: {
        id: {
            // required: true,
            label: '編號',
            type: "input",
            // inputType: "url",
            inputName: "id", // name
            styleClasses: "", // .form-group
            placeholder: '流水號',
            disabled: true,
            render: function(data, type, full, meta) {
                // console.log(data, type, full, meta);
                data = $('<a/>', { text: data, href: "translate/" + data, target: '_blank' }).prop('outerHTML');
                return data;
            }
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
        },
    }
};

const categories = [{
    title: '全部',
    value: 'all'
},
{
    title: '小說',
    value: 'novel'
},
];

export default {
    props: {
        configs: {
            type: Object,
            default: Object
        }
    },
    data() {
        // let configs = this.configs;
        let dataTableConfig = vTableDefaultConf;

        return {
            categories: categories,
            dataTableConfig: dataTableConfig,
            createFABs: [{
                name: 'goPage',
                icon: 'translate',
                tooltip: '新增'
            }]
        };
    },
    components: {
        dataTable,
        fab
    },
    methods: {
        changeTable: function(value) {
            this.dataTableConfig.api = 'api/' + value;
        },
        checkinit: function(urlPath) {
            if (urlPath.split('/').length > 2) {
                return false;
            }
            return true;
        },
        log: function(value) {
            console.log(value);
        }
    }
};
</script>

<style lang="css">
</style>
