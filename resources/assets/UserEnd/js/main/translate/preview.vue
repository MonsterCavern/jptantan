<template lang="html">
  <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-title">
            <h4>預覽</h4>
          </div>
          <div class="card-body">
            <!-- <div v-html="preview"></div> -->
            <iframe :src="url" width="100%" height="100%" frameborder="0" ></iframe>
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
        let preview = '';

        return {
            url: url,
            preview: preview
        };
    },
    watch:{
        formData: {
            handler(newSong, oldSong) {
                if (this.formData.hasOwnProperty('url')) {
                    this.url = this.formData.url;
                    //this.getContent(this.formData.url);
                }
            },
            deep: true
        }
    },
    methods:{
        getContent: function (url) {
            var options = {
                url: '/api/curl',
                type: 'get',
                async: false,
                dataType: "html",
                data: {url:url}
            };
            let result = $.ajax(options);

            var body = result.responseText.replace(/^.*?<body[^>]*>(.*?)<\/body>.*?$/i,"$1");

            this.preview = body;

        }
    }
};
</script>

<style lang="css">
</style>
