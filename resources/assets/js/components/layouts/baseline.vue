<template>
  <v-app id="inspire">
    <v-navigation-drawer
      fixed
      v-model="drawer"
      app
    >
    <leftlist></leftlist>
    </v-navigation-drawer>
    <v-toolbar color="indigo" dark fixed app>
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title>Application</v-toolbar-title>
    </v-toolbar>
    <v-content>
      <v-container>
        <router-view></router-view>
        <router-view name="ex"></router-view>
      </v-container>
    </v-content>
    <v-footer color="indigo" app>
      <span class="white--text">&copy; {{copyright}}</span>
    </v-footer>
  </v-app>
</template>

<script>


import LeftList from '../lists/LeftList'

  export default {
    data: () => ({
      drawer: null
    }),
    components: {
      'leftlist':LeftList
    },
    computed:{
      copyright: function () {
        return new Date().getFullYear();
      }
    },
    props: {
      source: String
    }
  }
</script>
