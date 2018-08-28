<style lang="scss" >
</style>

<template>

  <form class="form-signin">
    <div class="row">
      <div class="col-auto">
        <div class="form-group">
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        </div>
        <div class="form-group">
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        </div>
      </div>
      <div class="col-auto">
        <button class="btn btn-lg btn-primary btn-block">Login</button>
      </div>
    </div>
  </form>

</template>

<script>
export default {
    name: "Login",
    data() {
        return {}
    },
    computed: {
        text() {
            return {}
        }
    }
}
</script>
