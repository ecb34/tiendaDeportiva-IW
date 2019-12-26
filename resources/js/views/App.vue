<template>
  <v-app id="inspire">
    <v-card class="overflow-hidden">
        <!-- HEADER -->
        <v-app-bar app color="black" dark>
            <v-toolbar-side-icon>
                <v-img class="mr-3" src="images/logo_sin.png" height="80px" width="90px"> </v-img>
            </v-toolbar-side-icon>
            <v-toolbar-title>UASport</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-expand-transition>
                <v-text-field v-show="hideDetails" single-line label="Buscar"></v-text-field>
            </v-expand-transition>

            <v-btn @click="hideDetails = ! hideDetails" icon>
                <v-icon>mdi-magnify</v-icon>
            </v-btn>

            <v-btn icon>
                <v-icon>mdi-cart</v-icon>
            </v-btn>

            <v-btn icon>
                <v-icon>mdi-account</v-icon>
            </v-btn>
            
            <login></login>

            <template v-slot:extension>
                <v-tabs fixed-tabs background-color="transparent" dark align-with-title>
                    <v-tab to="/">Home</v-tab>
                    <v-tab to="/hombre">Hombre</v-tab>
                    <v-tab to="/mujer">Mujer</v-tab>
                    <v-tab to="/articulos">Deportes</v-tab>
                    <v-tab to="/contacto">Contacto</v-tab>
                    <v-tab to="/tiendas">Tiendas</v-tab>
                </v-tabs>
            </template>
        </v-app-bar>
        <!-- END HEADER -->
        
        <!-- BODY -->
         <v-content>
            <router-view/>
        </v-content>
        <!-- END BODY -->

        <!-- FOOTER -->
        <v-footer dark padless>
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
                Phasellus feugiat arcu sapien, et iaculis ipsum elementum sit amet. Mauris cursus commodo interdum. Praesent ut risus eget metus luctus accumsan id ultrices nunc. Sed at orci sed massa consectetur dignissim a sit amet dui. Duis commodo vitae velit et faucibus. Morbi vehicula lacinia malesuada. Nulla placerat augue vel ipsum ultrices, cursus iaculis dui sollicitudin. Vestibulum eu ipsum vel diam elementum tempor vel ut orci. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
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
export default {
    data: function () {
        return {
            hideDetails: false,
            icons: [
                'mdi-twitter',
                'mdi-facebook',
                'mdi-linkedin',
                'mdi-instagram',
            ],
        }
    },
    methods: {
    },
    components: {
        'login': login
    }
};
</script>

<style>
</style>