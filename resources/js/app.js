import './bootstrap';
import Vue from 'vue';
import Vuetify from 'vuetify';
import router from './router';
//import VeeValidate from 'vee-validate';
import axios from 'axios';


import App from './views/App';

//Vue.use(VeeValidate);
Vue.use(Vuetify);
var vuetify = new Vuetify();
const app = new Vue({
    router,
    vuetify,
    render: h=> h(App),
}).$mount('#app')

export default app;
