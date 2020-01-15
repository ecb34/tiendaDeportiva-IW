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
                    //rules.maxTam,
                    //rules.required,
                    //rules.fileRule,
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
                  <v-row justify="space-between">
                    <v-col cols="auto">
                      <v-card
                        class="mx-auto"
                        max-width="400"
                      >
                        <input style="display: none" type="file" @change="selectMainImage" accept="image/*" ref="MainInput">
                        <img :src="MainImage" height="auto" width="100%">

                        <v-card-actions>
                          <v-btn @click="MainFile" color="primary" class="primary">Buscar imagen</v-btn>

                          <v-btn @click="removeMainImage" class="warning">Eliminar</v-btn>
        
                        </v-card-actions>
                      </v-card>
                    </v-col>
                    <v-col cols="auto">
                      <v-card
                        class="mx-auto"
                        max-width="400"
                      >
                        <input style="display: none" type="file" @change="selectSecondaryImage" accept="image/*" ref="SecondInput">
                        <img :src="SecondaryImage" height="auto" width="100%">

                        <v-card-actions>
                          <v-btn @click="SecondFile" color="primary" class="primary">Buscar imagen</v-btn>

                          <v-btn @click="removeSecondaryImage" class="warning">Eliminar</v-btn>
        
                        </v-card-actions>
                      </v-card>
                    </v-col>
                    <v-col cols="auto">
                      <v-card
                        class="mx-auto"
                        max-width="400"
                      >
                        <input style="display: none" type="file" @change="selectThirdImage" accept="image/*" ref="ThirdInput">
                        <img :src="ThirdImage" height="auto" width="100%">

                        <v-card-actions>
                          <v-btn @click="ThirdFile" color="primary" class="primary">Buscar imagen</v-btn>

                          <v-btn @click="removeThirdImage" class="warning">Eliminar</v-btn>
        
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
        MainImage: null,
        SecondaryImage: null,
        ThirdImage: null,
        imagenes: [],
        storeMainimage: {nombre: '', imagen: null},
        storeSecondImage: {nombre: '', imagen: null},
        storeThirdImage: {nombre: '', imagen: null},
        fileName: '',
        files: [], 
        newFiles: [],
        errorServer: '',
        snackbar: false,
        error: '',
      }
    },
    mounted (){
      /*axios.get('/api/categorias')
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

      axios.get('/api/documentos/' + this.$route.params.id)
        .then(response => {
          console.log(response.data)
          var filtroDocs = response.data.filter(function (el) {
            return el.documento != null;
          });
          console.log(filtroDocs)
          for(let i=0;i<filtroDocs.length;i++){
            this.files[i]=filtroDocs[i].documento
          }
          console.log(this.files)
        }).catch(err => {
          console.log(err)
        })

      axios.get('/api/imagenes/' + this.$route.params.id)
        .then(response => {
          console.log(response.data)
          this.imagenes = response.data.filter(function (el) {
            return el.imagen != null;
          });
          for(let i=0;i<this.imagenes.length;i++){
            if(i==0){
              this.MainImage=imagePreview(this.imagenes[i])
            }else if(i==1){
              this.SecondaryImage=imagePreview(this.imagenes[i])
            }else{
              this.ThirdImage=imagePreview(this.imagenes[i])
            }
          }
        }).catch(err => {
          console.log(err)
        })*/

        /*axios.get("/api/articulos/" + this.$route.params.id)
        .then(response => {
          this.nombre = res.data.nombre
        this.codigo = res.data.codigo
        this.precio = res.data.pvp
        this.genero = res.data.genero
        this.descripcion = res.data.descripcion
        this.categoria = res.data.categoria_id
        this.marca = res.data.marca_id
        }).catch(err => {
          console.log(err)
        })*/
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
      }catch(err){
        console.log(err)
      }
      
      try{
        await axios.get('/api/categorias')
          .then(response => {
            this.categorias = response.data;
            console.log(response.data)
          })
      }catch(err){
        console.log(err)
      }

      try{
        await axios.get('/api/marcas')
          .then(response => {
            this.marcas = response.data;
            console.log(response.data)
          })
      }catch(err){
        console.log(err)
      }

      try{
        await axios.get('/api/documentos/' + this.$route.params.id)
          .then(response => {
            console.log(response.data)
            var filtroDocs = response.data.filter(function (el) {
              return el.documento != null;
            });
            console.log(filtroDocs)
            for(let i=0;i<filtroDocs.length;i++){
              this.files[i]=filtroDocs[i]
            }
            console.log(this.files)
          }).catch(err => {
            console.log(err)
          })
      }catch(err){
        console.log(err)
      }

      try{
        await axios.get('/api/imagenes/' + this.$route.params.id)
          .then(response => {
            console.log(response.data)
            this.imagenes = response.data.filter(function (el) {
              return el.imagen != null;
            });
            for(let i=0;i<this.imagenes.length;i++){
              if(i==0){
                this.MainImage=imagePreview(this.imagenes[i])
              }else if(i==1){
                this.SecondaryImage=imagePreview(this.imagenes[i])
              }else{
                this.ThirdImage=imagePreview(this.imagenes[i])
              }
            }
          })
      }catch(err){
        console.log(err)
      }

      /*try{
        var res = await axios.get('/api/documentos/' + this.$route.params.id)
        console.log(res.data)
        this.files = res.data.documento
      }catch(err){
        console.log(err)
      }*/
    },
    methods: {
        MainFile(){
          this.$refs.MainInput.click()
        },
        SecondFile(){
          this.$refs.SecondInput.click()
        },
        ThirdFile(){
          this.$refs.ThirdInput.click()
        },
        selectMainImage(event) {
            
            this.storeMainimage.imagen = event.target.files[0]
            let reader = new FileReader()
            this.storeMainimage.nombre = event.target.files[0].name
            reader.readAsDataURL(this.storeMainimage.imagen)
            reader.onload = e => {
              this.MainImage = e.target.result
            }
            console.log(this.MainImage)
        },
        selectSecondaryImage(event) {
            
            this.storeSecondImage.imagen = event.target.files[0]
            let reader = new FileReader()
            this.storeSecondImage.nombre = event.target.files[0].name
            reader.readAsDataURL(this.storeSecondImage.imagen)
            reader.onload = e => {
              this.SecondaryImage = e.target.result
            }
            console.log(this.SecondaryImage)
        },
        selectThirdImage(event) {
            
            this.storeThirdImage.imagen = event.target.files[0]
            let reader = new FileReader()
            this.storeThirdImage.nombre = event.target.files[0].name
            reader.readAsDataURL(this.storeThirdImage.imagen)
            reader.onload = e => {
              this.ThirdImage = e.target.result
            }
            console.log(this.ThirdImage)
        },
        removeMainImage(){
          this.MainImage=null
          this.storeMainimage.nombre=''
          this.storeMainimage.imagen=null
        },
        removeSecondaryImage(){
          this.SecondaryImage=null
          this.storeSecondImage.nombre=''
          this.storeSecondImage.imagen=null
        },
        removeThirdImage(){
          this.ThirdImage=null
          this.storeThirdImage.nombre=''
          this.storeThirdImage.imagen=null
        },
        imagePreview(imagen){
          let reader = new FileReader()
          reader.readAsDataURL(imagen.imagen)
          reader.onload = e => {
          let imgPreview = e.target.result
          }
          console.log(imgPreview)
          return imgPreview
        },
        validar() {
            if (this.$refs.form.validate()) {
                axios.put("/api/articulos/" + this.$route.params.id, {
                  nombre: this.nombre,
                  pvp: parseFloat(this.precio),
                  codigo: this.codigo,
                  descripcion: this.descripcion,
                  marca_id: this.marca,
                  categoria_id: this.categoria,
                  genero: parseInt(this.genero),
                }
                ).then((res =>{
                  //console.log(res.data)
                  this.$router.push({ name: 'admin', params: { mostrar_snackbar: 'Articulo editado' }})
                })).catch(err =>{
                  console.log(err.response)
                  this.error = 'Error al crear el articulo'
                  this.snackbar = true;
                })

                if(this.files){
                  for(let i=0;i<this.files.length;i++){
                    axios.put( '/api/documentos/' + this.files[i].id,
                      {
                        nombre: this.files[i].name,
                        articulo_id: this.$route.params.id,
                        url: null,
                        documento: this.files[i].documento
                      },
                      {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                      }
                    ).then(res =>{
                      console.log(res.data)
                    })
                    .catch(res =>{
                      console.log(res.data)
                    });
                  }
                }

                if(this.imagenes){
                  for(let j=0;j<this.imagenes.length;j++){
                    axios.put( '/api/imagenes/' + this.imagenes.id,
                      {
                        nombre: this.imagenes[j].name,
                        articulo_id: this.$route.params.id,
                        url: null,
                        imagen: this.imagenes[j].imagen
                      },
                      {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                      }
                    ).then(res =>{
                      console.log(res.data)
                    })
                    .catch(res =>{
                      console.log(res.data)
                    });
                  }
                }
            }
        },
    },
  }
</script>
