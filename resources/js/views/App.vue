<template>
  <!--
    <v-app>
        <v-app-bar
        app
        color="black"
        dark
        >
            <v-toolbar-title>UASport</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
            <v-btn text>Link 1</v-btn>
            <v-btn text>Link 2</v-btn>
            <v-btn text>Link 3</v-btn>
            </v-toolbar-items>
            <router-link to="/login">
                <span class="mr-2 ">Login</span>
                <v-icon>mdi-login</v-icon>
            </router-link>
        </v-app-bar>

        <v-content>
            <router-view/>
        </v-content>
  </v-app> 
  -->
  <v-app id="inspire">
    <v-card class="overflow-hidden">
        <!-- HEADER -->
        <v-app-bar
            absolute
            color="#000000"
            dark
            shrink-on-scroll
            prominent
            src="https://nic.icu/wp-content/uploads/2018/07/sport-header-1030x452.jpg"
            fade-img-on-scroll
            scroll-target="#scrolling-techniques-3"
        >
        <template v-slot:img="{ props }">
          <v-img v-bind="props" gradient="to top right, rgba(63, 49, 51, 0.7), rgba(63, 49, 51, 0.7)"></v-img>
        </template>

        <v-toolbar-title>UASport</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn icon>
          <v-icon>mdi-magnify</v-icon>
        </v-btn>

        <template v-slot:extension>
          <v-tabs fixed-tabs background-color="transparent" dark align-with-title>
            <v-tab>Home</v-tab>
            <v-tab>Hombre</v-tab>
            <v-tab>Mujer</v-tab>
            <v-tab>Deportes</v-tab>
            <v-tab>Contacto</v-tab>
            <v-tab>Tiendas</v-tab>
          </v-tabs>
        </template>
        </v-app-bar>
        <!-- END HEADER -->

        <v-sheet id="scrolling-techniques-3" class="overflow-y-auto" max-height="600">
        <v-container style="height: 1000px;"></v-container>
      </v-sheet>
    </v-card>
  </v-app>
</template>

<script>
export default {};
</script>

<style>
</style>