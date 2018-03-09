<template lang="html">
    <div>
        <!-- 列表 DataTable -->
        <div class="card text-center">
            <div class="card-header">

                <!-- 標籤過濾 -->
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item" v-for="category in categories" :key="category.value" @click="changeTable(category.value)">
                        <a class="nav-link">{{category.title}}</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <!-- 新增按鈕 -->
                <FAButton></FAButton>
                <!-- <button type="button" class="btn btn-danger bmd-btn-fab">
                    <i class="material-icons">grade</i>
                </button> -->
            </div>
            <dataTable v-model="config"></dataTable>
        </div>
    </div>
</template>

<script>

import dataTable from './tables/dataTable';
import FAButton from './floating-action-buttons';
export default {
    props: ['config', 'categories'],
    data() {
        return {
            mainBtnColor: '#FF0099'
        };
    },
    components: {
        dataTable,
        FAButton
    },
    methods: {
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
