<template lang="html">
    <v-app id="inspire" dark>

        <!--  -->
        <v-toolbar app>
            <router-link to="/" class="d-flex ml-3">
              <img src="/images/logo.png" alt="logo" height="38px" width="38px">
            </router-link>
            <v-toolbar-title>Jptantan</v-toolbar-title>
            <v-toolbar-items v-if="user === null">
                <v-btn flat to="/auth/login">Login</v-btn>
            </v-toolbar-items>
            <v-toolbar-items v-else>
                <v-btn flat to="/auth/user">User</v-btn>
                <v-btn flat @click="Logout">Logout</v-btn>
            </v-toolbar-items>
            <v-spacer></v-spacer>
            <v-toolbar-items class="hidden-sm-and-down">
                <v-btn flat v-for="item in items" :key="item.title" :to="item.href">{{ item.title }}</v-btn>
            </v-toolbar-items>
            <v-toolbar-side-icon class="hidden-md-and-up" @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        </v-toolbar>

        <!--  -->
        <v-navigation-drawer v-model="drawer" width="150" right temporary dark app>
            <v-list class="pt-0" dense>
                <v-divider light></v-divider>
                <v-list-tile v-for="item in items" :key="item.title" :to="item.href">
                    <v-list-tile-action>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>

        <v-content app>
            <router-view />
        </v-content>


    </v-app>
</template>

<script>
export default {
    created() {
        this.user = this.$store.state.user
        if (this.user !== null) {
            router.push('auth/usesr')
        }
    },
    data() {
        return {
            user: null,
            right: null,
            drawer: null,
            items: [{ title: 'Bokete', icon: 'dashboard', href: '/bokete' }, { title: 'Syosetu', icon: 'question_answer', href: '/syosetu' }]
        }
    },
    watch: {
        '$store.state.user': {
            deep: true,
            handler(newValue, oldValue) {
                this.user = newValue
            }
        }
    },
    methods: {
        Logout() {
            this.$store.commit('logout')
            this.$router.push({ path: '/' })
        }
    }
}
</script>

<style lang="css">
</style>
