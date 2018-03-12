<template lang="html">
  <div class="row">
    <!-- 新增按鈕 -->
    <fab :actions="configs.createFABs.list"
      @clickEvent ="FABClickEvent"
    >
    </fab>
    <router-view 
      :configs ='configs'
    >
    </router-view>
  </div>
</template>

<script>

const configs = {
    api: 'api/all',
    categories: [
        {
            title: '全部',
            value: 'all'
        },
        {
            title: '小說',
            value: 'novel'
        },
    ],
    createFABs: {
        list: [
            {
                name: 'translate',
                route: 'translate/create',
                icon: 'translate',
                tooltip: '新增'
            }
        ],
        create: {
            name: 'submit',
            icon: 'submit',
            tooltip: '送出'
        }
    },
    columns:{
        id: {
            title: '編號',
            className: "col-lg-1",
            defaultValue: '1',
            attr: {
                type: 'number',
            }
        },
        url: {
            title: '網址',
            defaultValue: 'Cosmos',
            attr: {
                required: 'required',
                type: 'text',
            },
            className: "is_text"
        }
    }
};

import fab from '../components/fabs/fab';
export default {
    components: {
        fab
    },
    data() {
        console.log(this);
        return {
            configs: configs
        };
    },
    methods:{
        log: function (val) {
            console.log(val);
        },
        submit: function (val) {
            console.log('this submit',val);
        },
        FABClickEvent: function (index,config) {
            console.log(index,config);
            if (typeof config.name !== 'undefined') {
                if (typeof this[config.name] !== 'undefined') {
                    this[config.name](config);
                }
            }
            
            if (typeof config.route !== 'undefined') {
                this.$router.push(config.route);
            }
        }
    }
};
</script>

<style lang="css">
#bottom-right-wrapper {
    right: 10px !important;
}
</style>
