/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
window.Event = new Vue();

//User
import router from './routes';
import App from './App.vue';



require('./bootstrap');

Vue.config.devtools = false
Vue.config.debug = false
Vue.config.silent = true



const app = new Vue({
    el: '#app',
    router,
    render: h => h(App),
});


