import Vue from 'vue';
import VueRouter from 'vue-router';
import MyLocation from '../executor/pages/location';
import SeekDirection from '../executor/pages/direction';
import Profile from '../executor/pages/profile';
import Edit_Profile from '../executor/pages/edit_profile';
import Orders from '../executor/pages/orders';
import Order_Info from '../executor/pages/order_info';



Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: '/',
            component: Orders,
            name:'home'
        },
        {
            path: '/order/:id/info',
            component: Order_Info,
            name:'order_info',
            props:true
        },
       {
        path: '/location',
        component: MyLocation,
        name:'location'
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
        path: '/direction',
        component:SeekDirection,
        name:'direction'
       },


     ],

});
