<template lang="html">
    <v-layout row>
        <v-flex xs12>
            <v-container fluid>
                <v-btn flat v-for="category in categories" :key="category.value" v-on:click="changeTable(category.value)">
                    {{category.title}}
                </v-btn>
            </v-container>

            <v-card>
                <v-divider></v-divider>
                <v-subheader>列表</v-subheader>
                <data-table v-model="config"></data-table>
            </v-card>
        </v-flex>
    </v-layout>
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
            console.log(value);
            this.config.api = 'api/'+value;
        }
    },
    mounted() {
        console.log('This translate.');
    }
}
</script>

<style lang="css">
</style>
