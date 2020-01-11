<template>
    <v-expansion-panel>
      <v-expansion-panel-header>Marcas</v-expansion-panel-header>
      <v-expansion-panel-content>
        <v-checkbox
          v-for="marca in marcas"
          :key="marca.id"
          v-model="selection"
          :label="marca.nombre"
          :value="marca.id"
        ></v-checkbox>
      </v-expansion-panel-content>
    </v-expansion-panel>
</template>

<script>
import axios from "axios";
export default {
  name: "articulos",
  // Datos que recibe la vista
  props: ['selected_marca'],
  data() {
    // Datos que devuelve la vista EJ: Un objeto nuevo/modificado/borrado
    return {
      marcas: [],
      selection: []
    };
  },
  async created() {
    try {
      console.log("Filtro marcas montado")
    
      const items = await axios.get("/api/marcas");
      this.marcas = items.data.data;

    } catch (err) {}
  },
  methods: {
    traerMarcas: function() {
      axios.get("/api/marcas").then(response => {
        this.marcas = response.data.data;
      });
    },
  },
  watch: {
    $route(to, from) {
      this.marcas = [];
      this.selection = [];
    },
    selection() { 
      // Con $emit Devolvemos la lista de articulos ordenadas a la vista padre
      this.$emit('newMarcaSelection', this.selection);
    }
  }
};
</script>
<style>

</style>