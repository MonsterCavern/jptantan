<template lang="html">
    <div>
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%"></table>
    </div>
</template>

<script>
// import 'datatables.net-dt/css/jquery.dataTables.css';
// import 'datatables.net-responsive-dt/css/responsive.dataTables.css';
//
// import 'datatables.net';
// import 'datatables.net-responsive';
require('datatables.net')
require('datatables.net-bs4')
require('datatables.net-responsive')
require('datatables.net-responsive-bs4')
require('datatables.net-buttons')
require('datatables.net-buttons-bs4')

export default {
    props: {
        value: Object,
        config: Object
    },
    data() {
        let config = this.value

        return {
            headers: this.initColumns(config.columns),
            rows: [],
            dtHandle: null
        }
    },
    mounted() {
        //  再使用之前改變 dataTable 原始碼的預設
        window.$.fn.dataTable.ext.errMode = function(s, h, m) {
            console.log(m)
        }

        this.$table = $(this.$el).children('table')
        this.dtHandle = this.initTable()
    },
    watch: {
        value: {
            handler(newSong, oldSong) {
                this.dtHandle.destroy()
                this.$table.empty()
                this.dtHandle = this.initTable()
            },
            deep: true
        }
    },
    methods: {
        initTable: function() {
            let apiPath = '/'

            if (typeof this.config == 'undefined') {
                apiPath += this.value.api
            } else {
                apiPath += this.config.api
            }

            var columns = this.value.columns
            var headers = this.headers
            let table = this.$table.DataTable({
                lengthChange: false,
                searching: false,
                processing: false,
                serverSide: true,
                ajax: {
                    url: apiPath,
                    data: function(d) {
                        for (let i = d.columns.length - 1; i >= 0; i--) {
                            let column = d.columns[i].data
                            if (
                                columns[column].hasOwnProperty('virtual') &&
                                columns[column].virtual
                            ) {
                                d.columns.splice(i, 1)
                            }
                        }
                    },
                    beforeSend: function(xhr) {
                        if (localStorage.getObject('user')) {
                            xhr.setRequestHeader(
                                'Authorization',
                                'Bearer ' +
                                    localStorage.getObject('user')['token']
                            )
                        }

                        xhr.setRequestHeader(
                            'Content-Type',
                            'application/json; charset=utf-8'
                        )
                    }
                },
                columns: headers,
                data: this.rows,
                dom: 'lfr<"pull-left"i>t<"pull-right"p>',
                responsive: true,
                pagingType: 'numbers' //"numbers","full_numbers",//"simple_incremental_bootstrap",
            })

            return table
        },
        initColumns: function(columns) {
            let res = []

            for (var column in columns) {
                if (Array.isArray(columns[column])) {
                    continue
                }

                if (
                    columns[column].hasOwnProperty('ignore') &&
                    columns[column].ignore.indexOf('table') !== -1
                ) {
                    continue
                }

                let head = {}

                head.data = column
                head.title = columns[column].label
                if (columns[column].hasOwnProperty('render')) {
                    head.render = columns[column].render
                }

                res.push(head)
            }
            return res
        }
    }
}
</script>

<style lang="css">

</style>
