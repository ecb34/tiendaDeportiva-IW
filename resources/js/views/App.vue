<template>
    <v-app id="inspire">
        <v-card class="overflow-hidden">
            <!-- HEADER -->
            <v-app-bar app color="black" dark>
                <v-app-bar-nav-icon>
                    <v-img class="mr-3" :src="logoImgUrl" height="80px" width="90px"> </v-img>
                </v-app-bar-nav-icon>
                <v-toolbar-title>UASport</v-toolbar-title>

                <v-spacer></v-spacer>

                <v-expand-transition>
                    <v-text-field v-on:keyup.enter="searchbyname" v-model="search" v-show="hideDetails" single-line label="Buscar"></v-text-field>
                </v-expand-transition>

                <v-btn @click="hideDetails = ! hideDetails" icon>
                    <v-icon>mdi-magnify</v-icon>
                </v-btn>

                <div v-if="loggedIn">
                    <v-btn icon to="/carrito">
                        <v-icon>mdi-cart</v-icon>
                    </v-btn>

                    <v-menu offset-y>
                        <template v-slot:activator="{ on }">
                            <v-btn icon v-on="on">
                                <v-icon>mdi-account</v-icon>          
                            </v-btn>
                        </template>
                        <v-list>
                            <v-list-item to="/listadeseos">
                                <v-list-item-title>Lista de deseos</v-list-item-title>
                            </v-list-item>
                            <v-list-item to="/pedidos">
                                <v-list-item-title>Mis Pedidos</v-list-item-title>
                            </v-list-item>
                            <v-list-item to="/perfil">
                                <v-list-item-title>Mi Cuenta</v-list-item-title>
                            </v-list-item>
                            <v-list-item to="/editarPerfil">
                                <v-list-item-title>Editar Perfil</v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                    
                    <v-btn @click="logout()" icon>
                        <v-icon color="error">mdi-logout</v-icon>
                    </v-btn>
                </div>

                <login v-else></login>

                <template v-slot:extension>
                    <v-tabs fixed-tabs background-color="transparent" dark align-with-title>
                        <v-tab to="/">Home</v-tab>
                        <v-tab to="/hombre">Hombre</v-tab>
                        <v-tab to="/mujer">Mujer</v-tab>
                        <v-tab to="/articulos">Articulos</v-tab>
                        <v-tab to="/contacto">Contacto</v-tab>
                        <v-tab to="/tiendas">Tiendas</v-tab>
                    </v-tabs>
                </template>
            </v-app-bar>
            <!-- END HEADER -->

            <!-- BODY -->
            <v-content>
                <router-view />
            </v-content>
            <!-- END BODY -->

            <!-- FOOTER -->
            <v-footer dark padless>
                <cookie-law>
                    <div slot="message">
                        Este sitio web utiliza cookies para que usted tenga la mejor experiencia de usuario. Si continúa
                        navegando está dando su consentimiento para la aceptación de las mencionadas cookies y la
                        aceptación de <router-link to="cookies">nuestra política de cookies</router-link>, pinche el
                        enlace para mayor información.
                    </div>
                </cookie-law>
                <v-card flat tile class="black lighten-1 white--text text-center">
                    <v-card-text>
                        <v-img src="/images/logo.png" height="175" contain></v-img>
                    </v-card-text>
                    <v-card-text>
                        <v-btn v-for="icon in icons" :key="icon" class="mx-4 white--text" icon>
                            <v-icon size="24px">{{ icon }}</v-icon>
                        </v-btn>
                    </v-card-text>

                    <v-card-text class="white--text pt-0">
                        Phasellus feugiat arcu sapien, et iaculis ipsum elementum sit amet. Mauris cursus commodo
                        interdum. Praesent ut risus eget metus luctus accumsan id ultrices nunc. Sed at orci sed massa
                        consectetur dignissim a sit amet dui. Duis commodo vitae velit et faucibus. Morbi vehicula
                        lacinia malesuada. Nulla placerat augue vel ipsum ultrices, cursus iaculis dui sollicitudin.
                        Vestibulum eu ipsum vel diam elementum tempor vel ut orci. Orci varius natoque penatibus et
                        magnis dis parturient montes, nascetur ridiculus mus.
                    </v-card-text>

                    <v-divider></v-divider>

                    <v-card-text class="white--text">
                        {{ new Date().getFullYear() }} — <strong>Vuetify</strong>
                    </v-card-text>
                </v-card>
            </v-footer>
            <!-- END FOOTER-->

        </v-card>
    </v-app>
</template>

<script>
    import login from '../components/Login'
    import CookieLaw from 'vue-cookie-law'
    export default {
        data: function () {
            return {
                hideDetails: false,
                search: '',
                icons: [
                    'mdi-twitter',
                    'mdi-facebook',
                    'mdi-linkedin',
                    'mdi-instagram',
                ],
                logoImgUrl: require('../public/images/logo_sin.png')
            }
        },
        methods: {
            async logout() {
                try{
                    await this.$store.dispatch('logout')
                }catch(err){
                    console.log(err.response)
                }
                this.$router.go()
            },
            searchbyname(){
                this.$router.push({ name: 'articulos', query: { q: this.search } })
            }
        },
        computed: {
            loggedIn() {
                return this.$store.getters.loggedIn
            }
        },
        components: {
            'login': login,
            CookieLaw
        }
    };
</script>

<style>
</style>