<template>
<v-container>
<v-form
    ref="form"
    v-model="valid"
  >
    <v-text-field
      v-model="nombre"
      :rules="reglasNombre"
      label="Nombre"
      required
    ></v-text-field>
    <v-text-field
      v-model="apellido"
      label="Apellidos"
    ></v-text-field>

    <v-menu max-width="290">
      <template v-slot:activator="{ on }">
      <v-text-field v-on="on" :value="fechaFormateada" slot="activator" label="Fecha Nacimiento" append-icon="mdi-calendar-range"></v-text-field>
      </template>
      <v-date-picker v-model="fechaNacimiento"></v-date-picker>
    </v-menu>
   
    <v-text-field
      v-model="email"
      :rules="reglasEmail"
      label="E-mail"
      required
    ></v-text-field>
    <v-text-field
      v-model="telefono"
      label="Telefono"
    ></v-text-field>
    <v-checkbox
      v-model="checkbox"
      :rules="[v => !!v || 'Debes aceptar las condiciones de uso!']"
      label="¿Aceptas los terminos y condiciones?"
      required
    ></v-checkbox>
    <v-btn
      :disabled="!valid"
      color="success"
      class="mr-4"
      @click="validar"
    >
      Registrar
    </v-btn>
</v-form>
</v-container>
  
</template>

<script>
  import axios from "axios"
  export default {
    data: () => ({
      valid: true,
      nombre: '',
      reglasNombre: [
        v => !!v || 'El nombre es obligatorio',
      ],
      email: '',
      reglasEmail: [
        v => !!v || 'El email es obligatorio',
        v => /.+@.+\..+/.test(v) || 'El email debe tener un formato válido',
      ],
      telefono: '',
      apellido: '',
      fechaNacimiento: null,
      checkbox: false,
    }),

    methods: {
      validar () {
        if (this.$refs.form.validate()) {
          this.snackbar = true
          
          //llamada a signup
          //TODO configurar axios como ADI practica 3*/
        }
      }
    },
    computed: {
      fechaFormateada(){
        if(this.fechaNacimiento){
           var split = this.fechaNacimiento.split('-')
           return split[2] + '/' + split[1] + '/' + split[0]
        }
       
        return '';
      }
    }
  }
</script>

<style>

</style>