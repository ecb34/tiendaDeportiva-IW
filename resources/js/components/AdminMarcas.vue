<template>
    <v-container>
            <h1>Listado Marcas</h1>
            <v-card>
            <v-card-title>
            <v-text-field
                v-model="search"
                append-icon="search"
                label="Buscar"
                single-line
                hide-details
            ></v-text-field>
            </v-card-title>
            <v-data-table
                :headers="headers"
                :items="marcas"
                :loading="loading" loading-text="Cargando datos..."
                :search="search"
            >
            <template v-slot:item.action="{ item }">
                <v-btn color="success">
                    <v-icon class="mr-2">
                        mdi-pencil
                    </v-icon>
                </v-btn>
                <v-btn color="error" >
                    <v-icon class="mr-2">
                        delete
                    </v-icon>
                </v-btn>
            </template>
            </v-data-table>
        </v-card>
    </v-container>
</template>

<script>
import axios from "axios"
export default {
    data: function(){
        return {
            loading: true,
            search: '',
            headers: [
                {text: 'ID', value: 'id'},
                {text: 'Nombre', value: 'nombre'},
                {text: 'Empresa', value: 'empresa'},
                {text: 'Logo', value: 'logo'},
                {text: 'Acciones', value: 'action', sortable: false}
            ],
            marcas: []
        }
    }
}
</script>

<style>

</style>