<template lang="html">
    <div class="animated fadeIn">
        <h2>Translate</h2>
        <div class="row">
            <div class="col-lg-12">
                <showList v-if="route === 'list'" 
                  :configs="configs.showList" 
                  @changeComponent='changeComponent'
                />
                <createForm v-if="route === 'create'" 
                  :configs="configs.createForm" 
                  @changeComponent='changeComponent'
                />
            </div>
        </div>
    </div>
</template>

<script>
import showList from './list';
import createForm from './create';

const configs = {
    api: 'api/all',
    categories: [{
            title: '全部',
            value: 'all'
        },
        {
            title: '小說',
            value: 'novel'
        },
    ]
};
export default {
    components: {
        showList,
        createForm
    },
    data() {
        return {
            route: 'create',
            configs: {
              showList: {},
              createForm: {
                vformConfig: {
                  // api:'/'
                }
              }
            }
        };
    },
    methods: {
        changeComponent: function(val) {
            this.route = val;
        }
    }
};
</script>

<style lang="css">
</style>
