<template>
    <v-container fluid >
            <v-row justify="center">
                <v-col class="sidebar" cols="12" lg="3" sm="12">
                     <!-- Filtros -->
                    <h3 justify-center>Filtros</h3>
                     <filtro-articulo 
                        :articulos="articulos"
                        @articulosOrdenados="getArticulos">
                     </filtro-articulo>
                    
                </v-col>
                <v-col cols="12" lg="9" sm="12">
                    <!-- No se encuentran articulos -->
                    <h1 v-if="articulos.length === 0 && !loading">
                        No se han encontrado artículos.
                    </h1>
                    <v-row v-if="loading" justify="center">
                        <v-progress-circular
                        :width="4"
                        :size="100"
                        color="primary"
                        indeterminate
                        ></v-progress-circular>
                    </v-row>
                    <!-- Se encuentran articulos -->
                    <v-row v-else>
                         <!-- Detalle Articulo -->
                        <articulo-detalle-md 
                            v-for="articulo in this.articulos"
                            :key="articulo.id"
                            :articulo="articulo">
                        </articulo-detalle-md>
                    </v-row>
                </v-col>
            </v-row>
            <v-snackbar v-model="mostrar_snackbar" color="success" top class="title">
                {{snackbar}}
                <v-btn dark text @click="mostrar_snackbar = false">
                    Cerrar
                </v-btn>
            </v-snackbar>
        </v-container>
</template>

<script>
import axios from "axios";
export default {
    name: 'articulos',
    data(){
        return{
            mostrar_snackbar: false,
            snackbar: '',
            articulos: [],
            loading: true
        }
    },
    async created(){
        try {

        } catch (err) {}
    },
        methods: {
            // Obtiene la lista enviada por el filtro
            getArticulos(articulosOrdenados) {
                this.articulos = articulosOrdenados;
                this.loading = false
                console.log("ArticulosOrdenados cargados", articulosOrdenados)
            }
        },
         watch: {

         }

    }
</script>
<style>
.v-card--reveal {
  align-items: center;
  bottom: 0;
  justify-content: center;
  opacity: .5;
  position: absolute;
  width: 100%;
}
</style>