<template>
  <vue-fab
    :mainBtnColor="mainBtnColor"
    @clickMainBtn="clickMainBtn">
    <fab-item 
      v-for="(item, idx) in menu"
      :idx="idx"
      :key="idx"
      :title="item.title"
      :color="item.color"
      :icon="item.icon"
      @clickItem="clickItem" >
    </fab-item>
    </vue-fab>
</template>

<script>
import Vue from 'vue';
import Fab from 'vue-float-action-button';
Vue.use(Fab);
export default {
    name: 'fab',
    data () {
        return {
            menu: [
                {
                    icon: 'done',
                    title: 'good job!',
                    color: '#ff9900'
                },
                {
                    icon: 'toc',
                    title: '',
                    color: '#999'
                }
            ],
            mainBtnColor: '#FF0099'
        };
    },
    methods: {
        clickItem: function (idx) {
            console.log('idx: ' + idx);
        },
        clickMainBtn: function () {
            console.log('clickMainBtn');
        }
    }
};
</script>
