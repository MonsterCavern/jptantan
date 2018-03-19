<template lang="html">
  <div>
    This is View
  </div>
</template>

<script>
import fab from 'vue-fab';
export default {
    components: {
        fab
    },
    props: ['id'],
    data(){
        console.log(this);
        return {
            createFABs:[
                {
                    name: 'goPage',
                    icon: 'undo',
                    tooltip: '返回'
                }
            ]
        };
    },
    methods: {
        goPage: function(val) {
            // 回傳 給父組件
            this.$emit('changeComponent', val);
        }
    }
};
</script>

<style lang="css">
</style>
