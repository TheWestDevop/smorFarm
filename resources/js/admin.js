/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
window.Event = new Vue();

//User
import router from './a_routes';
import App from './Admin.vue';



require('./bootstrap');







const app = new Vue({
    el: '#admin',
    router,
    render: h => h(App),
});

