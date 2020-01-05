<template>
  <v-content>
      <div v-if="direccion">
          <h3>Direccion Seleccionada: {{direccion.linea1}} <v-btn text @click="direccion = null" color="primary">Cambiar dirección</v-btn></h3>     
      </div>
      <direccion v-else @seleccionarDireccion="seleccionarDireccion"></direccion>
      
  </v-content>
 
</template>

<script>
import Direccion from './Direccion'
export default {
    data(){
        return {
            direccion: null
        }
    },
    methods: {
        seleccionarDireccion(direccion){
            this.direccion = direccion
        }
    },
    components: {
        Direccion
    }
}
</script>

<style>

</style>