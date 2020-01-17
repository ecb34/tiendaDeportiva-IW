<template>
  <v-container>
    <v-form ref="form" v-model="valid">
      <h1>Registro de Clientes</h1>
      <v-row>
        <v-col>
          <v-text-field v-model="nombre" :rules="reglasNombre" label="Nombre*" required></v-text-field>
        </v-col>
        <v-col>
          <v-text-field v-model="apellido" label="Apellidos"></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-text-field v-model="telefono" label="Telefono" append-icon="mdi-cellphone"></v-text-field>
        </v-col>
        <v-col>
          <v-menu max-width="290">
            <template v-slot:activator="{ on }">
              <v-text-field
                v-on="on"
                :value="fechaFormateada"
                slot="activator"
                label="Fecha Nacimiento"
                append-icon="mdi-calendar-range"
              ></v-text-field>
            </template>
            <v-date-picker v-model="fechaNacimiento" disabled></v-date-picker>
          </v-menu>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols=6>
          <v-text-field v-model="email" :rules="reglasEmail" label="E-mail*" required></v-text-field>
        </v-col>
        <v-col>
          <v-select v-model="rol" :items="roles" v-if="$route.name == 'admin'" label="Rol"></v-select>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-text-field
            v-model="password"
            label="Contraseña*"
            :append-icon="mostrarPassword ? 'mdi-eye' : 'mdi-eye-off'"
            required
            :rules="reglasPassword"
            :type="mostrarPassword ? 'text' : 'password'"
            hint="Al menos 3 carácteres"
            @click:append="mostrarPassword = !mostrarPassword"
          ></v-text-field>
        </v-col>
        <v-col>
          <v-text-field
            :type="mostrarPassword ? 'text' : 'password'"
            v-model="password_confirmation"
            :rules="[() => this.password === this.password_confirmation || 'Las contraseñas deben coincidir']"
            label="Confirmar Contraseña*"
            required
          ></v-text-field>
        </v-col>
      </v-row>  
      <v-checkbox
        v-model="checkbox"
        :rules="[v => !!v || 'Debes aceptar las condiciones de uso!']"
        label="¿Aceptas los terminos y condiciones?"
        required
      ></v-checkbox>
      <v-btn :disabled="!valid" color="success" class="mr-4" @click="validar">Registrar</v-btn>
    </v-form>
    <v-snackbar
      v-model="snackbar"
      :timeout=2000
      color= "error"
    >
      {{errorServer}}
    </v-snackbar>
  </v-container>
</template>

<script>
import axios from "axios";
export default {
  data: () => ({
    valid: true,
    nombre: "",
    rol: "",
    roles: ['admin', 'api', 'usuario'],
    reglasNombre: [v => !!v || "El nombre es obligatorio"],
    email: "",
    reglasEmail: [
      v => !!v || "El email es obligatorio",
      v => /.+@.+\..+/.test(v) || "El email debe tener un formato válido"
    ],
    telefono: "",
    apellido: "",
    fechaNacimiento: null,
    password: "",
    reglasPassword: [
      v => !!v || "La contraseña es obligatoria",
    ],
    password_confirmation: "",
    checkbox: false,
    mostrarPassword: false,
    errorServer: '',
    snackbar: false
  }),

  methods: {
    validar() {
      if (this.$refs.form.validate()) {
        //llamada a signup
        axios.post("/api/auth/signup", {
          nombre: this.nombre,
          email: this.email,
          telefono: this.telefono,
          apellido: this.apellido,
          fechaNacimiento: this.fechaNacimiento,
          password: this.password,
          password_confirmation: this.password_confirmation,
          rol: this.rol
        },{
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With' : 'XMLHttpRequest'
          }
        }).then((res =>{
           if(this.$route.name != 'admin')
            this.$router.push({ name: 'home', params: { snackbar: 'Registrado correctamente' }})
           else{
            this.$emit('registrado', res.data)
           }
        })).catch(err =>{
          console.log(err.response)
          this.errorServer = 'El email ya existe'
          this.snackbar = true;
        })
      }
    }
  },
  computed: {
    fechaFormateada() {
      if (this.fechaNacimiento) {
        var split = this.fechaNacimiento.split("-");
        return split[2] + "/" + split[1] + "/" + split[0];
      }

      return "";
    }
  }
};
</script>

<style>
</style>