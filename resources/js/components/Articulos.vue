<template>
    <v-content>
            <v-row>
                <v-col cols="12" sm="2">
                    <v-row v-if="loading" justify="center">
                        <v-progress-circular
                        :width="4"
                        :size="100"
                        color="primary"
                        indeterminate
                        ></v-progress-circular>
                    </v-row>
                    <div v-else>
                        <h2 class="mt-3 ml-3">Categorias</h2>
                        <v-treeview 
                        v-model="selection"
                        :items="items"
                        :selection-type="selectionType"
                        selectable
                        return-object
                        ></v-treeview>
                        
                        <h2 class="mt-3 ml-3">Precio</h2>
                        <v-range-slider
                        v-model="rangoPrecio"
                        :max="this.max"
                        :min="0"
                        hide-details
                        thumb-label="always"
                        :thumb-size="24"
                        class="mt-3"
                        ></v-range-slider>
                    </div>
                </v-col>
                <v-col cols="12" sm="10">
                    <h1 v-if="listaArticulos.length === 0 && !loading">No hay articulos de esta categoría</h1>
                    <v-row v-if="loading" justify="center">
                        <v-progress-circular
                        :width="4"
                        :size="100"
                        color="primary"
                        indeterminate
                        ></v-progress-circular>
                    </v-row>
                    <v-row v-else>
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

                                <v-btn color="green" text @click="addArticuloToCarrito(articulo)">
                                    Añadir a la cesta
                                </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
            <v-snackbar v-model="mostrar_snackbar" color="success" top class="title">
                {{snackbar}}
                <v-btn dark text @click="mostrar_snackbar = false">
                    Cerrar
                </v-btn>
            </v-snackbar>
        </v-content>
</template>

<script>
import axios from "axios";
export default {
    name: 'articulos',

    data(){
        return{
            mostrar_snackbar: false,
            snackbar: '',
            listaArticulos: [],
            listaArticulosSinFiltro: [],
            selectionType: 'leaf',
            selection: [],
            rangoPrecio: [0, 0],
            items:[],
            max: 0,
            loading: true
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
                if(this.$route.query.q){
                    return articulo.nombre.toUpperCase().includes(this.$route.query.q.toUpperCase())
                }else if(this.$route.name === 'hombre' && (articulo.genero == 0 || articulo.genero == 2)){
                    return true;
                }else if(this.$route.name === 'mujer' && (articulo.genero == 1 || articulo.genero == 2)){
                    return true;
                }else if(this.$route.name === 'articulos'){
                    return true;
                }

                return false;
            },
            traerArticulos: function (){
                this.loading = true
                axios.get('/api/articulos')
                .then(response => {
                    console.log(response.data)
                    this.listaArticulos = response.data
                        .filter(this.filtrarArticulos)
                    this.max = this.listaArticulos.reduce((res, current) =>{
                        return (current.pvp > res) ? current.pvp : res
                    }, -1)
                    this.rangoPrecio[1] = this.max
                    console.log(this.rangoPrecio[1])
                    console.log(this.max)
                    this.loading = false;
                    this.listaArticulosSinFiltro = this.listaArticulos
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            addArticuloToCarrito(articulo) {
                axios.post('/api/user/carrito',{
                    'articulo_id': articulo.id,
                    'pvp': articulo.pvp,
                    'cantidad': 1
                }).then(res =>{
                    this.mostrar_snackbar = true
                    this.snackbar = 'Añadido a carrito'
                }).catch(err =>{
                    console.log(err.response);
                })
            },
            filtrarPorCategoria(){
                if(this.selection.length == 0) this.listaArticulos = this.listaArticulosSinFiltro
                else{
                    this.listaArticulos = this.listaArticulosSinFiltro.filter((articulo) =>{
                        return this.selection.some( s => s.id == articulo.categoria_id)    
                    })
                }
            },
            filtrarPorPrecio(){
                this.listaArticulos = this.listaArticulos.filter(articulo => {
                    return (articulo.pvp >= this.rangoPrecio[0]) && (articulo.pvp <= this.rangoPrecio[1])
                })
            },
            filtroGeneral(){
                this.filtrarPorCategoria()
                this.filtrarPorPrecio()
                console.log(this.listaArticulos)
            }
        },
         watch: {
            $route(to, from) {
                this.selection = [];
                this.rangoPrecio = [0,500]
                this.traerArticulos();
            },
            selection(){
                this.filtroGeneral()
            },
            rangoPrecio(){
                this.filtroGeneral()
            }
         }

    }
</script>

<style>

</style>