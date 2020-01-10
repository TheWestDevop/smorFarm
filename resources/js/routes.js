import Vue from 'vue';
import VueRouter from 'vue-router';
import Index from './pages/content';
import Login from './pages/login';
import Register from './pages/register';
import Mall from './pages/mall';
import Profile from './pages/profile';
import Edit_Profile from './pages/edit_profile';
import CheckOut from './pages/checkout';
import Orders from './pages/orders';
import Fast_Track from './pages/fast_track';
import Search from './pages/search';
import Order_Status from './pages/order_status';
import ProductByCategory from './pages/productByCategory'
import Payment from './pages/payment'






Vue.use(VueRouter);

export default new VueRouter({
    routes: [

        {
        path: '/',
        component: Index,
        name:'home'
       },
       {
        path: '/login',
        component: Login,
        name:'auth.login'
       },
       {
        path: '/register',
        component: Register,
        name:'auth.register'
       },
       {
        path: '/mall',
        component: Mall,
        name:'mall'
       },
       {
        path: '/profile',
        component: Profile,
        name:'profile'
       },
       {
        path: '/edit/profile',
        component: Edit_Profile,
        name:'edit_profile'
       },
       {
        path: '/checkout',
        component: CheckOut,
        name:'checkout'
       },
       {
        path: '/order',
        component: Orders,
        name:'order'
       },
       {
        path: '/product/category/:category',
        component:ProductByCategory,
        name:'ProductByCategory',
        props:true
       },
       {
        path: '/product/search/:statement',
        component:Search,
        name:'Search',
        props:true
       },
       {
        path: '/fast/order',
        component:Fast_Track,
        name:'fast_track'
       },
       {
        path: '/order/status',
        component:Order_Status,
        name:'order_status'
       },
       {
        path: '/order/payment',
        component:Payment,
        name:'payment'
       },

     ],

});
