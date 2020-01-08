<template>
  <v-content>
      <h1>Direcciones  <v-btn color="primary" @click="dialog = true">Añadir</v-btn></h1>
      <v-row>
          <v-col cols="12" sm="4" v-for="direccion in direcciones" :key="direccion.id">
              <v-card  class="mx-auto" max-width="400">
                  <v-card-title>{{direccion.linea1}}</v-card-title>
                  <v-card-text>
                      <p>{{direccion.linea2}}</p>
                      <p>Código Postal: {{direccion.cod_postal}}</p>
                  </v-card-text>
                  <v-card-actions>
                      <v-btn text color="success" @click="seleccionarDireccion(direccion)" v-if="$route.name=='comprar'">
                          Seleccionar
                      </v-btn>
                      <v-btn text color="black" @click="editarDireccion(direccion)">
                          Editar 
                      </v-btn>
                      <v-btn text color="error" @click="eliminarDireccion(direccion)">
                          Eliminar
                      </v-btn>
                  </v-card-actions>
              </v-card>
          </v-col>
          <v-dialog v-model="dialog" max-width="500px">
              <v-form ref="form" v-model="valid">
              <v-card>
                  <v-card-title>{{tituloDialog}}</v-card-title>
                  <v-card-text>
                      <v-text-field v-model="editedDireccion.linea1" :rules="reglas" label="Linea 1" required></v-text-field>
                      <v-text-field v-model="editedDireccion.linea2" label="Linea 2"></v-text-field>
                      <v-text-field v-model="editedDireccion.cod_postal" :rules="reglas" label="Código postal" required></v-text-field>
                  </v-card-text>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="error darken-1" text @click="close">Cancelar</v-btn>
                    <v-btn color="success darken-1" text @click="save">Guardar</v-btn>
                  </v-card-actions>
              </v-card>
              </v-form>
          </v-dialog>
      </v-row>
  </v-content>
</template>

<script>
import axios from "axios"
export default {
    props: {
        selected: {}
    },
    data(){
        return {
            direcciones: [],
            reglas: [v => !!v || "El campo es obligatorio"],
            valid: true,
            dialog: false,
            editedDireccion: {
                id: -1,
                linea1: '',
                linea2: '',
                cod_postal: ''
            },
            defaultDireccion: {
                id: -1,
                linea1: '',
                linea2: '',
                cod_postal: ''
            }
        }
    },
    created(){
        axios.get('/api/direcciones')
            .then(res =>{
                this.direcciones = res.data.data
            }).catch(err =>{
                console.log(err.response)
            })
    },
    methods: {
        seleccionarDireccion(direccion){
            this.$emit('seleccionarDireccion',direccion);
        },
        editarDireccion(direccion){
            this.dialog = true
            this.editedDireccion = Object.assign({}, direccion)
        },
        eliminarDireccion(direccion){
            axios.delete('/api/direcciones/'+ direccion.id)
                .then(res =>{
                    this.direcciones.splice(this.direcciones.indexOf(direccion),1)
                }).catch(err =>{
                    console.log(err.response)
                })
        },
        save(){
            if (this.$refs.form.validate()) {
                if(this.editedDireccion.id === -1){
                    axios.post('/api/direcciones',{
                        linea1: this.editedDireccion.linea1,
                        linea2: this.editedDireccion.linea2,
                        cod_postal: this.editedDireccion.cod_postal
                    }).then(res => {
                        this.direcciones.push(res.data);
                    }).catch(err =>{
                        console.log(err.response)
                    })
                }else{
                    axios.put('/api/direcciones/'+ this.editedDireccion.id,{
                        linea1: this.editedDireccion.linea1,
                        linea2: this.editedDireccion.linea2,
                        cod_postal: this.editedDireccion.cod_postal
                    }).then(res =>{
                        var index =this.direcciones.findIndex(d => d.id == res.data.id)
                        console.log(this.direcciones[index])
                        console.log(res.data)
                        Object.assign(this.direcciones[index], res.data)
                    }).catch(err =>{
                        console.log(err.response)
                    })
                }
                this.close()
            }  
        },
        close(){
            this.dialog = false 
            setTimeout(() => {
                this.editedDireccion = Object.assign({}, this.defaultDireccion) //se vacia el modal
            }, 300)
        }
    },
    watch: {
      dialog (val) {
        val || this.close()
      },
    },
    computed: {
        tituloDialog() {
            return this.editedDireccion.id === -1 ? 'Nueva Dirección' : 'Editar Dirección'
        }
    }

}
</script>

<style>

</style>