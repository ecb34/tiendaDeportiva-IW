<template>
    <v-expansion-panel>
      <v-expansion-panel-header>Valoración</v-expansion-panel-header>
      <v-expansion-panel-content>
        <v-rating :half-increments=true v-model="valoracion"></v-rating>
      </v-expansion-panel-content>
    </v-expansion-panel>
</template>

<script>
import axios from "axios";
export default {
  name: "articulos",
  // Datos que recibe la vista
  props: ['rating'],
  data() {
    // Datos que devuelve la vista EJ: Un objeto nuevo/modificado/borrado
    return {
      valoracion: 0,
    };
  },
  async mounted() {
    try {
      console.log("Filtro valoracion montado")
      this.valoracion = parseFloat(this.rating);
    } catch (err) {}
  },
  methods: {

  },
  watch: {
    $route(to, from) {
      this.newSelection = [];
    },
    valoracion() { 
      // Con $emit Devolvemos los datos a la vista padre
      this.$emit('newRating', parseFloat(this.valoracion));
    }
  }
};
</script>
<style>

</style>