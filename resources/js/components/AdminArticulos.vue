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
          <v-btn color="secondary" :to="`/editarArticulo/${item.id}`">
              <v-icon class="mr-2">
                mdi-pen
              </v-icon>
          </v-btn>
          <v-btn color="error" @click="eliminarArticulo(item)">
              <v-icon class="mr-2">
                delete
              </v-icon>
          </v-btn>
          <v-btn color="primary" @click="mostrarComentarios(item), dialog='true'">
              <v-icon class="mr-2">
                mdi-comment-outline
              </v-icon>
          </v-btn>
        </template>
        </v-data-table>
        <div class="text-center pt-2">
          <v-pagination v-model="page" :length="pageCount"></v-pagination>
        </div>
        
        <v-dialog v-model="dialog" max-width="1300">
            <v-card>
                <v-card-title class="headline">Manejar comentarios visibles</v-card-title>
                <v-card-text>
                    <v-data-table
                        :headers="headersComentarios"
                        :items="listaComentarios"
                       
                        class="elevation-1"
                        hide-default-footer
                        :loading="loading" loading-text="Cargando datos..."
                    >
                    <template v-slot:item.action="{ item }">
                        <v-btn color="error" @click="deleteComment(item)">
                            <v-icon class="mr-2">
                                delete
                            </v-icon>
                        </v-btn>
                        <v-btn v-if="item.bloqueado==true || item.bloqueado == 1" color="secondary" @click="bloquearComment(item)">
                            <v-icon class="mr-2">
                                mdi-comment-remove-outline
                            </v-icon>
                        </v-btn>
                        <v-btn v-else color="secondary" @click="bloquearComment(item)">
                            <v-icon class="mr-2">
                                mdi-comment-check-outline
                            </v-icon>
                        </v-btn>
                    </template>
                    </v-data-table>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="green darken-1" text @click="dialog = false">Cerrar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
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
        listaComentarios: [],
        dialog: false,
        headersComentarios: [
            {text:'Comentarios', value:'texto'},
            {text:'Actions', value:'action'},

        ],
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
        mostrarComentarios(articulo){
          this.listaComentarios = []
            axios.get('/api/articulo/' + articulo.id + '/comentarios')
                .then(res =>{
                    res.data.forEach(mensaje => {
                        this.listaComentarios.push({
                            id: mensaje.id,
                            texto: mensaje.texto,
                            bloqueado: mensaje.bloqueado
                        })
                    });
                }).catch(err =>{
                    console.log(err.response)
                })
        },
        deleteComment(comentario){
            axios.delete('/api/articulo/comentarios/'+comentario.id)
                    .then(res =>{
                    this.mostrar_snackbar = true
                    this.snackbar = 'Comentario borrado'
                    this.listaComentarios.splice(this.listaComentarios.indexOf(comentario), 1)
                    this.articulo.valoracion = res.data

                }).catch(err =>{
                    console.log(err.response);
                })
            },
        bloquearComment(comentario){
            axios.put('/api/articulo/comentarios/'+comentario.id+'/bloquear')
                    .then(res =>{
                    var newvalue = {
                      id: res.data.id,
                      texto: res.data.texto,
                      bloqueado: res.data.bloqueado
                    }
                    this.listaComentarios.splice(this.listaComentarios.findIndex(c => c.id == comentario.id), 1, newvalue)
                    this.mostrar_snackbar = true
                    this.snackbar = 'Estado comentario cambiado'
                    console.log(this.snackbar)
                }).catch(err =>{
                    console.log(err.response);
                })
            },
    },
  }
</script>