/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
import Toast from 'vue-toastification';
import * as VueGoogleMaps from "vue2-google-maps";
window.Event = new Vue();

//User
import router from '../routes/a_routes';
import App from '../home/Admin.vue';

//Toast css
import 'vue-toastification/dist/index.css';

require('../bootstrap');

Vue.config.devtools =false
Vue.config.debug = false
Vue.config.silent = false
Vue.config.productionTips=false


Vue.use(Toast,{transition: "Vue-Toastification__bounce",maxToast:20,newestOnTop:true});
Vue.use(VueGoogleMaps,{
    load:{
        key:" AIzaSyByJpcW-yoL4o5kZ921xORiVZb0q2SLkn8",
        libraries:"places"
    }
})




const app = new Vue({
    el: '#admin',
    router,
    render: h => h(App),
});

