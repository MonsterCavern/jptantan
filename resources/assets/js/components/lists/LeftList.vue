<template>
  <v-list dense>
    <v-list-tile>
      <v-list-tile-action>
        <v-icon>home</v-icon>
      </v-list-tile-action>
      <v-list-tile-content @click="goRouter">
        <v-list-tile-title>
          Home
        </v-list-tile-title>
      </v-list-tile-content>
    </v-list-tile>
    <v-list-tile>
      <v-list-tile-action>
        <v-icon>contact_mail</v-icon>
      </v-list-tile-action>
      <v-list-tile-content @click="goRouter">
        <v-list-tile-title>
          Translate
        </v-list-tile-title>
      </v-list-tile-content>
    </v-list-tile>
  </v-list>
</template>

<script>
  export default {
    data: () => ({
    }),
    methods: {
      'goRouter' : function(event){
        var urlName = $(event.target).text().trim().toLowerCase();
        if (urlName == 'home') {
          urlName = '/';
        }
        this.$router.push(urlName);
      }
    },
    props: {
    }
  }
</script>
