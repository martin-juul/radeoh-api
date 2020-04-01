<template>
    <v-navigation-drawer
        v-model="drawer"
        app
        clipped
    >
        <v-list dense v-for="station in stations" :key="station.slug">
            <v-list-item link>
                <v-list-item-action>
                    <v-icon>mdi-view-dashboard</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>{{ station.title }}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>
<script>
    const formatTime = second => new Date(second * 1000).toISOString().substr(11, 8);
    import axios from '../modules/axios';

    export default {
        name: 'station-sidebar',
        props: [''],
        data() {
            return {
                stations: [],
            };
        },

        methods: {
            _handleLoaded() {
                console.debug('StationBrowser@_handleLoaded')
                axios.get('/api/stations')
                .then(console.log)
                .catch(console.error);
            }
        },

    };
</script>
