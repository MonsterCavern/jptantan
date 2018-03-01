<template>
    <v-app id="inspire">
      <v-layout wrap style="height: 200px;">

          <v-navigation-drawer temporary v-model="drawer" :mini-variant="mini" dark absolute>
              <v-list class="pa-1">
                  <v-list-tile v-if="mini" @click.stop="mini = !mini">
                      <v-list-tile-action>
                          <v-icon>chevron_right</v-icon>
                      </v-list-tile-action>
                  </v-list-tile>
                  <v-list-tile avatar tag="div">
                      <v-list-tile-avatar>
                          <img src="https://randomuser.me/api/portraits/men/85.jpg">
                      </v-list-tile-avatar>
                      <v-list-tile-content>
                          <v-list-tile-title>John Leider</v-list-tile-title>
                      </v-list-tile-content>
                      <v-list-tile-action>
                          <v-btn icon @click.stop="mini = !mini">
                              <v-icon>chevron_left</v-icon>
                          </v-btn>
                      </v-list-tile-action>
                  </v-list-tile>
              </v-list>
              <v-list class="pt-0" dense>
                  <v-divider light></v-divider>
                  <v-list-tile v-for="item in items" :key="item.title" @click="">
                      <v-list-tile-action>
                          <v-icon>{{ item.icon }}</v-icon>
                      </v-list-tile-action>
                      <v-list-tile-content>
                          <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                      </v-list-tile-content>
                  </v-list-tile>
              </v-list>
          </v-navigation-drawer>
      </v-layout>
      <v-container>
          <v-layout justify-center>
              <v-btn @click.stop="drawer = !drawer" color="pink" dark>Toggle</v-btn>
          </v-layout>
          <router-view></router-view>
      </v-container>
        <v-content>
            <v-container>

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
        'leftlist': LeftList
    },
    computed: {
        copyright: function() {
            return new Date().getFullYear();
        }
    },
    props: {
        source: String
    }
}
</script>
