<template>
    <v-container fluid>    
        <v-row>
            <v-col cols="1">
                <v-hover v-for="index in listaImagenes.length" v-bind:key="index" class="mb-4"
                    v-slot:default="{ hover }">
                    <v-card :elevation="hover ? 12 : 2" :class="{ 'on-hover': hover }"
                        v-on:click="cambiarImagen(index-1)">
                        <v-img v-bind:src="listaImagenes[index-1].url" aspect-ratio=1 max-height="70"></v-img>
                    </v-card>
                </v-hover>
            </v-col>
            <v-col cols="8" justify="center">

                <v-row justify="center">
                    <v-img id="img" v-bind:src="imagen" aspect-ratio="1" class="grey lighten-2" max-width="800"
                        max-height="600">
                    </v-img>

                </v-row>

            </v-col>
            <v-col justify="center">

                <p class="display-2">{{articulo.nombre}}</p>
                <p class="headline">Descripcion:</p>
                <p class="body-2">{{articulo.descripcion}}</p>
                <v-row justify="center">
                    <p class="body-2">Total: {{articulo.pvp}}€</p>
                </v-row>
                <v-row justify="center">
                    <v-rating readonly :half-increments="true" color="orange" v-model="articulo.valoracion" justify-center></v-rating>
                </v-row>
                <v-row>
                    <v-btn color="success" :disabled="!loggedIn" @click="addArticuloToCarrito()">
                        <v-icon>mdi-cart</v-icon>Añadir al carrito
                    </v-btn>
                </v-row>
                <v-row class="mt-5">
                    <v-btn color="pink" class="white--text" :disabled="!loggedIn" @click="addListaDeseos()">
                        <v-icon>mdi-heart</v-icon> Añadir a Deseados
                    </v-btn>
                </v-row>
                <v-divider class="mb-4 mt-2 green"></v-divider>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="8">
                <v-divider class="mb-4 mt-2"></v-divider>
                <v-tabs :grow="true" color="cyan" dark slider-color="yellow">
                    <v-tab ripple>
                        <v-badge v-if="listaComentarios.length > 0" :content="listaComentarios.length">
                            Comentarios
                        </v-badge>
                        <span v-else>
                            Comentarios
                        </span>
                    </v-tab>
                    <v-tab v-if="loggedIn" ripple>
                        Comentar
                    </v-tab>
                    <v-tab-item>
                        <v-card text>
                            <v-list three-line>
                                <v-card-text v-if="listaComentarios.length==0"> <h3>No hay ningún comentario todavía, dejanos tu opinión ;). </h3></v-card-text>
                                <template v-for="(item, index) in listaComentarios" :v-bind="index">

                                    <v-list-item :key="item.title">
                                        <v-list-item-avatar>
                                            <v-img src="https://cdn.onlinewebfonts.com/svg/img_184513.png"></v-img>
                                        </v-list-item-avatar>

                                        <v-list-item-content>
                                            <v-list-item-title>{{item.user}} - {{fechaFormateada(item.created_at)}}</v-list-item-title>
                                            <v-list-item-subtitle v-text="item.texto"></v-list-item-subtitle>
                                            <v-rating readonly :half-increments="true" color="orange" v-model="item.valoracion" justify-center></v-rating>
                                            <v-list-item-group v-if="user.id===item.user_id">
                                                <v-btn color="success" class="mr-4" @click="swapEdit(index)"><v-icon class="mr-1">edit</v-icon></v-btn>
                                                <v-btn color="error" class="mr-4" @click="deleteComment(item)"><v-icon class="mr-1">delete</v-icon></v-btn>
                                            </v-list-item-group>
                                        </v-list-item-content>
                                        
                                        <v-list-item-content v-if="edit===index">
                                            <v-form v-on:submit.prevent="comentar">
                                                <v-rating :x-large="true" :half-increments="true" color="orange" v-model="valoracion" justify-center> </v-rating>
                                                <v-textarea v-model="comentario" solo name="input-7-4" label="Comentario"></v-textarea>
                                                <v-btn color="success" class="mr-4" @click="comentar(item.id, index)">Guardar</v-btn>
                                                <v-btn color="error" class="mr-4" @click="swapEdit(-1)">Cancelar</v-btn>
                                            </v-form>
                                        </v-list-item-content>
                                    </v-list-item>
                                </template>
                            </v-list>
                        </v-card>
                    </v-tab-item>
                    <v-tab-item>
                        <v-card>
                            <v-form v-on:submit.prevent="comentar">
                                <v-rating :x-large="true" :half-increments="true" color="orange" v-model="valoracion" justify-center> </v-rating>
                                <v-textarea v-model="comentario" solo name="input-7-4" label="Comentario"></v-textarea>
                                <v-btn color="success" class="mr-4" @click="comentar(-1, -1)">Comentar</v-btn>
                            </v-form>
                        </v-card>
                    </v-tab-item>
                </v-tabs>
                <p class="display-1 mt-3">Articulos relacionados</p>
                <v-row>
                    <v-card v-for="articulo in this.listaArticulos" v-bind:key="articulo.id" class="mx-auto mb-6"
                        max-width="250">
                        <v-img class="orange--text align-end" v-bind:src="articulo.imagenes[0].url">
                            <v-card-title>{{articulo.nombre}}</v-card-title>
                        </v-img>
                        <v-card-subtitle class="pb-0">{{articulo.pvp}}€</v-card-subtitle>
                        <v-card-text class="text--primary">
                            {{articulo.descripcion}}
                        </v-card-text>
                        <v-card-actions>
                            <v-btn color="orange" text>
                                Ver
                            </v-btn>
                            <v-btn color="green" text>
                                Añadir
                            </v-btn>
                        </v-card-actions>
                    </v-card>
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
        name: 'articulo',
        data() {
            return {
                user: {},
                contadorImagen: 0,
                articulo: {},
                listaArticulos: [],
                comentario: "",
                valoracion: 0,
                edit: -1,
                listaComentarios: [],
                listaArticulosRelacionados: [],
                listaImagenes: [],
                imagen: '',
                snackbar: '',
                mostrar_snackbar: false
            }
        },
        methods: {
            cambiarImagen: function (i) {
                this.imagen = this.listaImagenes[i].url;
            },
            addListaDeseos(){
                axios.post('/api/user/listadeseos',{
                    'articulo_id': this.articulo.id
                }).then(res =>{
                    this.mostrar_snackbar = true
                    this.snackbar = 'Añadido a lista de deseos'
                }).catch(err =>{
                    if(err.response.status == 400){
                        this.mostrar_snackbar = true
                        this.snackbar = 'El artículo ya está en la lista de deseos'
                    }
                    console.log(err.response);
                })
            },
            addArticuloToCarrito() {
                axios.post('/api/user/carrito',{
                    'articulo_id': this.articulo.id,
                    'pvp': this.articulo.pvp,
                    'cantidad': 1
                }).then(res =>{
                    this.mostrar_snackbar = true
                    this.snackbar = 'Añadido a carrito'
                }).catch(err =>{
                    if(err.response.status == 400){
                        this.mostrar_snackbar = true
                        this.snackbar = 'El artículo ya está en la lista de deseos'
                    }
                    console.log(err.response);
                })
            },
            comentar: function(id, index){  // [-1, -1] es un comentario nuevo
                axios.post('/api/articulo/comentar',{
                    'articulo_id': this.articulo.id,
                    'valoracion': this.valoracion,
                    'comentario': this.comentario,
                    'comentario_id': id
                }).then(res =>{
                    this.mostrar_snackbar = true
                    res.data[0].user = this.user.nombre
                    this.snackbar = (this.edit==-1? 'Comentario guardado' : 'Comentario editado')
                    this.edit==-1? this.listaComentarios.push(res.data[0]) : (this.listaComentarios[index]=res.data[0]);
                    this.articulo.valoracion = res.data[1];
                    this.comentario = ""
                    this.valoracion = 0
                    this.edit=-1;
                }).catch(err =>{
                    console.log(err.response);
                })
            },
            swapEdit: function (i){
                this.edit = i;
            },
            deleteComment: function(comentario){
                axios.delete('/api/articulo/comentarios/'+comentario.id)
                    .then(res =>{
                    this.mostrar_snackbar = true
                    this.snackbar = 'Comentario borrado'
                    this.listaComentarios.splice(this.listaComentarios.indexOf(comentario), 1)
                    this.articulo.valoracion = res.data;
                }).catch(err =>{
                    console.log(err.response);
                })
            },
            fechaFormateada(fecha) {
                if (fecha) {
                    var split = fecha.split("T");
                    split = split[0].split('-')
                    return split[2] + "/" + split[1] + "/" + split[0];
                }

                return "";
            }
        },
        computed: {
            loggedIn() {
                return this.$store.getters.loggedIn
            }
        },
        async created() {
            try {
                // Obtenemos el usuario logueado.
                try{ 
                    const res = await axios.get("/api/auth/user")
                    this.user = res.data.user
                }catch(err){ 
                    // En caso de que no esté logueado ponemos user.id a -1 para que se muestren las cosas...
                    this.user.id = -1
                    console.log(err)
                }
                
                
                //articulo con ID especifica, recuperamos las imagenes del articulo
                const res2 = await axios.get('/api/articulos/' + this.$route.params.id);
                this.articulo = res2.data.data;
                this.listaImagenes = this.articulo.imagenes;
                this.imagen = this.listaImagenes[0].url;
                this.listaComentarios = this.articulo.comentarios.filter((comentario) =>{
                        return comentario.bloqueado == false    
                    })
                
                //lista de articulos recomendados
                axios.get('/api/articulos?destacados=detalle&marca='+this.articulo.marca.id)
                .then(response => {
                    this.listaArticulos = response.data;
                }).catch(err => {
                    console.log(err.response)
                })
            } catch (err) {
                console.log(err.response);
            }

        }
    }
</script>

<style>

</style>