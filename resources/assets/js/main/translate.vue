<template lang="html">
  <div class="row">
    <router-view :config ='config' :categories='categories'></router-view>
  </div>
</template>

<script>

export default {
    data() {
        return {
            config: {
                api: 'api/all'
            },
            categories: [
                {
                    title: '全部',
                    value: 'all'
                },
                {
                    title: '小說',
                    value: 'novel'
                },
            ]
        };
    }
};
</script>

<style lang="css">
</style>
