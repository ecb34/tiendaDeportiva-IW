import Vue from 'vue';
import Router from 'vue-router';
import Home from './components/Home'
import Articulos from './components/Articulos'

Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },    
        {
            path: '/articulos',
            name: 'articulos',
            component: Articulos
        },
        /*{
            path: '/about',
            name: 'Sobre Nosotros',
            component: About
        },
        {
            path: '/productos/:id',
            name: 'producto',
            component: Producto
        },
        {
            path: '/usuarios',
            name: 'usuarios',
            component: Usuarios
        }*/
       
    ]
});