<template>
  <v-card>
    <v-tabs
      v-model="tab"
      background-color="blue darken-1"
      centered
      dark
      icons-and-text
    >
      <v-tabs-slider></v-tabs-slider>

      <v-tab href="#tab-1">
        Datos basicos
        <v-icon>mdi-format-list-bulleted-square</v-icon>
      </v-tab>

      <v-tab href="#tab-3">
        Imagenes
        <v-icon>mdi-image</v-icon>
      </v-tab>
    </v-tabs>
    <v-tabs-items v-model="tab">
      <v-form ref="form" v-model="valid">
        <v-tab-item :value="'tab-3'">
          <v-card flat>
              <v-container fluid>
                  <input style="display: none" type="file" @change="selectedImage" ref="fileInput">
                  <v-btn @click="$refs.fileInput.click()">
                      Buscar imagen
                  </v-btn>
                  <v-row>
                  <v-col cols="6" sm="4">
                      <v-img
                      v-model="selectedFile"
                      src="https://cdn.vuetifyjs.com/images/parallax/material2.jpg"
                      gradient="to top right, rgba(100,115,201,.33), rgba(25,32,72,.7)"
                      ></v-img>
                  </v-col>
                  <v-col cols="6" sm="4">
                      <v-img src="https://cdn.vuetifyjs.com/images/parallax/material2.jpg">
                      <div class="fill-height bottom-gradient"></div>
                      </v-img>
                  </v-col>
                  <v-col cols="6" sm="4">
                      <v-img src="https://cdn.vuetifyjs.com/images/parallax/material2.jpg">
                      <div class="fill-height repeating-gradient"></div>
                      </v-img>
                  </v-col>
                  </v-row>
              </v-container>
          </v-card>
        </v-tab-item>
        <v-tab-item :value="'tab-1'">
          <v-container fluid>
            <v-card>
                  <v-row>
                      <v-col>
                        <v-card-text>
                          <v-text-field v-model="nombre" :rules="[rules.required, rules.counter]" label="Nombre del articulo*" required></v-text-field>
                        </v-card-text>
                      </v-col>
                      <v-col>
                        <v-card-text>
                          <v-text-field v-model="precio" type="number" :rules="[rules.required, rules.reglasPvp]" label="€*"></v-text-field>
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
                  </v-row>
            </v-card>
            <v-snackbar
              v-model="snackbar"
              :timeout=2000
              color= "error"
            >
              {{error}}
            </v-snackbar>
          </v-container>
        </v-tab-item>
        <div align="right">
          <v-btn :disabled="!valid" color="success" class="mr-4" @click="validar">Crear articulo</v-btn>
          <br><br>
        </div>
      </v-form>
    </v-tabs-items>
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
        generos: [{nombre: "Unisex",  id: '2'}, 
        {nombre: "Hombre",  id: '0'}, 
        {nombre: "Mujer",  id: '1'}],
        genero: null,
        categorias: [],
        categoria: null,
        descripcion: '',
        marcas: [],
        marca: null,
        rules: {
          requiredcod: value=>  !!value && value!=0 || 'Campo requerido.',
          required: value => !!value || 'Campo requerido.',
          counter: value => value.length <= 30 || 'Maximo 30 caracteres',
          codigoMax: value => value.length == 8 || 'Debe contener exactamente 8 digitos',
          codigoRul: value => {
            const pattern = /^(([0-9]*))$/
            return pattern.test(value) || 'Codigo invalido, solo se permiten digitos.'
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
        errorServer: '',
        snackbar: false,
        error: '',
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
                axios.post("/api/articulos", {
                  nombre: this.nombre,
                  pvp: parseFloat(this.precio),
                  codigo: this.codigo,
                  descripcion: this.descripcion,
                  marca_id: this.marca,
                  categoria_id: this.categoria,
                  genero: parseInt(this.genero),
                }).then((res =>{
                  //console.log(res.data)
                  this.$router.push({ name: 'admin', params: { mostrar_snackbar: 'Articulo creado' }})
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