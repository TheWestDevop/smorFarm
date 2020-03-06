/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
import Toast from 'vue-toastification';
import Dayjs from 'vue-dayjs';
import router from '../routes/routes';
import App from '../home/App.vue';
import store from '../store';

//Toast css
import 'vue-toastification/dist/index.css';



require('../bootstrap');

Vue.config.devtools =true
Vue.config.debug = true
Vue.config.silent = true
Vue.config.productionTips=false

window.Event = new Vue();

Vue.use(Toast,{transition: "Vue-Toastification__bounce",maxToast:20,position: "bottom-right",timeout: 10000,pauseOnHover: false,});
Vue.use(Dayjs, {
  lang:'en',
  filters: {
    ago: 'ago',
  },
});


const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App),
});


