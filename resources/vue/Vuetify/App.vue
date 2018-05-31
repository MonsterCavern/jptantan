<template lang="html">
    <v-app id="inspire" dark>

        <!--  -->
        <v-toolbar app>
            <a href="/" class="d-flex ml-3">
              <img src="/images/logo.png" alt="logo" height="38px" width="38px">
            </a>
            <v-toolbar-title>Jptantan</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items class="hidden-sm-and-down">
                <v-btn flat v-for="item in items" :key="item.title" :href="item.href">{{ item.title }}</v-btn>
            </v-toolbar-items>
            <v-toolbar-side-icon class="hidden-md-and-up" @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        </v-toolbar>

        <!--  -->
        <v-navigation-drawer v-model="drawer" right temporary dark absolute app>
            <v-list class="pt-0" dense>
                <v-divider light></v-divider>
                <v-list-tile v-for="item in items" :key="item.title" :href="item.href">
                    <v-list-tile-action>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>

        <v-content>
            <router-view></router-view>
        </v-content>


    </v-app>
</template>

<script>
export default {
    mounted() {},
    data() {
        return {
            right: null,
            drawer: null,
            items: [
                { title: 'Bokete', icon: 'dashboard', href: '/bokete' },
                { title: 'Syosetu', icon: 'question_answer', href: '/syosetu' },
                { title: 'Login', icon: 'question_answer', href: '/login' }
            ]
        }
    },
    methods: {}
}
</script>

<style lang="css">
</style>
