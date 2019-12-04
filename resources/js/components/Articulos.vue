<template>
    <v-container>
        <v-card class="mx-auto" max-width="400" v-for="articulo in this.listaArticulos" v-bind:key="articulo.id">
            <v-img class="white--text align-end" height="200px" src="https://cdn.vuetifyjs.com/images/cards/docks.jpg">
            <v-card-title>{{articulo.nombre}}</v-card-title>
            </v-img>
            <v-card-subtitle class="pb-0">{{articulo.pvp}}</v-card-subtitle>

            <v-card-text class="text--primary">
                {{articulo.descripcion}}
            </v-card-text>

            <v-card-actions>
            <v-btn color="orange" text>
                Ver
            </v-btn>

            <v-btn color="green" text>
                Añadir a la cesta
            </v-btn>
            </v-card-actions>
        </v-card>
  </v-container>
</template>

<script>
import axios from "axios";
export default {
    name: 'articulos',
    data(){
        return{
            listaArticulos: []
        }
    },
    async created(){
        try{
            const res = await axios.get('/api/articulos');
            this.listaArticulos = res.data.data;
        }catch(err){

        }
    }
}
</script>

<style>

</style>