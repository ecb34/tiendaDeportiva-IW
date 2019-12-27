import Vue from 'vue';
import Router from 'vue-router';
import Home from './components/Home'
import Articulos from './components/Articulos'
import DetalleArticulo from './components/DetalleArticulo'
import Contacto from './components/Contacto'
import Cookies from './components/PoliticaCookies'
import Tiendas from './components/Tiendas'
import Registro from './components/Registro'

Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            props: (route) => ({ mostrar_snackbar: (route.query.mostrar_snackbar === 'true') })
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