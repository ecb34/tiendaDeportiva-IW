<template>
<div>
  <h2 class="mt-3">Artículos Recomendados</h2>
  <div v-if="articulosRecomendados.length > 0">
    <carousel class="mt-5" :loop="false" :items="6" :nav="false">
      
        <div v-for="articulo in articulosRecomendados" :key="articulo.id">
           <v-tooltip bottom color="primary">
              <template v-slot:activator="{ on }">
                <a :href="'/articulos/'+articulo.id">
                  <img height="200px" :src="articulo.imagenes[0].url" :alt="articulo.nombre" v-on="on">
                </a>
              </template>
              <span>{{articulo.nombre}}</span>
            </v-tooltip>
        </div>
    </carousel>
  </div>
</div>
</template>

<script>
import carousel from 'vue-owl-carousel'
export default {
  components: { carousel },
  // Parametros de la vista
  props: [
    'snackbar',
    'vista'
  ],
  data() { 
      // Respuesta
      return {
        articulosRecomendados: []
      }
    },
  async mounted(){
    axios.get('/api/articulos?destacados=home')
        .then(response => {
          this.articulosRecomendados = response.data;
        }).catch(err => {
          console.log(err)
        })
  },
  computed: {
  }
}
</script>

<style>

</style>