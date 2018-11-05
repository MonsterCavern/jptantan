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
                <router-link :to="{name:'index'}" class="py-2 d-none d-md-inline-block">Home</router-link>
                <router-link :to="{name:'bokete'}" class="py-2 d-none d-md-inline-block">Bokete</router-link>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

    </header>

</template>

<script>
import Login from '@components/LoginForm'
import NavBarItemsCard from '@pages/Header/NavBarItemsCard'
import NavBarItemsList from '@pages/Header/NavBarItemsList'

export default {
    name: 'Header',
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
