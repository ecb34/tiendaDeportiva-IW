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
                listaArticulos: []

            }
        },
        ready: function () {

        },
        mounted() {
            axios.get('/api/user/carrito')
                .then(response => {
                   
                    console.log(response.data)
                   
                })
                .catch(function (error) {
                    console.log(error.response);
                });
        },
        methods: {

        }
    }
</script>

<style>

</style>