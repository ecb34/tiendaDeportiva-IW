<template>
     <v-card>
        <v-container fluid>
            <v-form ref="form" v-model="valid">
                <v-row>
                    <v-col>
                    <v-card-text>
                        <v-text-field v-model="nombre" :rules="[rules.required, rules.counter]" label="Nombre del articulo*" required></v-text-field>
                    </v-card-text>
                    </v-col>
                    <v-col>
                    <v-card-text>
                        <v-text-field v-model="precio" :rules="[rules.required, rules.pvp]" label="€*"></v-text-field>
                    </v-card-text>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                    <v-card-text>
                        <v-textarea v-model="descripcion" :rules="[rules.counterdesc]" color="teal">
                        <template v-slot:label>
                            <div>
                            Descripción <small>(optional)</small>
                            </div>
                        </template>
                        </v-textarea>
                    </v-card-text>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col>
                        <v-card-text>
                        <v-autocomplete
                            ref="categoria"
                            v-model="categoria"
                            :rules="[() => !!categoria || 'Dato requerido']"
                            :items="categorias"
                            item-text="name"
                            item-value="id"
                            label="Categorias"
                            placeholder="Seleccionar categoria"
                            required
                        ></v-autocomplete>
                        </v-card-text>
                    </v-col>
                    <v-col>
                        <v-card-text>
                        <v-autocomplete
                            ref="marca"
                            v-model="marca"
                            :rules="[() => !!marca || 'Dato requerido']"
                            :items="marcas"
                            item-text="nombre"
                            item-value="id"
                            label="Marca"
                            placeholder="Seleccionar marca"
                            required
                        ></v-autocomplete>
                        </v-card-text>
                    </v-col>
                        </v-row>
                        <v-row>
                    <v-col>
                        <v-card-text>
                          <v-autocomplete
                          ref="genero"
                          v-model="genero"
                          :rules="[() => !!genero || 'Dato requerido']"
                          :items="generos"
                          item-text="nombre"
                          item-value="id"
                          label="Genero"
                          placeholder="Seleccionar genero"
                          required
                          ></v-autocomplete>
                        </v-card-text>
                    </v-col>
                    <v-col>
                    </v-col>
                </v-row>
                <v-card>
                <v-container fluid>
                    <v-row dense>
                        <v-col>
                        <v-card>
                            <v-img
                            src="https://cdn.vuetifyjs.com/images/parallax/material2.jpg"
                            class="white--text align-end"
                            gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                            height="200px"
                            >
                            <v-card-title>Mis imagenes</v-card-title>
                            </v-img>
                            
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn icon>
                                    <v-icon>mdi-heart</v-icon>
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                        </v-col>
                    </v-row>
                </v-container>
                <div align="right">
                    <v-btn :disabled="!valid" color="success" class="mr-4" @click="validar">Crear articulo</v-btn>
                    <br><br>
                </div>
                </v-card>
            </v-form>
        </v-container>
     </v-card>
</template>

<script>
export default {
    data () {
      return {
        valid: true,
        nombre: '',
        precio: '',
        generos: [{nombre: "Unisex",  id: "2"}, 
        {nombre: "Hombre",  id: "0"}, 
        {nombre: "Mujer",  id: "1"}],
        genero: null,
        categorias: [],
        categoria: null,
        descripcion: '',
        marcas: [],
        marca: null,
        rules: {
          required: value => !!value || 'Campo requerido.',
          counter: value => value.length <= 20 || 'Maximo 20 caracteres',
          counterdesc: value => value.length <= 150 || 'Maximo 200 caracteres',
          pvp: value => {
            const pattern = /^(([0-9]*)|(([0-9]*)\.([0-9]*)))$/
            return pattern.test(value) || 'Precio invalido.'
          },
        },
        selectedFile: null,
        errorServer: '',
        snackbar: false,
      }
    },
    mounted(){
    axios.get('/api/categorias')
        .then(response => {
          this.categorias = response.data;
          console.log(response.data)
        }).catch(err => {
          console.log(err)
        })

    axios.get('/api/marcas')
        .then(response => {
          this.marcas = response.data;
          console.log(response.data)
        }).catch(err => {
          console.log(err)
        })
    
  },
    methods: {
        selectedImage(event) {
            this.selectedFile=event.target.files[0]
        },
        validar() {
            if (this.$refs.form.validate()) {
                //llamada a signup
                axios.put("/api/articulos/validarArticulo", {
                  nombre: this.nombre,
                  pvp: this.precio,
                  descripcion: this.descripcion,
                  marca_id: this.marca.id,
                  categoria_id: this.categoria.id,
                }).then((res =>{
                  this.$router.push({ name: 'nuevo', params: { mostrar_snackbar: true }})
                })).catch(err =>{
                  console.log(err.response)
                  this.errorServer = 'Error???'
                  this.snackbar = true;
                })
            }
        },
    },
  }
</script>
