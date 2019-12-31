import Vue from 'vue';
import Router from 'vue-router';
import Home from './components/Home'
import Articulos from './components/Articulos'
import DetalleArticulo from './components/DetalleArticulo'
import Contacto from './components/Contacto'
import Cookies from './components/PoliticaCookies'
import Tiendas from './components/Tiendas'
import Registro from './components/Registro'
import Carrito from './components/Carrito'
import ListaDeseos from './components/ListaDeseos'

Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            props: true
        },
        {
            path: '/articulos',
            name: 'articulos',
            component: Articulos,
            props: true,
        },
        {
            path: '/articulos/:id',
            name: 'articulo',
            component: DetalleArticulo
        },
        {
            path: '/contacto',
            name: 'Contacto',
            component: Contacto
        },
        {
            path: '/cookies',
            name: 'Cookies',
            component: Cookies
        },
        {
            path: '/hombre',
            name: 'hombre',
            component: Articulos,
            props: true
        },
        {
            path: '/mujer',
            name: 'mujer',
            component: Articulos,
            props: true
        },
        {
            path: '/carrito',
            name: 'Carrito',
            component: Carrito
        },
        {
            path: '/listadeseos',
            name: 'ListaDeseos',
            component: ListaDeseos
        },
        {
            path: '/tiendas',
            name: 'Tiendas',
            component: Tiendas
        },
        {
            path: '/registro',
            name: 'Registro',
            component: Registro
        }
    ]
});

