<template>
    <v-container>
            <h1>Listado Marcas <v-btn @click="addMarca()" color="primary">Añadir Marca</v-btn></h1>
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
                :items="marcas"
                :loading="loading" loading-text="Cargando datos..."
                :search="search"
            >
            <template v-slot:item.action="{ item }">
                <v-btn color="secondary" @click="editarMarca(item)">
                    <v-icon class="mr-2">
                        mdi-pen
                    </v-icon>
                </v-btn>
                <v-btn color="error" @click="eliminarMarca(item)">
                    <v-icon class="mr-2">
                        delete
                    </v-icon>
                </v-btn>
            </template>
            </v-data-table>
        </v-card>
        <v-dialog v-model="dialog" max-width="500px">
            <v-form ref="form" v-model="valid">
                <v-card>
                    <v-card-title>{{tituloDialog}}</v-card-title>
                    <v-card-text>
                        <v-text-field v-model="editedMarca.nombre" :rules="reglas" label="Nombre*"></v-text-field>
                        <v-text-field v-model="editedMarca.empresa" :rules="reglas" label="Empresa*"></v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="error darken-1" text @click="close">Cancelar</v-btn>
                        <v-btn color="success darken-1" text @click="save">Guardar</v-btn>
                    </v-card-actions>
                </v-card>
            </v-form>
        </v-dialog>
    </v-container>
</template>

<script>
import axios from "axios"
export default {
    data: function(){
        return {
            loading: true,
            valid: true,
            reglas: [v => !!v || "El campo es obligatorio"],
            dialog: false,
            editedMarca: {
                id: -1,
                nombre: "",
                empresa: "",
                logo: ""
            },
            defaultMarca: {
                id: -1,
                nombre: "",
                empresa: "",
                logo: ""
            },
            search: '',
            headers: [
                {text: 'ID', value: 'id'},
                {text: 'Nombre', value: 'nombre'},
                {text: 'Empresa', value: 'empresa'},
                {text: 'Acciones', value: 'action', sortable: false}
            ],
            marcas: []
        }
    },
    created() {
        axios.get('/api/marcas').then(res => {
            this.marcas = res.data
            this.loading = false
        }).catch(err =>{
            console.log(err.response)
        })
    },
    methods: {
        addMarca(){
            this.dialog = true;
            this.editedMarca = Object.assign({}, defaultMarca)
        },
        editarMarca(marca){
            this.dialog = true;
            this.editedMarca = Object.assign({}, marca)
        },
        eliminarMarca(marca){
            axios.delete('/api/marcas/'+marca.id)
                .then(res =>{
                    this.marcas.splice(this.marcas.indexOf(marca),1)
                }).catch(err =>{
                    console.log(err.response)
                })
        },
        save(){
            if (this.$refs.form.validate()) {
                if(this.editedMarca.id === -1){
                    axios.post('/api/marcas', {
                        nombre: this.editedMarca.nombre,
                        empresa: this.editedMarca.empresa,
                        logo: this.editedMarca.logo
                    }).then(res =>{
                        this.marcas.push(res.data)
                    }).catch(err =>{
                        console.log(err.response)
                    })
                }else{
                    axios.put('/api/marcas/'+ this.editedMarca.id,{
                        nombre: this.editedMarca.nombre,
                        empresa: this.editedMarca.empresa,
                        logo: this.editedMarca.logo
                    }).then(res =>{
                        console.log(res)
                        var index = this.marcas.findIndex(m => m.id == res.data.id)
                        Object.assign(this.marcas[index], res.data)
                    }).catch(err => {
                        console.log(err.response)
                    })
                }
                this.close()
            }
        },
        close(){
            this.dialog = false 
            setTimeout(() => {
                this.editedMarca = Object.assign({}, this.defaultMarca) //se vacia el modal
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
            return this.editedMarca.id === -1 ? 'Nueva Marca' : 'Editar Marca'
        }
    }

}
</script>

<style>

</style>