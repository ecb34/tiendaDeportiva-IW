<template>
  <v-container>
    <v-form ref="form" v-model="valid">
    <v-card>
      <h1>Crear Articulo</h1>
      <v-row>
        <v-col>
          <v-card-text>
            <v-text-field
              v-model="nombre"
              :rules="[rules.required, rules.counter]"
              label="Nombre del articulo*"
              required
            ></v-text-field>
          </v-card-text>
        </v-col>
        <v-col>
          <v-card-text>
            <v-text-field
              v-model="precio"
              type="number"
              :rules="[rules.required, rules.reglasPvp]"
              label="€*"
            ></v-text-field>
          </v-card-text>
        </v-col>
        <v-col>
          <v-card-text>
            <v-text-field
              v-model="codigo"
              :rules="[rules.codigoMax, rules.codigoRul]"
              label="Codigo del articulo*"
            ></v-text-field>
          </v-card-text>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-card-text>
            <v-textarea v-model="descripcion" :rules="[rules.counterdesc]" color="teal">
              <template v-slot:label>
                <div>
                  Descripción
                  <small>(optional)</small>
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
      <v-row>
        <v-col class="ml-4">
          <v-text-field v-model="imagenes" label="URL imágenes separadas por espacios"></v-text-field>
        </v-col> 
      </v-row>
      <br />
      <div align="center" >
        <v-btn :disabled="!valid" color="success" class="mr-4 mb-5" @click="validar">{{ $route.name == 'nuevo'? 'Crear Articulo': 'Guardar'}}</v-btn>
      </div>
    </v-card> 
    </v-form>
    <v-snackbar v-model="snackbar" :timeout="2000" color="error">{{error}}</v-snackbar>
  </v-container>
</template>

<script>
import axios from "axios";
export default {
  props: {
    isEdit: {
      type: Boolean
    }
  },
  data() {
    return {
      valid: true,
      nombre: "",
      precio: "",
      codigo: "",
      generos: [],
      genero: null,
      categorias: [],
      categoria: null,
      descripcion: "",
      marcas: [],
      marca: null,
      rules: {
        requiredcod: value => (!!value && value != 0) || "Campo requerido.",
        required: value => !!value || "Campo requerido.",
        counter: value => value.length <= 30 || "Maximo 30 caracteres",
        codigoMax: value =>
          value.length == 8 || "Debe contener exactamente 8 digitos",
        codigoRul: value => {
          const pattern = /^(([0-9]*))$/;
          return (
            pattern.test(value) || "Codigo invalido, solo se permiten digitos."
          );
        },
        counterdesc: value => value.length <= 150 || "Maximo 200 caracteres",
        pvp: value => {
          const pattern = /^(([0-9]*)|(([0-9]*)\.([0-9]*)))$/;
          return pattern.test(value) || "Precio invalido.";
        },
        reglasPvp: v => v >= 0 || "Max no puede ser negativo"
      },
      files: [],
      imagenes: '',
      errorServer: "",
      snackbar: false,
      error: ""
    };
  },
  mounted() {
    axios
      .get("/api/categoriassinhijos")
      .then(response => {
        this.categorias = response.data;
        for(var i = 0; i< this.categorias.length;i++){
          this.categorias[i].name = this.categorias[i].categoria.name + ' - ' + this.categorias[i].name
        }
      })
      .catch(err => {
        console.log(err);
      });

    axios
      .get("/api/marcas")
      .then(response => {
        this.marcas = response.data;
        console.log(response.data);
      })
      .catch(err => {
        console.log(err);
      });
      console.log(this.isEdit);
      
    if(this.$route.name == 'editarArticulo'){
      axios.get('/api/articulos/'+ this.$route.params.id)
        .then(res =>{
          this.nombre= res.data.data.nombre
          this.precio= parseFloat(res.data.data.pvp)
          this.codigo= res.data.data.codigo
          this.marca = res.data.data.marca
          this.descripcion = res.data.data.descripcion
          this.categoria = res.data.data.categoria
          switch(res.data.data.genero){
            case 0: 
              this.genero = { nombre: "Hombre", id: "0" };
            break;
            case 1:
              this.genero = { nombre: "Mujer", id: "1" }
            break;
            default:
              this.genero = { nombre: "Unisex", id: "2" }
            break;
          }
          this.genero = res.data.data.genero
          res.data.data.imagenes.forEach(img => {
            this.imagenes = img.url + " " + this.imagenes
          });
        }).catch(err =>{
          console.log(err.response)
        })
    }
  },
  methods: {
    validar() {
      if (this.$refs.form.validate()) {
        var imagenes = this.imagenes.split(' ');
        //llamada para postear articulo
        axios
          .post("/api/articulos", {
            nombre: this.nombre,
            pvp: parseFloat(this.precio),
            codigo: this.codigo,
            descripcion: this.descripcion,
            marca_id: this.marca,
            categoria_id: this.categoria,
            genero: parseInt(this.genero),
            imagenes: imagenes
          })
          .then(res => {
            this.$router.push({
              name: "admin",
              params: { mostrar_snackbar: "Articulo creado" }
            })
          }).catch(err => {
            console.log(err.response);
            this.error = "Error al crear el articulo";
            this.snackbar = true;
          });
      }
    }
  }
};
</script>