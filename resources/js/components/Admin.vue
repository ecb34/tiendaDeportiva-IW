<template>
  <div>
    <v-container grid-list-xl text-xs-center>
        <div align="right">
            <v-btn color="primary" dark class="mb-2" to="/NuevoArticulo">
                Añadir articulo
            </v-btn>
        </div>
        <v-card-title>
          Lista de articulos
          <v-spacer></v-spacer>
          <v-text-field
            v-model="search"
            append-icon="search"
            label="Search"
            single-line
            hide-details
          ></v-text-field>
        </v-card-title>
        <v-data-table
          :headers="headers"
          :items="listaArticulos"
          :page.sync="page"
          :items-per-page="itemsPerPage"
          hide-default-footer
          :loading="loading" loading-text="Cargando datos..."
          class="elevation-1"
          :search="search"
          @page-count="pageCount = $event"
        >
        <template v-slot:item.action="{ item }">
          <v-btn color="secondary" @click="editarArticulo(item)">
              <v-icon class="mr-2">
                mdi-pen
              </v-icon>
          </v-btn>
          <v-btn color="error" :to="'Admin/'+item.id">
              <v-icon class="mr-2">
                delete
              </v-icon>
          </v-btn>
        </template>
        </v-data-table>
        <div class="text-center pt-2">
          <v-pagination v-model="page" :length="pageCount"></v-pagination>
        </div>
    </v-container>
    <v-snackbar v-model="mostrar_snackbar" color="success" top class="title">
        {{snackbar}}
    </v-snackbar>
  </div>
</template>

<script>
  export default {
    props:{
      snackbar: {
        type: String
      }
    },
    data () {
      return {
        search: '',
        loading: true,
        page: 1,
        pageCount: 0,
        itemsPerPage: 10,
        headers: [
          { text: 'Codigo', align: 'left', sortable: false, value: 'codigo' },
          { text: 'Nombre', value: 'nombre' },
          { text: 'Precio', value: 'pvp' },
          { text: 'Actions', value: 'action', sortable: false },
        ],
        listaArticulos: [],
      }
    },
    mounted(){
        axios.get('/api/articulos')
                .then(res =>{
                    this.loading = true
                    this.listaArticulos = res.data
                    this.loading = false
                    console.log(this.listaArticulos)
                }).catch(err => {
                    console.log(err.response)
                })
    },
    computed: {
      mostrar_snackbar: {
        get(){
          return !!this.snackbar
        },
        set(value){
          return value
        }  
      }
    },
    methods: {
        eliminarArticulo(articulo){
            axios.delete('/api/articulos/' + articulo.id)
                .then(res =>{
                    this.listaArticulos.splice(this.listaArticulos.indexOf(articulo), 1)
                }).catch(err =>{
                    console.log(err.response)
                })
        },
        /*editarArticulo(articulo){
            axios.update('/api/articulos/update' + articulo.id)
                .then(res =>{
                  //pasar los campos modificados
                }).catch(err =>{
                    console.log(err.response)
                })
        }*/
    },
  }
</script>