<template lang="html">
    <div class="row">
        <div class="col-lg-12">
            <List v-if="route === 'list'" :configs="configs" @changeComponent='changeComponent'></List>
            <createForm v-if="route === 'create'" @changeComponent='changeComponent'></createForm>
        </div>
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
    ],
    columns: {
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

import List from './list';
import createForm from './create';
export default {
    components: {
        List,
        createForm
    },
    data() {
        return {
            route: 'create',
            configs: configs
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
