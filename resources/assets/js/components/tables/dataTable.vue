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
require('datatables.net');
require('datatables.net-bs4');
require('datatables.net-responsive');
require('datatables.net-responsive-bs4');
require('datatables.net-buttons');
require('datatables.net-buttons-bs4');

export default {
    props: {
        value: Object,
        config: Object
        // value: {
        //     type: Object,
        //     default: function() {
        //         return {
        //             api: 'api/translate',
        //             columns: {
        //                 id: {
        //                     title: '編號',
        //                     className: "col-lg-1",
        //                     defaultValue: '1',
        //                     attr: {
        //                         type: 'number',
        //                     },
        //                     draw_formatter: "drawString",
        //                 },
        //                 url: {
        //                     title: '網址',
        //                     defaultValue: 'Cosmos',
        //                     attr: {
        //                         required: 'required',
        //                         type: 'text',
        //                     },
        //                     className: "is_text",
        //                     draw_formatter: "drawString",
        //                 }
        //             }
        //         };
        //     }
        // }
    },
    data() {
        return {
            headers: [
                { data: 'id', title: '編號', width: '20%' },
                { data: 'url', title: '網址', width: '10%' },
                { data: 'updated_at', title: '更新時間' },
                { data: 'created_at', title: '建立時間' }
            ],
            rows: [],
            dtHandle: null
        };
    },
    mounted() {
        //  再使用之前改變 dataTable 原始碼的預設
        window.$.fn.dataTable.ext.errMode = function(s, h, m) {
            console.log(m);
        };

        this.$table = $(this.$el).children('table');
        this.dtHandle = this.initTable();

    },
    watch: {
        value: {
            handler(newSong, oldSong) {
                this.dtHandle.destroy();
                this.$table.empty();
                this.dtHandle = this.initTable();
            },
            deep: true
        }
    },
    methods: {
        initTable: function() {
            let apiPath = '/';

            if (typeof this.config == 'undefined') {
                apiPath += this.value.api;
            } else {
                apiPath += this.config.api;
            }

            let table = this.$table.DataTable({
                lengthChange: false,
                searching: false,
                processing: false,
                serverSide: true,
                ajax: apiPath,
                columns: this.headers,
                data: this.rows,
                dom: 'lfr<"pull-left"i>t<"pull-right"p>',
                responsive: true,
                pagingType: "numbers" //"numbers","full_numbers",//"simple_incremental_bootstrap",
            });

            return table;
        },
        initColumns: function(columns) {
            return columns;
        },
        ajaxApi: function(url = 'index', type = 'GET', data = {}) {
            var options = {
                dataType: 'json',
                url: restAPI(url),
                type: type,
                async: false,
                cache: false,
                contentType: false,
                processData: false
            };

            options.beforeSend = function setHeader(xhr) {
                let sess = 'ufi_admin';

                if (typeof localStorage.getObject(user) !== 'undefined') {
                    let user = localStorage.getObject(user);

                    if (typeof user.sess !== 'undefined') {
                        sess = user.sess;
                    }
                }
                xhr.setRequestHeader('X-SESSION', sess);
                xhr.setRequestHeader('contentType', 'application/json; charset=utf-8');
            };

            if (Object.keys(data).length !== 0) {
                options['data'] = JSON.stringify(data);
            }

            var result = $.ajax(options);

            if (result.responseJSON) {
                return result.responseJSON;
            }
            return false;
        }
    }
};
</script>

<style lang="css">

</style>
