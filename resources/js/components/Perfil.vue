<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header text-white" style="background-image:url('./images/perfilBackground.jpg'); background-size:cover; background-position:center; border-radius:20%;">
            <h3 class="widget-user-username text-center" style="margin-left:1%;">{{user.nombre}} {{user.apellido}}</h3>
            <h5 class="widget-user-desc text-center" style="margin-left:1%;">{{user.rol}}</h5>
            
            <div class="widget-user-image text-center">
              <img class="img-circle border-right" style="border-radius:50%; margin-left:1%;" alt="User Avatar" src="images/noImagenPerfil.png">
            </div>
                  <h4 class="widget-user-email text-center" style="color:azure; margin-left:1%;">Email: {{user.email}}</h4>
                  <h4 class="widget-user-email text-center" style="color:azure; margin-left:1%;">Telefono: {{user.telefono}}</h4>
                  <h4 class="widget-user-email text-center" style="color:azure; margin-left:1%;">Nacido el: {{fechaFormateada}}</h4>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-4 col-4" style="border-right: 0.1em dotted gray">
                <div class="description-block text-center">
                  <h5 class="description-header">{{totalGastado}}€</h5>
                  <span class="description-text">Compras</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-4 col-4" style="border-right: 0.1em dotted gray">
                <div class="description-block text-center">
                  <h5 class="description-header">{{totalPedidos}}</h5>
                  <span class="description-text">Pedidos</span>

                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-4">
                <div class="description-block text-center">
                  <h5 class="description-header">{{totalArticulos}}</h5>
                  <span class="description-text">Productos</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data: () => ({
    user: {},
    totalPedidos: {},
    totalArticulos: {},
    totalGastado: {}
  }),
  async created(){
        try{
          var res = await axios.get("/api/auth/user")
          this.user = res.data.user
          this.totalPedidos = res.data.totalPedidos
          this.totalArticulos = res.data.totalArticulos
          this.totalGastado = res.data.totalGastado
        }catch(err){
          console.log(err.response)
        }
    },
  methods: {
    validar() {
      if (this.$refs.form.validate()) {
        axios.get("/api/auth/user")
        .then(
            (res =>{

            })
        ).catch(err =>{
          
        })
      }
    }
  },
  computed: {
    fechaFormateada() {
      if (this.user.fecha_nacimiento) {
        var split = this.user.fecha_nacimiento.split("-");
        return split[2] + "/" + split[1] + "/" + split[0];
      }
      return "";
    }
  }
};
</script>

<style>
</style>