import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import EstadoComponent from './components/Estado/listar.vue';
import CidadeComponent from './components/Cidade/listar.vue';
import EstudosComponent from './components/estudos.vue';
import MotionComponent from './components/motion.vue';
import RedisComponent from './components/redis.vue';
import PasswordResetComponent from './components/Auth/change_password.vue';
import LoginComponent from './components/Auth/login.vue';
import LoggedComponent from './components/Logged/User/home.vue';
import PageNotFoundComponent from './components/Logged/404_error.vue';
import PdfTest from './components/pdf_test.vue'

import Middleware from './services/middleware';

Vue.config.productionTip = false

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

Vue.use(VueRouter); 

Vue.config.productionTip = false

const routes = [
    { path: '/',                component:  EstadoComponent },
    { path: '/cidade/listar',   component:  CidadeComponent },
    { path: '/estudos',         component:  EstudosComponent },
    { path: '/motion',          component:  MotionComponent },
    { path: '/redis',           component:  RedisComponent },
    { path: '/login',           component:  LoginComponent },
    { path: '/logged',          component:  LoggedComponent, beforeEnter: Middleware.auth },
    { path: '/redefinir_senha', component:  PasswordResetComponent },
    { path: '/page_not_found',  component:  PageNotFoundComponent },
    { path: '/pdf',             component:  PdfTest }
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
