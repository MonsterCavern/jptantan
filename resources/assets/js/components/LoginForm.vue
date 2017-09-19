<template>
<form class="ui form segment">
  <div class="field">
    <input type="text" name="login-email" placeholder="Email" value="cosmos">
  </div>
  <div class="field">
    <input type="password" name="login-password" placeholder="Password" value="1234">
  </div>
  <div class="ui button login" v-on:click="login">Login</div>
</form>
</template>

<script>
export default {
  data: function() {
    return {
      url: 'home',
      type: 'get',
      params: {}
    }
  },
  methods: {
    login: function(event) {
      var formData = $(this.$el).serializeObject()
      var json = tools.dotoCase(this.url, this.type, formData);
      console.log(json);
    }
  },
  mounted() {
    console.log('import LoginForm')
  }
}
</script>
