<template>
  <v-container>
    <div class="containerSize">
      <h1 class="mt-12">ERROR 404</h1>
      <h1 class="mt-8">Página no encontrada</h1>
      <v-btn text class="mt-12" @click="$router.go(-1)" color="primary">Volver a la página anterior</v-btn>
    </div>
  </v-container>

</template>

<script>
export default {

}
</script>

<style>
  .containerSize{
    height: 400px;
  }
</style>