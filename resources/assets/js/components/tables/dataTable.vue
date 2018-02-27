<template>
    <table class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%"></table>
</template>

<script>
    import 'bootstrap/dist/css/bootstrap.min.css';
    import 'datatables.net-bs4/css/dataTables.bootstrap4.css';
    import 'datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'
    import 'datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'

    import 'bootstrap'
    import 'datatables.net-bs4'
    import 'datatables.net-buttons-bs4'
    import 'datatables.net-responsive-bs4'

    export default {
        props: {
            config: {
                type: Object,
                default: function() {
                    return {
                        api: 'api/translate',
                        columns: {
                            id: {
                                title: '編號',
                                className: "col-lg-1",
                                defaultValue: '1',
                                attr: {
                                    type: 'number',
                                },
                                draw_formatter: "drawString",
                            },
                            url: {
                                title: '網址',
                                defaultValue: 'Cosmos',
                                attr: {
                                    required: 'required',
                                    type: 'text',
                                },
                                className: "is_text",
                                draw_formatter: "drawString",
                            }
                        }
                    }
                }
            }
        },
        data() {

            return {
                headers: [
                  { data: 'id', title: '編號' },
                  { data: 'url', title: '網址' },
                  { data: 'updated_at', title: '更新時間' },
                  { data: 'created_at', title: '建立時間' }
                ],
                rows: [],
                dtHandle: null
            }
        },
        mounted() {
            console.log('82');
            //  再使用之前改變 dataTable 原始碼的預設
            window.$.fn.dataTable.ext.errMode = function(s, h, m) {
                console.log(m);
            };

            let vm = this;
            // TODO 檢查設定檔存不存在
            //

            vm.dtHandle = $(this.$el).DataTable({
                processing: true,
                      serverSide: true,
                      ajax: vm.config.api,
                columns: vm.headers,
                data: vm.rows,
                //dom: 'Bfrtip',
                pagingType: "numbers", //"full_numbers",//"simple_incremental_bootstrap",
            });
        },
        methods: {
            initColumns: function (columns) {
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
                }

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
    }
</script>
