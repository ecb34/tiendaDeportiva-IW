import Vue from 'vue';
import Router from 'vue-router';
import Home from './components/Home'
import Articulos from './components/Articulos'
import DetalleArticulo from './components/DetalleArticulo'
import Contacto from './components/Contacto'
import Cookies from './components/PoliticaCookies'
import Tiendas from './components/Tiendas'
import ListaArticulosHombre from './components/ListaArticulosHombre'
import ListaArticulosMujer from './components/ListaArticulosMujer'
import Carrito from './components/Carrito'

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
            component: Articulos,
            //props: true
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
            name: 'ListaArticulosHombre',
            component: ListaArticulosHombre
        },
        {
            path: '/mujer',
            name: 'ListaArticulosMujer',
            component: ListaArticulosMujer
        },
        {
            path: '/carrito',
            name: 'Carrito',
            component: Carrito
        },
        {
            path: '/tiendas',
            name: 'Tiendas',
            component: Tiendas
        }
    ]
});