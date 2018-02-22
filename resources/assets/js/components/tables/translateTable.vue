<template>
  <v-data-table
     :headers="headers"
     :items="items"
     :pagination.sync="pagination"
     :total-items="totalItems"
     :loading="loading"
     class="elevation-1"
   >
     <template slot="items" slot-scope="props">
       <td>{{ props.item.name }}</td>
       <td class="text-xs-right">{{ props.item.calories }}</td>
       <td class="text-xs-right">{{ props.item.fat }}</td>
       <td class="text-xs-right">{{ props.item.carbs }}</td>
       <td class="text-xs-right">{{ props.item.protein }}</td>
       <td class="text-xs-right">{{ props.item.iron }}</td>
     </template>
     <template slot="footer">
       <td colspan="100%">
         <strong>This is an extra footer</strong>
       </td>
     </template>
   </v-data-table>
</template>

<script>
  export default {
    data () {
      return {
        search: '',
        totalItems: 0,
        items: [],
        loading: true,
        pagination: {},
        headers: [
          {
            text: 'Dessert (100g serving)',
            align: 'left',
            sortable: false,
            value: 'name'
          },
          { text: 'Calories', value: 'calories' },
          { text: 'Fat (g)', value: 'fat' },
          { text: 'Carbs (g)', value: 'carbs' },
          { text: 'Protein (g)', value: 'protein' },
          { text: 'Iron (%)', value: 'iron' }
        ]
      }
    },
    // mounted () {
    //   var data = this.getDataFromApi();
    //   this.items = data.items;
    //   this.totalItems = data.items.length
    //   this.loading = false;
    // },
    watch: {
     pagination: {
       handler () {
         var data = this.getDataFromApi();
         this.items = data.items;
         this.totalItems = data.items.length
         this.loading = false;
       },
       deep: true
     }
   },
    methods:{
      getDataFromApi: function () {
        this.loading = true
        console.log('70');

        return {
          items : this.getDesserts()
        }
      },
      getDesserts: function () {
        return [
          {
            value: false,
            name: 'Frozen Yogurt',
            calories: 159,
            fat: 6.0,
            carbs: 24,
            protein: 4.0,
            iron: '1%'
          },
          {
            value: false,
            name: 'Ice cream sandwich',
            calories: 237,
            fat: 9.0,
            carbs: 37,
            protein: 4.3,
            iron: '1%'
          }
        ]
      }
    }
  }
</script>
