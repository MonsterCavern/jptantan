<template lang="html">
    <div class="container-fluid">
        <h2>Translate</h2>
        <router-view></router-view>
    </div>
</template>
<script>
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
    data() {
        return {
            route: 'list',
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
