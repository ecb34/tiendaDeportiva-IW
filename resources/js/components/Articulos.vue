<template>
    <v-container>
        <v-row>
            <v-col v-for="articulo in this.listaArticulos" v-bind:key="articulo.id" cols="12" sm="4">
                <v-card class="mx-auto" max-width="400">
                    <v-img class="orange--text align-end" height="200px" v-bind:src="articulo.imagenes[0].url">
                        <v-card-title>{{articulo.nombre}}</v-card-title>
                    </v-img>
                    <v-card-subtitle class="pb-0">{{articulo.pvp}}</v-card-subtitle>

                    <v-card-text class="text--primary">
                        {{articulo.descripcion}}
                    </v-card-text>

                    <v-card-actions>
                        <v-btn color="orange" :to="`/articulos/${articulo.id}`">
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
        props: ['filtro'],
        name: 'articulos',
        data() {
            return {
                listaArticulos: []
            }
        },
        methods: {
            generoToInt: function (genero) {
                switch (genero) {
                    case "hombre":
                        return 0
                        break;
                    case "Hombre":
                        return 0
                        break;
                    case "mujer":
                        return 1;
                        break;
                    case "Unisex":
                        return 2;
                    case "Mujer":
                        return 1;
                        break;
                    case "unisex":
                        return 2;
                    default:
                        return 2;
                }
            },
            traerArticulos: function (){
                axios.get('/api/articulos')
                .then(response => {
                    this.listaArticulos = response.data.data;
                    console.log('el filtro' + this.$route.params.filtro)
                    console.log(this.listaArticulos)
                    this.listaArticulosFiltrado = this.listaArticulos
                        .filter((articulo) => {
                            if (articulo.nombre.includes(this.$route.params.filtro))
                                return true
                            if (articulo.genero == generoToInt(this.$route.params.filtro))
                                return true
                            if (articulo.categoria.nombre === this.$route.params.filtro)
                                return true
                            if (articulo.marca === this.$route.params.filtro)
                                return true
                            return false
                        })
                    console.log(this.listaArticulosFiltrado)
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        },
        watch: {
            // whenever question changes, this function will run
            filtro: function () {
                this.traerArticulos();
                console.log('respuesta') 
            }
        },
        mounted() {
           this.traerArticulos();
        }

    }
</script>

<style>

</style>