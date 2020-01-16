<template>
  <v-container>
    <v-form ref="form" v-model="valid">
      <h1>Editar Categoría</h1>
      <v-row>
        <v-col>
          <v-text-field v-model="name" :rules="reglasNombre" label="Nombre*" required></v-text-field>
        </v-col>
        <!--
        <v-col>
          <v-text-field disabled v-model="padre.name" label="Padre"></v-text-field>
        </v-col>
        -->
      </v-row>
      <v-btn :disabled="!valid" color="success" class="mr-4" @click="validar">Editar</v-btn>
    </v-form>
    <v-snackbar
      v-model="snackbar"
      :timeout=2000
      :color="snackColor"
    >
      {{snackText}}
    </v-snackbar>
  </v-container>
</template>

<script>
import axios from "axios";
export default {
  props: {
      categoria: {id:0, name: ''},
      padre: {id: 0, name: ''}
  },
  data: () => ({
    valid: true,
    name: '',
    reglasNombre: [v => !!v || "El nombre es obligatorio"],
    snackbar: false,
    snackText: '',
    snackColor: ''
  }),

  methods: {
    validar() {
      if (this.$refs.form.validate()) {
        // Editar la categoria
        axios.post("/api/categorias/" + $this.categoria.id, {
            'categoria': this.name,
            'padre_id': this.padre.id
        }).then((res =>{
            this.$emit('editada', res.data)  // Devuelvo la lista con todas las categorias
        })).catch(err =>{
          console.log(err.response)
          this.snackText = err.response.data;
          this.snackColor = 'error';
          this.snackbar = true;
        })
      }
    }
  },
  watch: {
    checkName() {
        if(this.categoria.name.length>0)
            this.valid = true;
        else   
            this.valid = false;
    }
  }
};
</script>

<style>
</style>