<template>
    <v-expansion-panel>
      <v-expansion-panel-header>Categorias</v-expansion-panel-header>
      <v-expansion-panel-content>
        <v-treeview
          v-model="newSelection"
          :items="items"
          :selection-type="selectionType"
          selectable
          return-object
        ></v-treeview>
      </v-expansion-panel-content>
    </v-expansion-panel>
</template>

<script>
import axios from "axios";
export default {
  name: "articulos",
  // Datos que recibe la vista
  props: ['selection'],
  data() {
    // Datos que devuelve la vista EJ: Un objeto nuevo/modificado/borrado
    return {
        selectionType: 'leaf',
        newSelection: [],
        items:[]
    };
  },
  async mounted() {
    try {
      console.log("Filtro categorias montado")
      const cat = await axios.get("/api/categorias");
      this.items = cat.data;
    } catch (err) {}
  },
  methods: {

  },
  watch: {
    $route(to, from) {
      this.newSelection = [];
    },
    newSelection() { // newSelection() ha de coincidir con this.newSelection para que la vigile
      // Con $emit Devolvemos la lista de articulos ordenadas a la vista padre
      this.$emit('newCategoriaSelection', this.newSelection);
    }
  }
};
</script>
<style>

</style>