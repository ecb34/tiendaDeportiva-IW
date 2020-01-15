<template>
  <v-content>
    <h1>
      Listado Categorias
    </h1>
    <v-card>
      <v-card-title>
        <v-text-field v-model="search" append-icon="search" label="Buscar" single-line hide-details></v-text-field>
      </v-card-title>
      <v-treeview
        v-if="!loading"
        :headers="headers"
        :items="categorias"
        :loading="loading"
        :open-on-click=true
        loading-text="Cargando datos..."
        :search="search"
      >
      <!-- Lista Categorias -->
      
    <template slot="label" slot-scope="{ item }">
      <span>{{item.name}}  </span>
      <v-btn @click="seleccionCategoria(item)">seleccionar</v-btn>
    </template>
    </v-treeview>
    
    </v-card>
    <v-dialog v-model="dialog" max-width="800px">
        <v-card>
             <!-- <registro @registrado="usuarioRegistrado"></registro> -->
        </v-card>
    </v-dialog>
  </v-content>
</template>

<script>
import axios from "axios"
import Registro from "./Registro"
export default {
    components: {
        Registro
    },
    data: function(){
        return {
            loading: true,
            dialog: false,
            search: '',
            headers: [
                {text: 'ID', value: 'id'},
                {text: 'Nombre', value: 'name'},
                {text: 'Acciones', value: 'action', sortable: false}
            ],
            categorias: []
        }
    },
    created() {
        axios.get('/api/categorias')
            .then(res =>{
                this.categorias = res.data
                console.log(this.categorias)
                this.loading = false
            }).catch(err =>{
                console.log(err.response)
            })
    },
    methods: {
        seleccionCategoria(categoria){
            console.log(categoria)
        },
        addCategoria(categoria){
            this.dialog = true;
        },
        close(){
            this.dialog = false   
        },
        categoriaCreada(categoria){
            this.dialog = false
            this.categorias.push(categorias)
        },
        eliminarCategoria(categoria){
            axios.delete('/api/categorias/'+categoria.id)
                .then(res =>{
                    this.categorias.splice(this.categorias.indexOf(categorias),1)
                }).catch(err =>{
                    console.log(err.response)
                })
        }
    },
    watch: {
      dialog (val) {
        val || this.close()
      },
    }
};
</script>

<style>
</style>