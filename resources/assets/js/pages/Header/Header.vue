<style lang="scss" >
/*
 * Custom translucent site header
 */

.site-header {
    background-color: rgba(0, 0, 0, 0.85);
    -webkit-backdrop-filter: saturate(180%) blur(20px);
    backdrop-filter: saturate(180%) blur(20px);
}

.site-header a {
    color: #999;
    transition: ease-in-out color 0.15s;
}

.site-header a:hover {
    color: #fff;
    text-decoration: none;
}
</style>

<template>

  <header class="site-header sticky-top py-1">
      <div class="collapse bg-dark" id="navbarHeader">
          <div class="container">
              <div class="row">
                
                  <div class="col-sm-8 col-md-7 py-2">
                    <NavBarItemsCard class="d-none d-md-block"></NavBarItemsCard>
                    <NavBarItemsList class="d-block d-md-none"></NavBarItemsList>
                  </div>

                  <div class="col-sm-4 offset-md-1 py-2">
                      <Login></Login>
                  </div>
              </div>
          </div>
      </div>

      <nav class="navbar navbar-dark">
          <div class="container d-flex flex-md-row justify-content-between">
              <a class="py-2" href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="d-block mx-auto">
                      <circle cx="12" cy="12" r="10" />
                      <line x1="14.31" y1="8" x2="20.05" y2="17.94" />
                      <line x1="9.69" y1="8" x2="21.17" y2="8" />
                      <line x1="7.38" y1="12" x2="13.12" y2="2.06" />
                      <line x1="9.69" y1="16" x2="3.95" y2="6.06" />
                      <line x1="14.31" y1="16" x2="2.83" y2="16" />
                      <line x1="16.62" y1="12" x2="10.88" y2="21.94" />
                  </svg>
              </a>
              <!-- <a class="py-2 d-none d-md-inline-block" href="#">Tour</a> -->

              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
          </div>
      </nav>

  </header>

</template>

<script>
import Login from "@components/LoginForm"
import NavBarItemsCard from "@pages/Header/NavBarItemsCard"
import NavBarItemsList from "@pages/Header/NavBarItemsList"
export default {
    name: "Header",
    components: {
        Login,
        NavBarItemsCard,
        NavBarItemsList
    },
    data() {
        return {
            items: []
        }
    },
    computed: {
        text() {
            return {}
        }
    }
}
</script>
