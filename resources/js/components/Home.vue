<template>
<div>
    <v-carousel>
      <v-carousel-item v-for="(item,i) in items"
        :key="i"
        :src="item.src"
        reverse-transition="fade-transition"
        transition="fade-transition"
      ></v-carousel-item>
    </v-carousel>
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
  <v-snackbar v-model="mostrar_snackbar" color="success" top class="title">
        {{snackbar}}
  </v-snackbar>
</div>
</template>

<script>
import carousel from 'vue-owl-carousel'
export default {
  components: { carousel },
  props:{
    snackbar: {
      type: String
    }
  },
  data () {
      return {
        articulosRecomendados: [],
        hover: false,
        items: [
          {
            src: 'https://d321d41hgs2fyt.cloudfront.net/media/wysiwyg/home/home_christmas_hombre.jpg',
          },
          {
            src: 'https://d321d41hgs2fyt.cloudfront.net/media/wysiwyg/home/home_christmas_mujer.jpg',
          },
          {
            src: 'https://d321d41hgs2fyt.cloudfront.net/media/wysiwyg/landings/mujer/2019/7-noviembre/desktop/banner1.jpg',
          },
          {
            src: 'https://d321d41hgs2fyt.cloudfront.net/media/wysiwyg/landings/mujer/2019/7-noviembre/desktop/banner4_adidas.jpg',
          },
        ],
      }
    },
  mounted(){
    axios.get('/api/articulos?destacados=home')
        .then(response => {
          this.articulosRecomendados = response.data;
        }).catch(err => {
          console.log(err)
        })
  },
  computed: {
    mostrar_snackbar: {
      get(){
         return !!this.snackbar
       },
      set(value){
         return value
      }  
    }
  },
  methods: {
  }
}
</script>

<style>

</style>