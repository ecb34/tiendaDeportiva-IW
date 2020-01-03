<template>
    <v-container>
        <h1>Lista De Deseos</h1>
        <v-card>
            <v-card-title>
            <v-text-field
                v-model="search"
                append-icon="search"
                label="Buscar"
                single-line
                hide-details
            ></v-text-field>
            </v-card-title>
            <v-data-table
                :headers="headers"
                :items="listaDeseos"
                :loading="loading" loading-text="Cargando datos..."
                :search="search"
            >
            <template v-slot:item.action="{ item }">
                <v-btn color="success" @click="addCarrito(item.id)">
                    <v-icon class="mr-2">
                        mdi-cart
                    </v-icon>
                </v-btn>
                <v-btn color="primary" :to="'articulos/'+item.id">
                    <v-icon class="mr-2">
                        mdi-eye
                    </v-icon>
                </v-btn>
                <v-btn color="error" @click="eliminarArticulo(item)">
                    <v-icon class="mr-2">
                        delete
                    </v-icon>
                </v-btn>
            </template>
            </v-data-table>
        </v-card>
    </v-container>
</template>

<script>
import axios from "axios"
export default {
    data: function(){
        return {
            loading: true,
            search: '',
            headers: [
                {text: 'Código', value: 'codigo'},
                {text: 'Nombre', value: 'nombre'},
                {text: 'Precio', value: 'pvp'},
                {text: 'Valoracion', value: 'valoracion'},
                {text: 'Añadido el', value: 'lista_deseo.created_at'},
                {text: 'Acciones', value: 'action', sortable: false }
            ],
            listaDeseos: []
        }
    },
    mounted(){
        axios.get('/api/user/listadeseos')
                .then(res =>{
                    this.listaDeseos = res.data
                    this.loading = false
                }).catch(err => {
                    console.log(err.response)
                })
    },
    methods: {
        addCarrito(id){

        },
        eliminarArticulo(articulo){
            axios.delete('/api/user/listadeseos/' + articulo.id)
                .then(res =>{
                    this.listaDeseos.splice(this.listaDeseos.indexOf(articulo), 1)
                }).catch(err =>{
                    console.log(err.response)
                })
        }
    }
}
</script>

<style>

</style>