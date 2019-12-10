<template>
  <v-container>
      <v-row>
        <v-col cols="12" sm="6">
            <h1>Puedes contactar con nosotros desde nuestras redes sociales</h1>
            <h3 class="mt-3">Twitter: @uasport</h3>
            <h3 class="mt-3">Facebook: UASPORT</h3>
            <h3 class="mt-3">Instagram: @uasportes</h3>
            <h3 class="mt-3">Teléfono de atención: 915938888</h3>
        </v-col>
        <v-col cols="12" sm="6">
            <about></about>
        </v-col>
      </v-row>
  </v-container>
</template>

<script>
import About from "./About"
export default {
    components: {
        "about": About,
    }
}
</script>

<style>

</style>