<template lang="html">
  <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            PreView
            {{ url }}
          </div>
        </div>
      </div>
  </div>
</template>

<script>
export default {
    props:['formData'],
    data(){
        let url = '';

        return {
            url: url
        };
    },
    watch:{
        formData: {
            handler(newSong, oldSong) {
                if (this.formData.hasOwnProperty('url')) {
                    this.url = this.formData.url;
                    this.getContent(this.formData.url);
                }
            },
            deep: true
        }
    },
    methods:{
        getContent: function (url) {
            var options = {
                url: url,
                type: 'get',
                async: false,
                dataType: "jsonp",
                // jsonp: "callback",//傳遞給請求處理程序或頁面的，用以獲得jsonp回調函數名的參數名(一般默認為:callback)
                success: function(json){
                    console.log(json);
                },
                error: function(e,a){
                    console.log(e,a);
                }
            };
            var result = $.ajax(options);

            // console.log(result);
        }
    }
};
</script>

<style lang="css">
</style>
