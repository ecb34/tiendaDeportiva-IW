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
    
    <articulos-recomendados :snackbar="snackbar"></articulos-recomendados>

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