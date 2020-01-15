<template>
  <v-container>
      <v-tabs>
          <v-tab ripple>Articulos</v-tab>
          <v-tab riple>Marcas</v-tab>
          <v-tab-item>
              <adminArticulos></adminArticulos>
          </v-tab-item>
          <v-tab-item>
              <adminMarcas></adminMarcas>
          </v-tab-item>
      </v-tabs>
  </v-container>
</template>

<script>
import AdminArticulos from "./AdminArticulos"
import AdminMarcas from "./AdminMarcas"
export default {
    components: {
        AdminArticulos,
        AdminMarcas
    }
}
</script>

<style>

</style>