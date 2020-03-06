/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
import Toast from 'vue-toastification';
import router from '../routes/executor_routes';
import * as VueGoogleMaps from "vue2-google-maps";
import App from '../home/Executor.vue';

//Toast css
import 'vue-toastification/dist/index.css';



require('../bootstrap');

Vue.config.devtools =true
Vue.config.debug = true
Vue.config.silent = true
Vue.config.productionTips=false

window.Event = new Vue();

Vue.use(Toast,{transition: "Vue-Toastification__bounce",maxToast:20,newestOnTop:true});
Vue.use(VueGoogleMaps,{
    load:{
        key:" AIzaSyAIIUF1p6P7JmBwgEweGNwhuYy-qb8hb8o"
    }
})  

const app = new Vue({
    el: '#executor',
    router,
    render: h => h(App),
});


