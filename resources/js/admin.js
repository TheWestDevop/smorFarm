/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
import Toast from 'vue-toastification';
window.Event = new Vue();

//User
import router from './a_routes';
import App from './Admin.vue';

//Toast css
import 'vue-toastification/dist/index.css';

require('./bootstrap');

Vue.config.devtools =true
Vue.config.debug = true
Vue.config.silent = true
Vue.config.productionTips=false


Vue.use(Toast,{transition: "Vue-Toastification__bounce",maxToast:20,newestOnTop:true});




const app = new Vue({
    el: '#admin',
    router,
    render: h => h(App),
});

