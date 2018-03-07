<template lang="html">
    <div class="card text-center">
        <div class="card-header">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button flat v-for="category in categories" :key="category.value" v-on:click="changeTable(category.value)">
                    {{category.title}}
                </button>
            </div>
        </div>
        <div class="card-body">
            <data-table v-model="config"></data-table>
        </div>
    </div>
</template>

<script>
import dataTable from '../components/tables/dataTable';
export default {
    data() {
        // console.log(this);
        return {
            config: {
                api: 'api/translate'
            },
            categories: [{
                    title: '翻譯',
                    value: 'translate'
                },
                {
                    title: '小說',
                    value: 'novels'
                },
                {
                    title: '圖片',
                    value: 'picture'
                }
            ]
        }
    },
    components: {
        'data-table': dataTable
    },
    methods: {
        changeTable: function(value) {
            this.config.api = 'api/' + value;
        }
    }
}
</script>

<style lang="css">
</style>
