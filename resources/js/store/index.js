import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    station: {
      title: null,
      slug: null,
      country: null,
      lang: null,
      image: null,
      streams: [],
    },
  },
  mutations: {
    setStation: (state, station) => state.station = station,
  },
});
