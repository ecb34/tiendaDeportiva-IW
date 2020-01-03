<template>
<v-container>
    <v-carousel>
      <v-carousel-item v-for="(item,i) in items"
        :key="i"
        :src="item.src"
        reverse-transition="fade-transition"
        transition="fade-transition"
      ></v-carousel-item>
    </v-carousel>

  <h2 class="mt-3">Categorias Recomendadas</h2>
  <carousel class="mt-5" :nav="false" :items="4" :loop="true">
      <img :src="categoria.imagen.url" :alt="categoria.nombre" v-for="categoria in categoriasRecomendadas" :key="categoria.id" @click="articulosPorCategoria(categoria)">
  </carousel>
  <v-snackbar v-model="mostrar_snackbar" color="success" top class="title">
        Te has registrado exitosamente
      <v-btn dark flat @click="mostrar_snackbar = false">
          Cerrar
      </v-btn>
  </v-snackbar>
</v-container>
</template>

<script>
import carousel from 'vue-owl-carousel'
export default {
  components: { carousel },
  props:{
    mostrar_snackbar: {
      type: Boolean
    }
  },
  data () {
      return {
        categoriasRecomendadas: [],
        items: [
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
          },
        ],
      }
    },
  mounted(){
    axios.get('/api/categoriasrecomendadas')
        .then(response => {
          this.categoriasRecomendadas = response.data;
          console.log(response.data)
        }).catch(err => {
          console.log(err)
        })
  },
  methods: {
    articulosPorCategoria(categoria){
      this.$router.push({name: 'articulos', query: {q: categoria.name}})
    }
  }
}
</script>

<style>

</style>