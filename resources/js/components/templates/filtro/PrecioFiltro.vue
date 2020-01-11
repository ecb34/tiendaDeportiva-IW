<template>
    <v-expansion-panel>
      <v-expansion-panel-header>Precio</v-expansion-panel-header>
      <v-expansion-panel-content>
        <v-text-field 
          v-model="min" 
          :rules="reglasMin" 
          label="$Min."
          type="number">
        </v-text-field>
        <v-text-field 
          v-model="max" 
          :rules="reglasMax" 
          label="$Max."
          type="number">
        </v-text-field>
        
      </v-expansion-panel-content>
    </v-expansion-panel>
</template>

<script>
import axios from "axios";
export default {
  name: "articulos",
  // Datos que recibe la vista
  props: ['MAX'],
  data() {
    // Datos que devuelve la vista EJ: Un objeto nuevo/modificado/borrado
    return {
      min: 0,
      reglasMin: [
         //v => !!v || 'Required',
         v => v >= 0 || 'Min no puede ser negativo',
      ],
      max: "",
      reglasMax: [
         //v => !!v || 'Required',
         v => v >= 0 || 'Max no puede ser negativo',
      ]
    };
  },
  async mounted() {
    try {
      console.log("Filtro precios montado")
      this.max = parseFloat(this.MAX)
    } catch (err) {}
  },
  methods: {
    comprobar() {
        var aux = this.MAX
        this.$emit('newMinMax', { 
          "min": (!this.min)
                  ? 0 : parseFloat(this.min), 
          "max": (!this.max) 
                  ? aux : parseFloat(this.max)}
        );
    }
  },
  watch: {
    $route(to, from) {
      this.min = "";
      this.max = "";
    },
    min() { 
      // Con $emit Devolvemos datos a la vista padre
      if(this.min >= 0)
        this.comprobar();
    },
    max() {
      // Con $emit Devolvemos datos a la vista padre
      if(this.max >= 0)
        this.comprobar();
    }
  }
};
</script>
<style>

</style>