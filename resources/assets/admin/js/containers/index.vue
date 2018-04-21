<template lang="html">
    <div class="container-fluid">
        <h1>歡迎光臨</h1>
        <p>測試</p>
    </div>
</template>

<script>
export default {
    mounted() {
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    }
};
</script>

<style lang="css">
</style>
