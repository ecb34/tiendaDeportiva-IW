import './bootstrap';
import Vue from 'vue';
import Vuetify from 'vuetify';
import router from './router';
import axios from 'axios';
import store from './store/index'
import App from './views/App';

Vue.use(Vuetify);
var vuetify = new Vuetify();

/** Templates articulo **/
Vue.component("articulos-recomendados", () => import("./components/templates/articulo/ArticulosRecomendado.vue"));
Vue.component("articulo-detalle-md", () => import("./components/templates/articulo/ArticuloDetalleMD.vue"));
Vue.component("filtro-articulo", () => import("./components/templates/articulo/ArticuloFiltro.vue"));
/** Templates filtro **/
Vue.component("filtro-categoria", () => import("./components/templates/filtro/CategoriaFiltro.vue"));
Vue.component("filtro-precio", () => import("./components/templates/filtro/PrecioFiltro.vue"));
Vue.component("filtro-valoracion", () => import("./components/templates/filtro/ValoracionFiltro.vue"));
Vue.component("filtro-marca", () => import("./components/templates/filtro/MarcaFiltro.vue"));

const app = new Vue({
    router,
    vuetify,
    store,
    beforeMount(){
        axios.interceptors.request.use(async config => {//TODO verificar que va bien
          const token = store.getters.getToken;
          if (token) {
            config.headers.Authorization = 'Bearer '+token;
          }
          return config;
        });
    },
    render: h=> h(App),
}).$mount('#app')



export default app;
