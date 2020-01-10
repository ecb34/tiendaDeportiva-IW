import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({

    //* SE USA localstorage para que guarde la sesion.. quitarlo?
    state: {
        token : localStorage.getItem('token') || null,
        precioTotal: localStorage.getItem('precio') || -1
    },
    //Getters are function which consult the variables of the state.
    getters: {
        loggedIn(state){
            return state.token != null
        },
        getToken(state){
            return state.token
        },
        getPrecioTotal(state){
            return state.precioTotal
        }
    },
    mutations: {
        setToken(state, token){
            state.token = token
        },
        setPrecioTotal(state,precioTotal){
            state.precioTotal = precioTotal
            localStorage.setItem('precio', precioTotal)
        }
    },
    actions: {
        login(context, credentials){
            return new Promise((resolve,reject) =>{
                axios.post('/api/auth/login', {
                    email: credentials.email,
                    password: credentials.password
                }).then(res =>{
                    localStorage.setItem('token', res.data.access_token)
                    context.commit('setToken', res.data.access_token)
                    resolve()
                }).catch(err =>{
                    reject(err)
                })
            })
            
        },
        logout(context){
            return new Promise((resolve,reject) => {
                axios.get('/api/auth/logout').then(()=>{
                    localStorage.removeItem('token')
                    context.commit('setToken', '')
                    resolve()
                }).catch(err => {
                    console.log(err.response)
                    localStorage.removeItem('token')
                    reject(err)
                })
            })
        }
    }
})