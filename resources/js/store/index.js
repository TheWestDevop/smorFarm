import Vue from 'vue';
import Vuex from 'vuex';


import ProductModule from './modules/product';
import ChefModule from './modules/chef';
import KitchenModule from './modules/kitchen';
import UserModule from './modules/user';
import AuthModule from './modules/auth';
import OrderModule from './modules/order';


Vue.use(Vuex);


export default new Vuex.Store({
  modules:{
    ProductModule,
    ChefModule,
    KitchenModule,
    UserModule,
    OrderModule,
    AuthModule
  }
})