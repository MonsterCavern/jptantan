<template lang="html">
  <div class="wrapper"
       v-model="value"
       :disabled="schema.disabled"
       >
       <!-- <div v-html="html" v-for="(html,key) in this.htmls" :key="key">
         
       </div> -->
  </div>
</template>

<script>
import { abstractField } from "vue-form-generator";
export default {
    mixins: [abstractField],
    data() {
        return {
            htmls: []
        };
    },
    mounted() {
        let config = this.formOptions.config;
        let tools = this.schema.tools;

        for (var i = 0; i < tools.length; i++) {
            let tool = tools[i];
            let html = $("<div/>", tool);

            if (html.data("type") === "submit") {
                html[0].onclick = this.submit;
            }

            if (html.data("type") === "back") {
                html[0].onclick = this.back;
            }

            $(this.$el).append(html);
        }
    },
    methods: {
        submit: function(event) {
            let target = event.target;
            let form = $(target).parents("form");
            let data = form.serializeJSON();
            let api = form.attr("action");
            let result = ajaxCase(api, "PUT", data);
        },
        back: function() {
            this.$router.go(-1);
        }
    }
};
</script>

<style lang="css">
</style>
