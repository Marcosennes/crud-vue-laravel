import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import HomeComponent from './components/home.vue';
import EstadoComponent from './components/Estado/listar.vue';
import CidadeComponent from './components/Cidade/listar.vue';
import EstadoInserirComponent from './components/Estado/inserir.vue';

Vue.config.productionTip = false

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.use(VueRouter);

Vue.config.productionTip = false

const routes = [
    { path: '/',                      name: 'home',  component:  HomeComponent},
    { path: '/estado/listar',         component:  EstadoComponent },
    { path: '/estado/inserir',        component:  EstadoInserirComponent },
    { path: '/cidade/listar',         component:  CidadeComponent },
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
