<template lang="html">
    <form class="col-lg-12">
        <div class="form-group">
            <label for="UrlInput">網址</label>
            <input type="text" class="form-control" id="UrlInput" placeholder="https://...">
        </div>
        <div class="form-group">
            <label for="TitleInput">標題</label>
            <input type="text" class="form-control" id="TitleInput" placeholder="MetaTitle">
        </div>
    </form>
</template>

<script>
export default {
    props: ['config', 'categories']
};
</script>

<style lang="css">
</style>
