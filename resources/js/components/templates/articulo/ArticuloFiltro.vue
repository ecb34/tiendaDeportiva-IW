<template>
  <v-row v-if="loading" justify="center">
    <v-progress-circular :width="4" :size="100" color="primary" indeterminate></v-progress-circular>
  </v-row>
  <v-expansion-panels v-else multiple v-model="panel">
    <!-- Filtro Categoria // Con :selection="selection" le pasamos la lista de categorias actual -->
    <filtro-categoria 
        :selection="selection"
        @newCategoriaSelection="getFiltroCategoria">
    </filtro-categoria>
    
    <!-- Filtro precio -->
    <filtro-precio
        :MAX="MAX"
        @newMinMax="getFiltroMinMax">
    </filtro-precio>

    <!-- Filtro Valoracion -->
    <filtro-valoracion 
        :rating="rating"
        @newRating="getFiltroValoracion">
    </filtro-valoracion>

    <!-- Filtro Marca -->
    <filtro-marca
        :selected_marca="selected_marca"
        @newMarcaSelection="getFiltroMarca">
    </filtro-marca>
  </v-expansion-panels>
</template>

<script>
import axios from "axios";
export default {
  name: "articulos",
  // Datos que recibe la imagen
  props: ['articulos'],
  data() {
    // Datos que puede devolver la vista
    return {
        // cosas necesarias
      listaArticulos: [],
      listaArticulosSinFiltro: [],
      mostrar_snackbar: false,
      snackbar: "",
      panel: [1,2], // Con [1,2] se indica que paneles han de estar expandidos
      loading: true,
      // filtrado de categorias
      selection: [],
      // filtrado de precios
      rangoPrecio: [0, 0],
      MAX: 0,
      // filtrado de valoraciones
      rating: 0,
      // filtrado de marcas
      selected_marca: []
    };
  },
  async mounted() {
    try {
        console.log("Filtro articulos montado")
        this.traerArticulos();
        const cat = await axios.get("/api/categorias");
        this.items = cat.data;
    } catch (err) { console.log(err.response) }
  },
  methods: {
    /** INICIO - Llenar las listas */
    traerArticulos: function() {
      this.loading = true;
      axios
        .get("/api/articulos")
        .then(response => {
          this.listaArticulos = response.data.filter(this.filtrarArticulos);

          this.MAX = this.listaArticulos.reduce((res, current) => {
            return current.pvp > res ? current.pvp : res;
          }, -1);

          this.rangoPrecio[1] = this.MAX
          
          this.loading = false;
          this.listaArticulosSinFiltro = this.listaArticulos;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    /** FIN - Llenar las listas */
    /************************************************************/
    /** INICIO Obtener DATOS desde los TEMPLATES */
    getFiltroCategoria(newCategoriaSelection) {
        console.log("Get filtro categoria = ", newCategoriaSelection)
        this.selection = newCategoriaSelection
    },
    getFiltroMinMax(newMinMax) {
        console.log("Get filtro precio (Min,Max)", newMinMax)
        this.rangoPrecio[0] = newMinMax.min
        this.rangoPrecio[1] = newMinMax.max
        this.filtroGeneral();
    },
    getFiltroValoracion(newRating) {
        console.log("Get filtro rating = ", newRating)
        this.rating = newRating
    },
    getFiltroMarca(newMarcaSelection) {
        console.log("Get filtro marca = ", newMarcaSelection)
        this.selected_marca = newMarcaSelection
    },
    /** FIN - Obtener DATOS desde los TEMPLATES */
    /*************************************************************/
    /** INICIO - FILTRAR la lista de articulos */    
    filtrarArticulos: function(articulo) {
      if (this.$route.query.q) {
        return articulo.nombre
          .toUpperCase()
          .includes(this.$route.query.q.toUpperCase());
      } else if (
        this.$route.name === "hombre" &&
        (articulo.genero == 0 || articulo.genero == 2)
      ) {
        return true;
      } else if (
        this.$route.name === "mujer" &&
        (articulo.genero == 1 || articulo.genero == 2)
      ) {
        return true;
      } else if (this.$route.name === "articulos") {
        return true;
      }

      return false;
    },
    filtrarPorCategoria() {
      if (this.selection.length == 0)
        this.listaArticulos = this.listaArticulosSinFiltro;
      else {
        this.listaArticulos = this.listaArticulosSinFiltro.filter(articulo => {
          return this.selection.some(s => s.id == articulo.categoria_id);
        });
      }
    },
    filtrarPorPrecio() {
        console.log("filtro precio (Min,Max)", this.rangoPrecio[0], this.rangoPrecio[1])
      this.listaArticulos = this.listaArticulos.filter(articulo => {
        let marca =
          this.selected_marca.length != 0
            ? this.selected_marca.includes(articulo.marca_id)
            : true;
        let precio =
          articulo.pvp >= this.rangoPrecio[0] &&
          articulo.pvp <= this.rangoPrecio[1];
        let valoracion = this.rating <= articulo.valoracion;

        return marca && precio && valoracion;
      });
    },
    filtroGeneral() {
      this.filtrarPorCategoria();
      this.filtrarPorPrecio();
      // Con $emit Devolvemos la lista de articulos ordenadas a la vista padre
      this.$emit('articulosOrdenados', this.listaArticulos);
    }
    /** FIN - FILTRAR la lista de articulos */
    /****************************************/
  },
  watch: {
    $route(to, from) {
      this.selection = [];
      this.rangoPrecio = [0, 500]
      this.rating = 0;
      this.selected_marca = [];
      this.traerArticulos();
    },
    selection() {
      this.filtroGeneral();
    },
    rangoPrecio() {
      this.filtroGeneral();
    },
    rating() {
      this.filtroGeneral();
    },
    selected_marca() {
      this.filtroGeneral();
    }
  }
};
</script>
<style>
.v-card--reveal {
  align-items: center;
  bottom: 0;
  justify-content: center;
  opacity: 0.5;
  position: absolute;
  width: 100%;
}
</style>