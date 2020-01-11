<template>
    <v-col cols="12" xs="12" sm="6" md="4" lg="3" >
        <!--
        <v-card 
        class="mx-auto" 
        max-width="400"
        :elevation="6">
            <v-img class="orange--text align-end" height="200px"  v-bind:src="articulo.imagenes[0].url">
            <v-card-title>{{articulo.nombre}}</v-card-title>
            </v-img>
            <v-card-subtitle class="pb-0">{{articulo.pvp}}</v-card-subtitle>

            <v-card-text class="text--primary">
                {{articulo.descripcion}}
                <span class="grey--text text--lighten-2 caption mr-2">
                    ({{ rating }})
                </span>
                <v-rating
                v-bind:value="articulo.valoracion"
                ></v-rating>
            </v-card-text>

            <v-card-actions>
            <v-btn color="orange" text :to="`/articulos/${articulo.id}`">
                Ver
            </v-btn>

            <v-btn color="green" text @click="addArticuloToCarrito(articulo)">
                Añadir a la cesta
            </v-btn>
            </v-card-actions>
        </v-card>-->
        <v-hover v-slot:default="{ hover }">
            <v-card
            class="mx-auto"
            color="grey lighten-4"
            max-width="600"
            height="100%"
            >
                <router-link :to="`/articulos/${articulo.id}`">
                    <v-img :aspect-ratio="16/9" v-bind:src="articulo.imagenes[0].url">
                        <v-expand-transition>
                            <div v-if="hover"
                                class="d-flex transition-fast-in-fast-out orange darken-2 v-card--reveal display-3 white--text"
                                style="height: 100%;"
                            >
                                Ver
                            </div>
                        </v-expand-transition>
                    </v-img>
                </router-link>
                <v-card-text class="pt-6" style="position: relative;" >   
                    <v-btn absolute color="orange" class="white--text"
                    fab large right top @click="addArticuloToCarrito(articulo)" 
                    >
                    <v-icon>mdi-cart</v-icon>
                    </v-btn>
                    
                    <h3 class="display-1 font-weight-light orange--text mb-2">{{articulo.nombre.substring(0,15)}}</h3>
                    <div class="font-weight-light title mb-2">
                        {{articulo.descripcion.substring(0,100)}}...
                    </div>
                </v-card-text>
                
                <v-card-actions height="10%">
                    <v-rating :half-increments=true readonly v-bind:value="articulo.valoracion" ></v-rating>
                </v-card-actions>
                
                <v-card-text class="pt-6 display-2 text-center" style="position: relative;">   
                    {{articulo.pvp}}€
                </v-card-text>
            </v-card>
        </v-hover>
    </v-col>
</template>

<script>
import axios from "axios";
export default {
    // Datos que recibe la imagen
    props: ['articulo'],
    data(){
        // Datos que puede devolver la vista con // this.$emit('articulosOrdenados', this.listaArticulos);
        return{

        }
    },
    mounted() { 
        console.log('DetalleMD montado.')
    },
        methods: {
            addArticuloToCarrito(articulo) {
                axios.post('/api/user/carrito',{
                    'articulo_id': articulo.id,
                    'pvp': articulo.pvp,
                    'cantidad': 1
                }).then(res =>{
                    
                }).catch(err =>{
                    console.log(err.response);
                })
            }
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