import './bootstrap';
import Vue from 'vue';
import Vuetify from 'vuetify';
import router from './router';
import axios from 'axios';
import store from './store/index'
import App from './views/App';

Vue.use(Vuetify);
var vuetify = new Vuetify();
const app = new Vue({
    router,
    vuetify,
    store,
    mounted(){
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
