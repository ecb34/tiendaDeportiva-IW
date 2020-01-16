<template>
  <v-content>
    <h1>
      <div class="row">
          <div class="col" xs="6">
                Listado Categorias
          </div>
          <div class="col" xs="6">
              <v-btn color="success" @click="addCategoria({ id: '', name: '', padre: ''})">Agregar raiz</v-btn>
          </div>
        </div>
    </h1>
    <v-card>
      <v-card-title>
        <v-text-field v-model="search" append-icon="search" label="Buscar" single-line hide-details></v-text-field>
      </v-card-title>
      <!-- Lista Categorias -->
        <v-treeview
          v-if="!loading"
          :headers="headers"
          :items="categorias"
          :loading="loading"
          :open-on-click=true
          loading-text="Cargando datos..."
          :search="search"
        >
      <template slot="label" slot-scope="{ item }">
        <div class="row">
          <!-- Nombre categoria -->
          <div class="col" xs="9">
                {{item.name}}
          </div>
          <!-- Acciones (Botones) -->
          <div class="col" xs="3">
            <v-btn color="success" @click="addCategoria(item)">
                Agregar rama
            </v-btn>
            <v-btn color="secondary" @click="editCategoria(item)">
                <v-icon class="mr-2">
                  mdi-pen
                </v-icon>
            </v-btn>
            <v-btn color="error" @click="eliminarCategoria(item)">
                <v-icon class="mr-2">
                  delete
                </v-icon>
            </v-btn>
          </div>
        </div>
      </template>
    </v-treeview>
    
    </v-card>
    <v-dialog v-model="dialog" max-width="800px">
        <v-card v-if="edit===-1">
             <registro  :padre="padre" @registrada="categoriaCreada"></registro>
        </v-card>
        <v-card v-else>
             <editar :categoria="categoria" :padre="padre" @editada="categoriaEditada"></editar>
        </v-card>
    </v-dialog>
  </v-content>
</template>

<script>
import axios from "axios"
import Registro from "./templates/categoria/Registro.vue"
import Editar from "./templates/categoria/Editar.vue"
export default {
    components: {
        Registro,
        Editar
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
            categorias: [],
            categoria: {id:0, name: ''},
            padre: { id: '', name: ''},
            edit: -1
        }
    },
    created() {
        axios.get('/api/categorias')
            .then(res =>{
                this.categorias = res.data
                this.loading = false
            }).catch(err =>{
                console.log(err.response)
            })
    },
    methods: {
        close(){
            this.dialog = false   
        },
        addCategoria(categoria){
            this.edit = -1;
            this.padre.id = categoria.id
            this.padre.name = categoria.name
            
            this.dialog = true;
        },
        categoriaCreada(categorias){
            this.dialog = false
            this.categorias = categorias
        },
        editCategoria(categoria) {
            this.edit = 1;
            this.padre.id = categoria.categoria_id

            this.categoria.id = categoria.id
            this.categoria.name = categoria.name
            
            this.dialog = true;
        },
        categoriaEditada(categorias) {
          this.dialog = false;
          this.categorias = categorias;
        },
        eliminarCategoria(categoria){
            axios.delete('/api/categorias/'+categoria.id)
                .then(res =>{
                    this.categorias.splice(this.categorias.indexOf(categoria),1)
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