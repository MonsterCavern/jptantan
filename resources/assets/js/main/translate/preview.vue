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
                cache: false,
                contentType: false,
                processData: false
            };
            var result = $.ajax(options);

            console.log(result);
        }
    }
};
</script>

<style lang="css">
</style>
