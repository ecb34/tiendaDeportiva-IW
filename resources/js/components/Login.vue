<template>
<div class="text-center">
            <v-dialog v-model="dialog" width="500">
            <template v-slot:activator="{ on }">
                <v-btn icon v-on="on">
                    <v-icon>mdi-login</v-icon>
                </v-btn>
            </template>
  <v-card class="elevation-12">
              <v-toolbar
                color="primary"
                dark
                flat
              >
                <v-toolbar-title>Iniciar Sesión</v-toolbar-title>

              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field
                    label="Nombre"
                    name="Nombre"
                    v-model="credentials.nombre"
                    prepend-icon="mdi-account"
                    type="text"
                  ></v-text-field>

                  <v-text-field
                    label="Contraseña"
                    name="contraseña"
                    v-model="credentials.password"
                    prepend-icon="mdi-lock"
                    type="password"
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-btn @click="dialog = false" to="/registrar" text color="primary">¿No tienes cuenta? Registrate</v-btn>
                <v-spacer></v-spacer>
                <v-btn  @click="submit" color="blue" class="white--text">Login</v-btn>
              </v-card-actions>
            </v-card>
            </v-dialog>
    </div>
</template>

<script>
export default {
    data: function(){
        return{
            dialog: false,
            credentials: {
                nombre: '',
                password: ''
            },
        }
    },
    methods: {
        submit(){

        }
    }

}
</script>

<style>

</style>