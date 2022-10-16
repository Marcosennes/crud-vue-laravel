import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import EstadoComponent from './components/Estado/listar.vue';
import CidadeComponent from './components/Cidade/listar.vue';

Vue.config.productionTip = false

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.use(VueRouter);

Vue.config.productionTip = false

const routes = [
    { path: '/',                component:  EstadoComponent },
    { path: '/cidade/listar',   component:  CidadeComponent },
]

const router = new VueRouter({
    routes
})

const axios = require('axios').default;

new Vue({
  axios,
  router,
  render: h => h(App),
}).$mount('#app');
