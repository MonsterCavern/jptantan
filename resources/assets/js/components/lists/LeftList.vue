<template>
    <div>
      <v-navigation-drawer temporary v-model="drawer" :mini-variant="mini" dark absolute>
          <v-list class="pt-0" dense>
              <v-divider light></v-divider>
              <v-list-tile v-for="item in links" :key="item.route">
                  <v-list-tile-action>
                      <v-icon>{{ item.icon }}</v-icon>
                  </v-list-tile-action>
                  <v-list-tile-content @click="$goRoute(item.route)">
                      <v-list-tile-title>
                          {{ item.text }}
                      </v-list-tile-title>
                  </v-list-tile-content>
              </v-list-tile>
          </v-list>
      </v-navigation-drawer>
      <v-toolbar color="indigo" dark fixed app>
        <v-toolbar-side-icon  @click.stop="mini = !mini"></v-toolbar-side-icon>
        <v-toolbar-title>Application</v-toolbar-title>
      </v-toolbar>

    </div>
</template>

<script>
export default {
    data() {
        return {
            drawer: null,
            mini: false,
            links: [{
                    icon: "home",
                    text: "Home",
                    route: "/home"
                },
                {
                    icon: "contact_mail",
                    text: "Translate",
                    route: "/translate"
                }
            ]
        };
    },
    methods: {}
}
</script>
