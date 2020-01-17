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
                    label="Email"
                    name="Email"
                    v-model="credenciales.email"
                    prepend-icon="mdi-account"
                    type="text"
                  ></v-text-field>

                  <v-text-field
                    label="Contraseña"
                    name="contraseña"
                    v-model="credenciales.password"
                    prepend-icon="mdi-lock"
                    type="password"
                  ></v-text-field>
                  <v-checkbox v-model="credenciales.remember_me" label="Recordarme"></v-checkbox>
                  <v-alert type="error" v-if="error != ''">{{error}}</v-alert>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-btn @click="dialog = false" to="/registro" text color="primary">¿No tienes cuenta? Registrate</v-btn>
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
            credenciales: {
                email: '',
                password: '',
                remember_me: false
            },
            error: ''
        }
    },
    methods: {
        submit(){
          this.$store.dispatch('login', this.credenciales)
                      .then((res) =>{
                        let role = this.$store.getters.getRol
                        
                        if(role =='admin'){
                          this.$router.push('/admin') 
                        }
                        else{
                          this.$router.push('/articulos')
                        }
                      }).catch(err => {
                        this.error = 'Error, contraseña/email incorrecto'
                      })
        }
    }

}
</script>

<style>

</style>