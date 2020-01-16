<template>
    <v-container fluid>
        <!-- Filtros -->
            <v-row >
                <v-col cols="12" xs="12" md="4" lg="3">
                     <v-row v-if="loading" justify="center">
                        <v-progress-circular
                        :width="4"
                        :size="100"
                        color="primary"
                        indeterminate
                        ></v-progress-circular>
                    </v-row>
                    <v-expansion-panels
                    v-else
                    multiple
                    v-model="panel"
                    >
                        <v-expansion-panel>
                            <v-expansion-panel-header>Categorias</v-expansion-panel-header>
                            <v-expansion-panel-content>
                            <v-treeview 
                                v-model="selection"
                                :items="items"
                                :selection-type="selectionType"
                                selectable
                                return-object
                            ></v-treeview>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                        <v-expansion-panel>
                            <v-expansion-panel-header>Precio</v-expansion-panel-header>
                            <v-expansion-panel-content>
                                    <v-range-slider
                                    v-model="rangoPrecio"
                                    :max="this.max"
                                    :min="0"
                                    hide-details
                                    thumb-label="always"
                                    :thumb-size="24"
                                    class="mt-3"
                                    ></v-range-slider>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                        <v-expansion-panel>
                            <v-expansion-panel-header>Valoración</v-expansion-panel-header>
                            <v-expansion-panel-content>
                                <v-rating :half-increments=true v-model="rating"></v-rating>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                        <v-expansion-panel>
                            <v-expansion-panel-header>Marcas</v-expansion-panel-header>
                            <v-expansion-panel-content>
                                <v-checkbox v-for="marca in marcas" 
                                :key="marca.id" 
                                v-model="selected_marca" 
                                :label="marca.nombre" 
                                :value="marca.id"
                                ></v-checkbox>
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                    </v-expansion-panels>
                    
                </v-col>
                <!-- Articulos -->
                <v-col cols="12" xs="12" md="8" lg="9">
                    <h1 v-if="listaArticulos.length === 0 && !loading">No hay articulos que cumplan los filtros</h1>
                    <v-row v-if="loading" justify="center">
                        <v-progress-circular
                        :width="4"
                        :size="100"
                        color="primary"
                        indeterminate
                        ></v-progress-circular>
                    </v-row>
                    <v-row v-else>
                        <v-col v-for="articulo in this.listaArticulos" v-bind:key="articulo.id" cols="12" xs="12" sm="6" md="4" lg="3" >
                            <v-hover v-slot:default="{ hover }">
                                <v-card
                                class="mx-auto"
                                color="grey lighten-4"
                                max-width="600"
                                height="100%"
                                >
                                <router-link :to="`/articulos/${articulo.id}`">
                                <v-img
                                    :aspect-ratio="16/9"
                                    :alt="articulo.nombre"
                                    :src="articulo.imagenes.length > 0? articulo.imagenes[0].url : ''"
                                >
                                    <v-expand-transition>
                                    <div
                                        v-if="hover"
                                        class="d-flex transition-fast-in-fast-out orange darken-2 v-card--reveal display-3 white--text"
                                        style="height: 100%;"
                                    >
                                        Ver
                                    </div>
                                    </v-expand-transition>
                                </v-img>
                                </router-link>
                                <v-card-text
                                    class="pt-6"
                                    style="position: relative;"
                                >   
                                    <v-btn
                                    absolute
                                    color="orange"
                                    class="white--text"
                                    fab
                                    large
                                    right
                                    top
                                    @click="addArticuloToCarrito(articulo)"
                                    >
                                    <v-icon>mdi-cart</v-icon>
                                    </v-btn>
                                    
                                    <h3 class="display-1 font-weight-light orange--text mb-2">{{articulo.nombre.substring(0,15)}}</h3>
                                    <div class="font-weight-light title mb-2">
                                        {{articulo.descripcion.substring(0,100)}}...
                                    </div>
                                </v-card-text>
                                
                                <v-card-actions 
                                class="pa-3"
                                height="10%">
                                    <v-rating
                                    :half-increments=true
                                    readonly
                                    v-bind:value="articulo.valoracion"
                                    ></v-rating>
                                </v-card-actions>
                                
                                <v-card-text
                                    class="pt-6 display-2 text-center"
                                    style="position: relative;"
                                   
                                >   
                                {{articulo.pvp}}€
                                </v-card-text>
                                </v-card>
                            </v-hover>
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
            listaArticulos: [],
            listaArticulosSinFiltro: [],
            selectionType: 'leaf',
            selection: [],
            rangoPrecio: [0, 0],
            items:[],
            max: 0,
            loading: true,
            rating: 0,
            marcas: [],
            selected_marca: [],
            panel:[0,1,2,3]
        }
    },
    async created(){
        try{
            this.traerArticulos();
            this.traerMarcas();
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
            traerMarcas: function () {
                axios.get('/api/marcas')
                .then(response => {
                    this.marcas = response.data.data
                })
            },
            traerArticulos: function (){
                this.loading = true
                axios.get('/api/articulos')
                .then(response => {
                    this.listaArticulos = response.data
                        .filter(this.filtrarArticulos)
                    this.max = this.listaArticulos.reduce((res, current) =>{
                        return (current.pvp > res) ? current.pvp : res
                    }, -1)
                    this.rangoPrecio[1] = this.max
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
            filtroGeneral(){
                this.listaArticulos = this.listaArticulosSinFiltro.filter((articulo) =>{
                    let marca = (this.selected_marca.length != 0)? this.selected_marca.includes(articulo.marca_id):true
                    let precio = (articulo.pvp >= this.rangoPrecio[0]) && (articulo.pvp <= this.rangoPrecio[1]) 
                    let valoracion = this.rating <= articulo.valoracion
                    let categoria = (this.selection.length != 0)? this.selection.some( s => s.id == articulo.categoria_id):true
                    return categoria && marca && precio && valoracion
                })
            }
        },
         watch: {
            $route(to, from) {
                this.selection = [];
                this.rangoPrecio = [0,500]
                this.rating = 0
                this.selected_marca = []
                this.traerArticulos()
                this.traerMarcas
            },
            selection(){
                this.filtroGeneral()
            },
            rangoPrecio(){
                this.filtroGeneral()
            },
            rating(){
               this.filtroGeneral()
            },
            selected_marca(){
                this.filtroGeneral()
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