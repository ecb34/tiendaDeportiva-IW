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
      <img src="https://placeimg.com/500/500/any?1">
      <img src="https://placeimg.com/500/500/any?2">
      <img src="https://placeimg.com/500/500/any?3">
      <img src="https://placeimg.com/500/500/any?4">
      <img src="https://placeimg.com/500/500/any?5">
      <img src="https://placeimg.com/500/500/any?6">
    </carousel>
</v-container>
</template>

<script>
import carousel from 'vue-owl-carousel'
export default {
  components: { carousel },
  data () {
      return {
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
}
</script>

<style>

</style>