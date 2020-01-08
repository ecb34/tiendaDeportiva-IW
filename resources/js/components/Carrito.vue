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
                            <tr v-for="item in listaArticulos" :key="item.articulo.id">
                                <td width="20%">
                                    <v-img v-bind:src="item.articulo.imagenes[0].url" max-width="150" max-height="150">
                                    </v-img>
                                </td>
                                <td width="10%">{{ item.articulo.nombre }}</td>
                                <td class="" width="20%">{{ item.articulo.descripcion }}</td>
                                <td width="20%">{{ item.articulo.pvp }} €</td>
                                <td width="20%">
                                    <v-icon size="25" grey @click="restarArticuloToCarrito(item.articulo)">mdi-minus</v-icon>
                                    {{item.cantidad}}
                                    <v-icon size="25" grey @click="addArticuloToCarrito(item.articulo)">mdi-plus</v-icon>
                                </td>
                                <td width="20%">{{item.importe}}€</td>
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
            this.traerCarrito()
        },
        methods: {
            addArticuloToCarrito(articulo) {
                axios.post('/api/user/carrito',{
                    'articulo_id': articulo.id,
                    'pvp': articulo.pvp,
                    'cantidad': 1
                }).then(res =>{
                    var index = this.listaArticulos.findIndex(a => a.articulo_id == articulo.id)
                    this.listaArticulos[index].importe = parseFloat(res.data.importe).toFixed(2)
                    this.listaArticulos[index].cantidad++
                }).catch(err =>{
                    console.log(err.response);
                })
            },
            restarArticuloToCarrito(articulo) {
                axios.post('/api/user/carrito/restar',{
                    'articulo_id': articulo.id,
                    'pvp': articulo.pvp,
                    'cantidad': 1
                }).then(res =>{
                    var index = this.listaArticulos.findIndex(a => a.articulo_id == articulo.id)
                    if(res.data.importe){
                        this.listaArticulos[index].importe = parseFloat(res.data.importe).toFixed(2)
                        this.listaArticulos[index].cantidad--
                    }else{
                        this.listaArticulos.splice(index,1)
                    }
                    
                }).catch(err =>{
                    console.log(err.response);
                })
            },
            traerCarrito(){
                axios.get('/api/user/carrito')
                .then(response => {
                    this.listaArticulos = response.data.data.lineas
                })
                .catch(function (error) {
                    console.log(error.response);
                });
            }
        }
    }
</script>

<style>

</style>