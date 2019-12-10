<template>
    <v-container>
        <v-row>
            <v-col v-for="articulo in this.listaArticulos" v-bind:key="articulo.id" cols="12" sm="4">
                <v-card class="mx-auto" max-width="400">
                    <v-img class="orange--text align-end" height="200px"  v-bind:src="articulo.imagenes[0].url">
                    <v-card-title>{{articulo.nombre}}</v-card-title>
                    </v-img>
                    <v-card-subtitle class="pb-0">{{articulo.pvp}}</v-card-subtitle>

                    <v-card-text class="text--primary">
                        {{articulo.descripcion}}
                    </v-card-text>

                    <v-card-actions>
                    <v-btn color="orange" text :to="`/articulos/${articulo.id}`">
                        Ver
                    </v-btn>

                    <v-btn color="green" text>
                        Añadir a la cesta
                    </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
        
        
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
            console.log(res.data.data);
            this.listaArticulos = res.data.data;
        }catch(err){

        }
    }
}
</script>

<style>

</style>