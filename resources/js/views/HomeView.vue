<template>
    <v-app>
        <v-app-bar
            app
            clipped-left
            color="#000"
            flat
            dense
        >
            <v-toolbar-title>Radeoh</v-toolbar-title>
        </v-app-bar>
        <!-- Sizes your content based upon application components -->
        <v-content style="padding: 0 !important;">

            <!-- Provides the application the proper gutter -->
            <v-container fluid>

                <station-sidebar></station-sidebar>
            </v-container>

            <bottom-player-ui></bottom-player-ui>

            <v-spacer></v-spacer>
        </v-content>
    </v-app>
</template>

<script>
import VueAudio from '../components/AudioPlayer';
import StationSidebar from '../components/StationSidebar';
import BottomPlayerUi from '../components/BottomPlayerUI';

export default {
    components: {
        BottomPlayerUi,
        StationSidebar,
        VueAudio,
    },

    created() {
        this.$vuetify.theme.dark = true;
    },
};
</script>
