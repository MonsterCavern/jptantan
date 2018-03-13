<template lang="html">
    <!-- 列表 DataTable -->
    <div class="card">
        <div class="card-header">
            <!-- 浮動按鈕 -->
            <fab
              :actions="createFABs"
              @goCreateForm = "goCreateForm('create')"
            >
            </fab>
            <!-- 標籤過濾 -->
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item" v-for="category in categories" :key="category.value" @click="changeTable(category.value)">
                    <a class="nav-link">{{category.title}}</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <dataTable v-model="configs"></dataTable>
        </div>
    </div>
</template>

<script>
import dataTable from '../../components/tables/dataTable';
import fab from 'vue-fab';
export default {
    props: ['configs','route'],
    data() {
        let configs = this.configs;

        return {
            categories: configs.categories,
            createFABs: [
                {
                    name: 'goCreateForm',
                    icon: 'translate',
                    tooltip: '新增'
                }
            ]
        };
    },
    components: {
        dataTable,
        fab
    },
    methods: {
        goCreateForm: function (val) {
            this.$emit('changeComponent', val);
        },
        changeTable: function(value) {
            console.log(value);
            this.config.api = 'api/' + value;
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
