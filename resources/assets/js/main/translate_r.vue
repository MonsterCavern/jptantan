<template lang="html">
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item" v-for="category in categories" :key="category.value" @click="$goRoute(category.value)">
                    <a class="nav-link">{{category.title}}</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <dataTable :config='config' v-if="checkinit($route.fullPath)"></dataTable>
            <router-view v-else></router-view>
        </div>
    </div>
</template>

<script>
import dataTable from '../components/tables/dataTable';
export default {
    data() {
        return {
            config: {
                api: 'api/translate'
            },
            categories: [{
                    title: '翻譯',
                    value: '/translate_r/translate',
                },
                {
                    title: '小說',
                    value: '/translate_r/novels'
                },
                {
                    title: '圖片',
                    value: '/translate_r/picture'
                }
            ]
        }
    },
    components: {
      dataTable
    },
    methods: {
        changeTable: function(value) {
            console.log(value);
            this.config.api = 'api/' + value;
        },
        checkinit: function (urlPath) {
          if (urlPath.split('/').length > 2) {
            return false;
          }
          return true;
        },
        log: function (value) {
          console.log(value);
        }
    }
}
</script>

<style lang="css">
</style>
