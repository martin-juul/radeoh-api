<template>
    <v-app id="inspire">
        <!-- sidebar -->

        <station-sidebar></station-sidebar>

        <v-app-bar
            app
            clipped-left
        >
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"/>
            <v-toolbar-title>Radeoh</v-toolbar-title>
        </v-app-bar>

        <!--<v-content>
            <v-container
                class="fill-height"
                fluid
            >
                <v-row
                    align="center"
                    justify="center"
                >
                    <vue-audio file="http://live-icy.dr.dk/A/A03H.mp3"></vue-audio>
                </v-row>
            </v-container>
        </v-content>-->


        <!--<v-footer app>
             <span>&copy; Martin Juul</span>
         </v-footer>-->
    </v-app>
</template>

<script>
    import VueAudio from '../components/AudioPlayer';
    import StationSidebar from '../components/StationSidebar';

    export default {
        props: {
            source: String,
        },
        components: {
            StationSidebar,
            VueAudio,
        },

        data: () => ({
            drawer: null,
        }),

        created() {
            this.$vuetify.theme.dark = true;
        },
    };
</script>
