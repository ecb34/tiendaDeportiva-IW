<template>
  <v-container>
      <v-list>
        <v-subheader color="primary" class="blue--text">LISTADO DE TIENDAS</v-subheader>
        <v-list-item-group v-model="item" color="primary">
          <v-list-item v-for="(item, i) in items" :key="i">
            <v-list-item-content>
              <v-list-item-title v-html="item" v-on:click="mostrarMapa(item)"></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
      <v-label>{{itemSelected}}</v-label>
  </v-container>
</template>

<script>
export default {
    data: () => ({
      item: 4,
      items: [
          'Alicante',
          'Ibi',
          'Madrid',
          'Torrevieja'
      ],
      itemSelected: ''
    }),
    methods: {
        mostrarMapa(item){
            this.itemSelected = item
        }
    }
}
</script>

<style>

</style>