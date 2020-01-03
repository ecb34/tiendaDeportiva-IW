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
                    <v-rating readonly color="orange" v-model="articulo.valoracion" justify-center></v-rating>
                </v-row>
                <v-row>
                    <v-btn class="mr-4 white--text" color="green draken-4" :disabled="!$store.getters.loggedIn">Comprar</v-btn>
                    <v-btn color="primary" :disabled="!$store.getters.loggedIn">Añadir al carrito</v-btn>
                </v-row>
                <v-row class="mt-3">
                    <v-btn color="white" :disabled="!$store.getters.loggedIn" @click="addListaDeseos()">Añadir a la Lista de Deseos</v-btn>
                </v-row>
                <v-divider class="mb-4 mt-2 green"></v-divider>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="8">
                <v-divider class="mb-4 mt-2"></v-divider>
                <v-tabs color="cyan" dark slider-color="yellow">
                    <v-tab ripple>
                        Descripcion Detallada
                    </v-tab>
                    <v-tab ripple>
                        <v-badge>
                            Comentarios
                        </v-badge>
                    </v-tab>

                    <v-tab-item>
                        <v-card text>
                            <v-card-text>Contents for Item 1 go here</v-card-text>
                        </v-card>
                    </v-tab-item>
                    <v-tab-item>
                        <v-card text>
                            <v-list three-line>
                                <template v-for="(item, index) in listaComentarios" :v-bind="index">
                                    <v-list-item :key="item.title" @click="">
                                        <v-list-item-avatar>
                                            <v-img src="https://cdn.onlinewebfonts.com/svg/img_184513.png"></v-img>
                                        </v-list-item-avatar>
                                        <v-list-item-content>
                                            <v-list-item-title v-text="item.user"></v-list-item-title>
                                            <v-list-item-subtitle v-text="item.texto"></v-list-item-subtitle>
                                            <v-rating readonly color="orange" v-model="item.valoracion" justify-center>
                                            </v-rating>
                                        </v-list-item-content>
                                    </v-list-item>
                                </template>
                            </v-list>
                        </v-card>
                    </v-tab-item>
                </v-tabs>
                <p class="display-1">Articulos relacionados</p>
                <v-row>
                    <v-card v-for="articulo in this.listaArticulos" v-bind:key="articulo.id" class="mx-auto mb-6"
                        max-width="250">
                        <v-img class="orange--text align-end" v-bind:src="articulo.imagenes[0].url">
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
                rating: 4,
                contadorImagen: 0,
                articulo: {},
                listaArticulos: [],
                listaComentarios: [],
                listaArticulosRelacionados: ["https://picsum.photos/id/11/500/300", "https://picsum.photos/510/300?random",
                    'http://d26lpennugtm8s.cloudfront.net/stores/008/632/products/lchl14-negra-11-5ef53327e0e0a6e96515128489853509-640-0.jpg',
                    'https://ae01.alicdn.com/kf/HTB1yJ3PzByWBuNkSmFPq6xguVXa1.jpg?width=800&height=800&hash=1600'
                ],
                listaImagenes: ["https://picsum.photos/id/11/500/300", "https://picsum.photos/510/300?random",
                    'http://d26lpennugtm8s.cloudfront.net/stores/008/632/products/lchl14-negra-11-5ef53327e0e0a6e96515128489853509-640-0.jpg',
                    'https://ae01.alicdn.com/kf/HTB1yJ3PzByWBuNkSmFPq6xguVXa1.jpg?width=800&height=800&hash=1600'
                ],
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
                console.log(this.articulo.id);
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
            }
        },
        async created() {
            try {
                //lista de articulos
                const res = await axios.get('/api/articulos');
                //this.listaArticulos = res.data.data;

                //articulo con ID especifica, recuperamos las imagenes del articulo
                const res2 = await axios.get('/api/articulos/' + this.$route.params.id);
                this.articulo = res2.data.data;
                this.listaImagenes = this.articulo.imagenes;
                this.imagen = this.listaImagenes[0].url;
                this.listaComentarios = this.articulo.comentarios;
                console.log(this.articulo);
                console.log(this.listaComentarios)
            } catch (err) {

            }

        }
    }
</script>

<style>

</style>