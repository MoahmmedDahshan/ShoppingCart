import Vue from 'vue';
import  VueRouter from 'vue-router';

import HomePage from "./components/pages/home";
import Cart from "./components/pages/cart";

Vue.use(VueRouter);





const routes = [
    { path: '/', component: HomePage },
    { path: '/cart', component: Cart },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router
