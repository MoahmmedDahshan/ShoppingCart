import Vue from 'vue';
import router from "./router";

window.Vue = require('vue');

import VueRouter from 'vue-router';



import App from "./components/App.vue";
require('./bootstrap');

Vue.component('App', App);

import VueNotify from 'vuejs-notify'
Vue.use(VueNotify)


const app = new Vue({
    el: '#app',
    router,
    components:{App},

});


