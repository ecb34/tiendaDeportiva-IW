<template>
    <v-container>
        <h1>Cesta</h1>
<<<<<<< HEAD
        <h1 align="center" v-if="listaArticulos.length < 1">No hay articulos en la cesta</h1>
        <v-row align="center" justify="center" v-if="listaArticulos.length > 0">
=======
        <h1 v-if="listaArticulos.length == 0" justify-center>No hay articulos</h1>
        <div v-else>
        <v-row align="center" justify="center" >
>>>>>>> master
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
                                <th class="text-left">Subtotal</th>
                                <th class="text-left">Eliminar</th>
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
                                    <v-icon size="25" grey @click="restarArticuloToCarrito(item.articulo)">mdi-minus
                                    </v-icon>
                                    {{item.cantidad}}
                                    <v-icon size="25" grey @click="addArticuloToCarrito(item.articulo)">mdi-plus
                                    </v-icon>
                                </td>
                                <td width="20%">{{item.importe}}€</td>
                                <td>
                                    <v-btn color="primary" @click="borrarArticulo(item.articulo)">
                                        <v-icon :color="blue">mdi-delete</v-icon>
                                    </v-btn>
                                </td>
                                
                            </tr>
                        </tbody>
                    </template>
                </v-simple-table>
            </div>
        </v-row>
        <v-row v-if="listaArticulos.length > 0">
            <v-col cols="9"></v-col>
            <v-col cols="3">
                <b>TOTAL: {{total}}€</b>
                <v-btn color="primary" @click="tramitarPedido">Tramitar Pedido</v-btn>
            </v-col>
        </v-row>
        </div>
    </v-container>
</template>

<script>
    import axios from "axios";
    export default {
        name: 'Carrito',
        data() {
            return {
                listaArticulos: [],
                total: -1
            }
        },
        mounted() {
            this.traerCarrito()
        },
        methods: {
            addArticuloToCarrito(articulo) {
                axios.post('/api/user/carrito', {
                    'articulo_id': articulo.id,
                    'pvp': articulo.pvp,
                    'cantidad': 1
                }).then(res => {
                    var importe = parseFloat(res.data.importe).toFixed(2)
                    var index = this.listaArticulos.findIndex(a => a.articulo_id == articulo.id)
                    this.listaArticulos[index].importe = importe
                    this.listaArticulos[index].cantidad++
                    this.total = parseFloat(this.total)
                    this.total += articulo.pvp
                    this.total = this.total.toFixed(2)
                }).catch(err => {
                    console.log(err.response);
                })
            },
            restarArticuloToCarrito(articulo) {
                axios.post('/api/user/carrito/restar', {
                    'articulo_id': articulo.id,
                    'pvp': articulo.pvp,
                    'cantidad': 1
                }).then(res => {
                    var index = this.listaArticulos.findIndex(a => a.articulo_id == articulo.id)
                    if (res.data.importe) {
                        var importe = parseFloat(res.data.importe).toFixed(2)
                        this.listaArticulos[index].importe = importe
                        this.listaArticulos[index].cantidad--

                    } else {
                        this.listaArticulos.splice(index, 1)
                    }
                    this.total -= articulo.pvp
                    this.total = this.total.toFixed(2)
                }).catch(err => {
                    console.log(err.response);
                })
            },
            traerCarrito() {
                axios.get('/api/user/carrito')
                    .then(response => {
                        this.listaArticulos = response.data.data.lineas
                        this.total = parseFloat(this.listaArticulos.reduce((res, art) => {
                            return res + art.importe
                        }, 0)).toFixed(2)
                    })
                    .catch(function (error) {
                        console.log(error.response);
                    });
            },
            tramitarPedido() {
                this.$store.commit('setPrecioTotal', this.total)
                this.$router.push({ name: 'comprar' })
            },
            borrarArticulo(articulo) {
                axios.delete('/api/user/carrito', {
                    'articulo_id': articulo.id
                }).then(res => {
                    /*var index = this.listaArticulos.findIndex(a => a.articulo_id == articulo.id)
                    if (res.data.importe) {
                        var importe = parseFloat(res.data.importe).toFixed(2)
                        this.listaArticulos[index].importe = importe
                        this.listaArticulos[index].cantidad--

                    } else {
                        this.listaArticulos.splice(index, 1)
                    }
                    this.total -= articulo.pvp
                    this.total = this.total.toFixed(2)*/
                }).catch(err => {
                    console.log(err.response);
                })
            }
        }
    }
    
</script>

<style>

</style>