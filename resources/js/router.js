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
import Store from './store/index'
import NotFound from './components/NotFoundError'
import Unauthorized from './components/UnauthorizedError'

Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/401',
            name: '401',
            component: Unauthorized
        },
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
            component: Carrito,
            beforeEnter(to,from,next){
                if(Store.getters.loggedIn){
                    next()
                }else{
                    next({name: '401'})
                }
            }
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
        },
        {
            path: "*",
            name: 'NotFound',
            component: NotFound 
        }
    ]
});

