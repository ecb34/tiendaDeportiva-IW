<template>
  <v-list>
      <v-list-item v-for="articulo in listaDeseos" :key="articulo.id">
          <h1>{{articulo.nombre}}</h1>
      </v-list-item>
  </v-list>
</template>

<script>
export default {
    data: function(){
        return {
            listaDeseos: []
        }
    },
    mounted(){
        axios.get('/api/auth/user/listadeseos')
            .then(res =>{
                console.log(res.data)
                this.listaDeseos = res.data
            })
    }
}
</script>

<style>

</style>