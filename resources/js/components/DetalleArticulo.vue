<template>
    <v-container fluid>
        <v-breadcrumbs :items="items" divider=">"></v-breadcrumbs>
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
                    <p class="body-2">Total: 32,56€</p>
                </v-row>
                <v-row justify="center">
                    <v-rating v-model="articulo.valoracion" justify-center></v-rating>
                </v-row>
                <v-row>
                    <v-btn class="mr-4" color="green draken-4">Comprar</v-btn>
                    <v-btn color="primary">Añadir al carrito</v-btn>
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
                            <template v-slot:badge>10</template>

                        </v-badge>

                    </v-tab>

                    <v-tab-item>
                        <v-card flat>
                            <v-card-text>Contents for Item 1 go here</v-card-text>
                        </v-card>
                    </v-tab-item>
                    <v-tab-item>
                        <v-card flat>
                            <v-card-text>Contents for Item 2 go here</v-card-text>

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

    </v-container>
</template>

<script>
    import axios from "axios";
    export default {
        name: 'articulo',
        data() {
            return {
                items: [
                    {
                        text: 'Dashboard',
                        disabled: false,
                        href: 'breadcrumbs_dashboard',
                    },
                    {
                        text: 'Link 1',
                        disabled: false,
                        href: 'breadcrumbs_link_1',
                    },
                    {
                        text: 'Link 2',
                        disabled: true,
                        href: 'breadcrumbs_link_2',
                    },
                ],
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
                imagen: ''
            }
        },
        methods: {
            cambiarImagen: function (i) {
                this.imagen = this.listaImagenes[i].url;
                console.log('hola');
            }



        },
        async created() {
            try {
                //lista de articulos 
                const res = await axios.get('/api/articulos');
                this.listaArticulos = res.data.data;

                //articulo con ID especifica, recuperamos las imagenes del articulo
                const res2 = await axios.get('/api/articulos/' + this.$route.params.id);
                this.articulo = res2.data.data;
                this.listaImagenes = this.articulo.imagenes;
                this.imagen = this.listaImagenes[0].url;

            } catch (err) {

            }

        }
        /*
        mounted() {
            axios.get('api/articulos')
                .then(response => {
                    this.listaArticulos = response.data.articulos;
                    console.log('lista de articulos:'+this.listaArticulos);
                }).catch(error => {
                })
        }*/
    }
</script>

<style>

</style>