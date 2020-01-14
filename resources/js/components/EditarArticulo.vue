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
                    <v-col>
                      <v-card-text>
                        <v-text-field v-model="codigo" :rules="[rules.codigoMax, rules.codigoRul]" label="Codigo del articulo*"></v-text-field>
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
                <br>
                <v-file-input
                  v-model="files"
                  color="deep-purple accent-4"
                  counter
                  :rules="[
                    rules.maxTam,
                    rules.requiredcod,
                    rules.fileRule,
                  ]"
                  label="File input"
                  multiple
                  placeholder="Select your files"
                  prepend-icon="mdi-paperclip"
                  outlined
                  :show-size="1000"
                >
                  <template v-slot:selection="{ index, text }">
                    <v-chip
                      v-if="index < 2"
                      color="deep-purple accent-4"
                      dark
                      label
                      small
                    >
                      {{ text }}
                    </v-chip>

                    <span
                      v-else-if="index === 2"
                      class="overline grey--text text--darken-3 mx-2"
                    >
                      +{{ files.length - 2 }} File(s)
                    </span>
                  </template>
                </v-file-input>
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
                    <v-btn :disabled="!valid" color="success" class="mr-4" @click="validar">Guardar cambios</v-btn>
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
        codigo: '',
        valoracion: '',
        generos: [{nombre: 'Unisex',  id: '2'}, 
        {nombre: 'Hombre',  id: '0'}, 
        {nombre: 'Mujer',  id: '1'}],
        genero: null,
        categorias: [],
        categoria: null,
        descripcion: '',
        marcas: [],
        marca: null,
        rules: {
          maxTam: value => !value || value.size < 2000000 || 'Avatar size should be less than 2 MB!',
          requiredcod: value=>  !!value && value!=0 || 'Campo requerido.',
          required: value => !!value || 'Campo requerido.',
          counter: value => value.length <= 30 || 'Maximo 30 caracteres',
          codigoMax: value => value.length == 8 || 'Debe contener exactamente 8 digitos',
          codigoRul: value => {
            const pattern = /^(([0-9]*))$/
            return pattern.test(value) || 'Codigo invalido, solo se permiten digitos.'
          },
          fileRule: value =>{
            const pattern = /^(https?:\/\/)?www\.([\da-z\.-]+)\.([a-z\.]{2,6})\/[\w \.-]+?\.pdf$/
            return pattern.test(value) || 'Formato incorrecto.'
          },
          counterdesc: value => value.length <= 150 || 'Maximo 200 caracteres',
          pvp: value => {
            const pattern = /^(([0-9]*)|(([0-9]*)\.([0-9]*)))$/
            return pattern.test(value) || 'Precio invalido.'
          },
          reglasPvp: v => v >= 0 || 'Max no puede ser negativo',
        },
        tab: null,
        selectedFile: null,
        files: [], 
        errorServer: '',
        snackbar: false,
        error: '',
      }
    },
    mounted (){
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
    async created(){

      try{
        var res = await axios.get("/api/articulos/" + this.$route.params.id)
        console.log(res.data)
        this.nombre = res.data.nombre
        this.codigo = res.data.codigo
        this.precio = res.data.pvp
        this.genero = res.data.genero
        this.descripcion = res.data.descripcion
        this.categoria = res.data.categoria_id
        this.marca = res.data.marca_id
        //this.valoracion = res.data.valoracion
      }catch(err){
        console.log(err)
      }

      try{
        var res = await axios.get('/api/documentos/' + this.$route.params.id)
        console.log(res)
        files = res
      }catch(err){
        console.log(err)
      }
    },
    methods: {
        selectedImage(event) {
            this.selectedFile=event.target.files[0]
        },
        validar() {
            if (this.$refs.form.validate()) {
                axios.put("/api/articulos", {
                  nombre: this.nombre,
                  pvp: parseFloat(this.precio),
                  codigo: this.codigo,
                  descripcion: this.descripcion,
                  marca_id: this.marca,
                  categoria_id: this.categoria,
                  genero: parseInt(this.genero),
                  valoracion: this.valoracion
                }, this.$route.params.id
                ).then((res =>{
                  //console.log(res.data)
                  this.$router.push({ name: 'admin', params: { mostrar_snackbar: 'Articulo editado' }})
                })).catch(err =>{
                  console.log(err.response)
                  this.error = 'Error al crear el articulo'
                  this.snackbar = true;
                })
            }
        },
    },
  }
</script>
