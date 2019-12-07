import Vue from 'vue';
import Router from 'vue-router';
import Home from './components/Home'
import Articulos from './components/Articulos'
import DetalleArticulo from './components/DetalleArticulo'

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
        {
            path: '/articulos/:id',
            name: 'articulo',
            component: DetalleArticulo
        }
        /*{
            path: '/about',
            name: 'Sobre Nosotros',
            component: About
        },*/
        
        /*
        {
            path: '/usuarios',
            name: 'usuarios',
            component: Usuarios
        }*/
       
    ]
});