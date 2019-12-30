<template>
    <v-content>
            <v-row>
                <v-col cols="12" sm="2">
                    <v-treeview
                    v-model="selection"
                    :items="items"
                    :selection-type="selectionType"
                    selectable
                    return-object
                    open-all
                    ></v-treeview>
                </v-col>
                <v-col cols="12" sm="10">
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
                </v-col>
            </v-row>
        </v-content>
    
        
</template>

<script>
import axios from "axios";
export default {
    name: 'articulos',

    data(){
        return{
            listaArticulos: [],
            selectionType: 'leaf',
            selection: [],
            items:[],
        }
    },
    async created(){
        try{
            this.traerArticulos();
            
            const cat = await axios.get('/api/categorias');
            this.items = cat.data;
        }catch(err){

        }
    },
        methods: {
            filtrarArticulos: function(articulo){
                if(this.$route.name === 'hombre' && (articulo.genero == 0 || articulo.genero == 2)){
                    return true;
                }else if(this.$route.name === 'mujer' && (articulo.genero == 1 || articulo.genero == 2)){
                    return true;
                }else if(this.$route.name === 'articulos'){
                    return true;
                }

                return false;
            },
            traerArticulos: function (){
                axios.get('/api/articulos')
                .then(response => {
                    this.listaArticulos = response.data.data
                        .filter((articulo) => {
                            return this.filtrarArticulos(articulo)
                        })
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        },
         watch: {
            $route(to, from) {
                this.traerArticulos();
            },
            selection(){
                if(this.selection.length == 0) this.traerArticulos()
                this.listaArticulos = this.listaArticulos.filter((articulo) =>{
                    console.log(articulo.categoria)
                    return this.selection.some( s => s.id == articulo.categoria.id)
                })
            }
         }

    }
</script>

<style>

</style>