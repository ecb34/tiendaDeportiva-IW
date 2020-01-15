<template>
<v-container fluid style="width: 30%">
    <v-row justify="center">
        <v-expansion-panels popout>
            <v-expansion-panel
            v-for="pedido in pedidos"
            :key="pedido.id"
            >
                <v-expansion-panel-header>
                    Numero: {{pedido.id}}
                    <v-spacer></v-spacer>
                    {{pedido.estado}} 
                </v-expansion-panel-header>
                <v-expansion-panel-content>
                    <v-simple-table fixed-header height="300px">
                        <template v-slot:default>
                            <thead>
                                <tr>
                                    <th scope="col">Articulo</th>
                                    <th scope="col">PVP</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Importe</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="articulo in pedido.articulos" :key="articulo.id">
                                    <td>{{articulo.nombre}}</td>
                                    <td>{{articulo.pvp}}</td>
                                    <td>{{articulo.cantidad}}</td>
                                    <td>{{parseFloat(articulo.pvp * articulo.cantidad).toFixed(2)}}€</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="title">Total</td>
                                    <td class="title">{{pedido.total_importe}}€</td>
                                </tr>
                            </tbody>
                        </template>
                    </v-simple-table>
                </v-expansion-panel-content>
            </v-expansion-panel>
        </v-expansion-panels>
    </v-row>
  
  </v-container>
</template>

<script>
import axios from "axios";
export default {
    name: 'Pedidos',
    data: () => ({
        pedidos: [],
        pos: 0
    }),
    created(){
        axios
        .get('/api/user/pedidos')
        .then((lista) => {
            lista.data.forEach((pedido) => {
                var total_importe = parseFloat(pedido.articulos.reduce((res,a)=> {return res + (a.pvp * a.cantidad)}, 0)).toFixed(2)
                this.pedidos.push({
                pos: this.pos++, 
                id: pedido.id,
                estado: pedido.estado,
                fecha: pedido.fecha,
                total_importe : total_importe,
                articulos: pedido.articulos
                })
            });
        })

    },
}
</script>
<style>
</style>