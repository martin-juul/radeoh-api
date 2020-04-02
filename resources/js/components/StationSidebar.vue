<template>
  <v-content>
    <v-list
        v-for="station in stations"
        :key="station.slug">

      <v-list-item link @click="setStation(station.slug)">
        <v-list-item-avatar v-if="station.image">
          <v-img :src="station.image"></v-img>
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title>{{ station.title }}</v-list-item-title>
        </v-list-item-content>

      </v-list-item>

    </v-list>
  </v-content>
</template>
<script>
  import axios from '../modules/axios';

  export default {
    name: 'station-sidebar',
    props: [''],
    data: () => ({
      stations: [],
    }),
    methods: {
      loadStations() {
        axios.get('/api/stations')
          .then((res) => this.stations = res.data)
          .catch(console.error);
      },

      setStation(slug) {
        const station = this.stations.filter(x => x.slug === slug)[0];
        this.$store.commit('setStation', station);
      },

      init() {
        this.loadStations();
      },
    },

    mounted() {
      this.init();
    },
  };
</script>
