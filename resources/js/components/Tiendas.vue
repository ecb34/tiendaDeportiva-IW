<template>
  <v-container fluid style="width: 30%">

    <v-row justify="center">
      <v-row v-if="loading" justify="center">
        <v-progress-circular :width="4" :size="100" color="primary" indeterminate></v-progress-circular>
      </v-row>
      <v-expansion-panels popout>
        <v-expansion-panel v-for="tienda in tiendas" :key="tienda.poblacion">
          <v-expansion-panel-header>
            {{tienda.poblacion}}

          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-simple-table fixed-header height="300px">
              <template v-slot:default>
                <thead>
                  <tr>
                    <th scope="col">Provincia</th>
                    <th scope="col">Población</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">CP</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{tienda.provincia}}</td>
                    <td>{{tienda.poblacion}}</td>
                    <td>{{tienda.direccion}}</td>
                    <td>{{tienda.cp}}</td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-row>

  </v-container>
</template>

<script>
  import axios from "axios";
  export default {

    data: () => ({
      tiendas: [
        {
          provincia: 'Alicante',
          poblacion: 'San Vicente',
          direccion: 'Calle aviación nº13',
          cp: '03690'
        },
        {
          provincia: 'Alicante',
          poblacion: 'Ibi',
          direccion: 'Calle mediterrena nº3',
          cp: '03440'
        },
        {
          provincia: 'Alicante',
          poblacion: 'Guardamar',
          direccion: 'Calle aviaciones nº22',
          cp: '03140'
        },
        {
          provincia: 'Alicante',
          poblacion: 'Torrevieja',
          direccion: 'Calle universidad nº40',
          cp: '03181'
        },
      ],
     
    }),
    methods: {

    },
    created() {


    }
  }
</script>

<style>

</style>