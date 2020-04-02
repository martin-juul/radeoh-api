import Vue from 'vue';
import Vuetify from 'vuetify';
import 'material-design-icons-iconfont/dist/material-design-icons.css';
import 'vuetify/dist/vuetify.css';
import router from './router';
import store from './store';

const opts = {};
Vue.use(Vuetify);


new Vue({
  el: '#app',
  vuetify: new Vuetify(opts),
  router,
  store,
});
