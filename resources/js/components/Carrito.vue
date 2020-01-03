<template>
    <v-container>


        <h1>Cesta</h1>
        <v-row align="center" justify="center">
            <div class="elevation-1">
                <v-simple-table>
                    <template v-slot:default>
                        <thead>
                            <tr>
                                <th class="text-left"></th>
                                <th class="text-left">Nombre</th>
                                <th class="text-left">Descripcion</th>
                                <th class="text-left">Precio</th>
                                <th class="text-left">Cantidad</th>
                                <th class="text-left">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in listaArticulos" :key="item.id">
                                <td width="20%">
                                    <v-img v-bind:src="item.imagenes[0].url" max-width="150" max-height="150">
                                    </v-img>
                                </td>
                                <td width="10%">{{ item.nombre }}</td>
                                <td class="" width="20%">{{ item.descripcion }}</td>
                                <td width="20%">{{ item.pvp }}</td>
                                <td width="10%">Cantidad</td>
                                <td width="20%">Total</td>
                            </tr>
                        </tbody>
                    </template>
                </v-simple-table>
            </div>
        </v-row>






    </v-container>
</template>

<script>
    import axios from "axios";
    export default {
        name: 'Carrito',
        data() {
            return {
                listaArticulos: [],
                listaArticulosFiltrado: [],
                headers: [
                    { text: 'I', value: 'imagenes[0].url', align: 'centre' },
                    { text: 'Nombre', value: 'nombre', align: 'centre' },
                    { text: 'Precio', value: 'pvp', align: 'centre' },
                    { text: 'Cantidad', value: 'cantidad', align: 'centre' },
                    { text: 'Total', value: 'total', align: 'centre' }
                ],

            }
        },
        ready: function () {

        },
        mounted() {
            

                axios.get('/api/users')
                .then(response => {
                    console.log(response.data.data)
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
                axios.get('/api/articulos')
                .then(response => {
                    this.listaArticulos = response.data.data;
                    console.log(this.listaArticulos)
                    this.listaArticulosFiltrado = this.listaArticulos
                        .filter((articulo) => {
                            return articulo.categoria.nombre === "Hombre"
                        })
                    console.log(this.listaArticulosFiltrado)
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        methods: {

        }
    }
</script>

<style>

</style>