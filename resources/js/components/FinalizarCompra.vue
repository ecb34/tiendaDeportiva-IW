<template>
  <v-container>
      <div v-if="direccion">
          <h3>Direccion Seleccionada: {{direccion.linea1}} <v-btn text @click="direccion = null" color="primary">Cambiar dirección</v-btn></h3>     
      </div>
      <direccion v-else @seleccionarDireccion="seleccionarDireccion"></direccion>
      <div class="mt-10">
        <h1 class="mb-2">Pago total: {{$store.getters.getPrecioTotal}}€</h1>
        <h1>Información de pago</h1>
        <v-form ref="form" v-model="valid">
            <v-row>
                <v-col cols="8">
                     <v-text-field v-model="tarjeta.numero" label="Número tarjeta" :rules="reglaGeneral" maxlength="16" prepend-icon="mdi-credit-card"></v-text-field>
                </v-col>
                <v-col cols="1">
                    <v-text-field v-model="tarjeta.mes" label="MM"  :rules="reglasMes"></v-text-field>
                </v-col>
                <v-col cols="1">
                    <v-text-field v-model="tarjeta.anyo" label="YY" :rules="reglasAnyo"></v-text-field>
                </v-col>
                <v-col cols="1">
                    <v-text-field v-model="tarjeta.cvs" label="CVS" :rules="reglaGeneral" maxlength="3"></v-text-field>
                </v-col>
            </v-row>
            <v-btn color="primary" @click="realizarPago">Realizar pago</v-btn>
        </v-form>
        <v-alert type="error" class="mt-4" v-show="error">{{mensajeError}}</v-alert>
      </div>
      
  </v-container>
 
</template>

<script>
import Direccion from './Direccion'
export default {
    data(){
        return {
            direccion: null,
            mensajeError: '',
            error: false,
            valid: true,
            tarjeta: {
                numero: '',
                mes: null,
                anyo: null,
                cvs: ''
            },
            reglasMes: [
                v => !!v || 'Campo obligatorio',
                v => v < 13 || 'Número de 1 a 12',
                v => 0 < v || 'Número de 1 a 12'
            ],
            reglasAnyo: [
                v => !!v || 'Campo obligatorio',
                v => v < 100 || 'Número de 0 a 99',
                v => -1 < v ||  'Número de 0 a 99'
            ],
            reglaGeneral: [
                v => !!v || 'Campo obligatorio'
            ]
        }
    },
    methods: {
        seleccionarDireccion(direccion){
            this.direccion = direccion
            this.error = false
        },
        realizarPago(){
            if(!this.direccion){
                this.error = true;
                this.mensajeError = 'No has seleccionado direccion de envio'
                return
            }
            if(this.$refs.form.validate()){
                axios.post('http://172.20.42.144:80/tpviw/public/api/payment',{
                    cardNumber: this.tarjeta.numero,
                    expirationDate: this.tarjeta.mes + this.tarjeta.anyo,
                    cvs: this.tarjeta.cvs,
                    quantity: this.$store.getters.getPrecioTotal,
                    id: 'h725fb7460774044ce5e5d'
                }).then(res =>{
                    switch(res.data.cod){
                        //pago correcto
                        case "01":
                            axios.post('/api/user/pedidos', {
                                'estado': 'pagado'
                            }).then(res =>{
                                this.$router.push({ name: 'home', params: { snackbar: 'Pedido realizado correctamente' }})
                            }).catch(err =>{
                                console.log(err.response)
                            })
                            
                        break;
                        //pago en espera...
                        case "08":
                            axios.post('/api/pedidos', {
                                'estado': 'pendiente'
                            }).then(res =>{
                                this.$router.push({ name: 'home', params: { snackbar: 'Pedido realizado correctamente' }})
                            }).catch(err =>{
                                console.log(err.response)
                            })
                            
                        break;
                        default:
                            this.error = true
                            this.mensajeError = res.data.msg
                        break;
                    }
                }).catch(err =>{//segun su api no deberia entrar...
                    console.log(err)
                })
            }
        }
    },
    components: {
        Direccion
    }
}
</script>

<style>

</style>