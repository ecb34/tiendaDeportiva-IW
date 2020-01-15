<template>
  <v-content>
    <h1>
      Listado Usuarios
      <v-btn @click="addUsuario()" color="primary">Añadir Usuario</v-btn>
    </h1>
    <v-card>
      <v-card-title>
        <v-text-field v-model="search" append-icon="search" label="Buscar" single-line hide-details></v-text-field>
      </v-card-title>
      <v-data-table
        :headers="headers"
        :items="usuarios"
        :loading="loading"
        loading-text="Cargando datos..."
        :search="search"
      >
        <template v-slot:item.action="{ item }">
          <v-btn color="error" @click="eliminarUsuario(item)">
            <v-icon class="mr-2">delete</v-icon>
          </v-btn>
        </template>
      </v-data-table>
    </v-card>
    <v-dialog v-model="dialog" max-width="800px">
        <v-card>
             <registro @registrado="usuarioRegistrado"></registro>
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
                {text: 'Email', value: 'email'},
                {text: 'Nombre', value: 'nombre'},
                {text: 'Apellidos', value: 'apellido'},
                {text: 'Rol', value: 'rol'},
                {text: 'Fecha Nacimiento', value: 'fecha_nacimiento'},
                {text: 'Acciones', value: 'action', sortable: false}
            ],
            usuarios: []
        }
    },
    created() {
        axios.get('/api/users')
            .then(res =>{
                this.usuarios = res.data.data
                this.loading = false
            }).catch(err =>{
                console.log(err.response)
            })
    },
    methods: {
        addUsuario(){
            this.dialog = true;
        },
        close(){
            this.dialog = false   
        },
        usuarioRegistrado(usuario){
            this.dialog = false
            this.usuarios.push(usuario)
        },
        eliminarUsuario(usuario){
            axios.delete('/api/users/'+usuario.id)
                .then(res =>{
                    this.usuarios.splice(this.usuarios.indexOf(usuario),1)
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