<template>
  <v-container>
      <v-tabs>
          <v-tab ripple>Articulos</v-tab>
          <v-tab riple>Marcas</v-tab>
          <v-tab ripple>Usuarios</v-tab>
          <v-tab ripple>Categorias</v-tab>
          
          <v-tab-item>
              <adminArticulos></adminArticulos>
          </v-tab-item>
          <v-tab-item>
              <adminMarcas></adminMarcas>
          </v-tab-item>
          <v-tab-item>
              <adminUsuarios></adminUsuarios>
          </v-tab-item>
          <v-tab-item>
              <adminCategorias></adminCategorias>
          </v-tab-item>
      </v-tabs>
  </v-container>
</template>

<script>
import AdminArticulos from "./AdminArticulos"
import AdminMarcas from "./AdminMarcas"
import AdminUsuarios from "./AdminUsuarios"
import AdminCategorias from "./AdminCategorias"
export default {
    components: {
        AdminArticulos,
        AdminMarcas,
        AdminUsuarios,
        AdminCategorias
    }
}
</script>

<style>

</style>