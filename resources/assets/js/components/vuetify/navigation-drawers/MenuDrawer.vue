<template lang="html">
  <div>
    <v-navigation-drawer fixed :clipped="$vuetify.breakpoint.mdAndUp" app v-model="drawer">
        <v-list dense>
            <template v-for="item in items">
                <v-layout row v-if="item.heading" align-center :key="item.heading">
                    <v-flex xs6>
                        <v-subheader v-if="item.heading">
                            {{ item.heading }}
                        </v-subheader>
                    </v-flex>
                    <v-flex xs6 class="text-xs-center">
                        <a href="#!" class="body-2 black--text">EDIT</a>
                    </v-flex>
                </v-layout>
                <v-list-group v-else-if="item.children" v-model="item.model" :key="item.text" :prepend-icon="item.model ? item.icon : item['icon-alt']" append-icon="">
                    <v-list-tile slot="activator" @click="$goRoute(item.route)">
                        <v-list-tile-content>
                            <v-list-tile-title>
                                {{ item.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile v-for="(child, i) in item.children" :key="i" @click="">
                        <v-list-tile-action v-if="child.icon">
                            <v-icon>{{ child.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                {{ child.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>
                <v-list-tile v-else @click="" :key="item.text" @click="$goRoute(item.route)">
                    <v-list-tile-action>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            {{ item.text }}
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </template>
        </v-list>
    </v-navigation-drawer>
  </div>
</template>
<script>
export default {
  props: {
  	value: Boolean
  },
  watch: {
  	value: function () {
      this.drawer = !this.drawer;
    	//this.$emit('input', false);
      //console.log(this.drawer);
    }
  },
  data(){
    return {
        drawer: this.value,
        items: [
            { icon: 'home', text: 'Home', route: '/home' },
            { icon: 'history', text: 'Translate', route: '/translate' },
            { icon: 'content_copy', text: 'Duplicates' },
            {
                icon: 'keyboard_arrow_up',
                'icon-alt': 'keyboard_arrow_down',
                text: 'Labels',
                model: true,
                children: [
                    { icon: 'add', text: 'Create label' }
                ]
            },
            {
                icon: 'keyboard_arrow_up',
                'icon-alt': 'keyboard_arrow_down',
                text: 'More',
                model: false,
                children: [
                    { text: 'Import' },
                    { text: 'Export' },
                    { text: 'Print' },
                    { text: 'Undo changes' },
                    { text: 'Other contacts' }
                ]
            }
        ]
    }
  }
}
</script>

<style lang="css">
</style>
