import Vue from 'vue';
import VueRouter from 'vue-router';
import Index from '../pages/home';
import About_Us from '../pages/about';
import Contact_Us from '../pages/contact';
import Login from '../pages/auth/login';
import Register from '../pages/auth/register';
import Mall from '../pages/market';
import Profile from '../pages/user/profile';
import Edit_Profile from '../pages/user/edit_profile';
import CheckOut from '../pages/orders/checkout';
import Cart from '../pages/orders/cart';
import WishList from '../pages/orders/wishlist';
import Orders from '../pages/orders/orders';
import Pre_Orders from '../pages/orders/pre_orders';
import Fast_Track from '../pages/auth/fast_track';
import Search from '../pages/products/search';
import Order_Status from '../pages/orders/order_status';
import ProductByCategory from '../pages/products/productByCategory';
import Payment from '../pages/payment/payment';
import PaymentSuccess from '../pages/payment/payment_successful';
import PaymentError from '../pages/payment/payment_error';
import Reset from '../pages/auth/forgotten_password';

import Product_Info from '../pages/products/product_info';
import store from '../store';

import Kitchen from '../pages/kitchen/kitchen';
import User_Kitchen from '../pages/kitchen/user_kitchen';
import Kitchen_CheckOut from '../pages/kitchen/check_out';
import Kitchen_Payment from '../pages/kitchen/payment';
import Kitchen_Payment_Success from '../pages/payment/kitchen';




Vue.use(VueRouter);
const router = new VueRouter({
    routes: [

        {
            path: '/',
            component: Index,
            name: 'home'
        },
        {
            path: '/about',
            component: About_Us,
            name: 'about'
        },
        {
            path: '/contact',
            component: Contact_Us,
            name: 'contact'
        },
        {
            path: '/login',
            component: Login,
            name: 'auth.login'
        },
        {
            path: '/register',
            component: Register,
            name: 'auth.register'
        },
        {
            path: '/reset',
            component: Reset,
            name: 'reset'
        },
        
        {
            path: '/market',
            component: Mall,
            name: 'mall'
        },
        {
            path: '/profile',
            component: Profile,
            name: 'profile'
        },
        {
            path: '/edit/profile',
            component: Edit_Profile,
            name: 'edit_profile'
        },
        {
            path: '/checkout',
            component: CheckOut,
            name: 'checkout'
        },
        {
            path: '/cart',
            component: Cart,
            name: 'cart'
        },
        {
            path: '/orders',
            component: Orders,
            name: 'order'
        },
        {
            path: '/pre/orders',
            component: Pre_Orders,
            name: 'pre_order'
        },
        {
            path: '/product/info/',
            component: Product_Info,
            name: 'product-info',
        },
        {
            path: '/product/category/:category',
            component: ProductByCategory,
            name: 'productCategory',
            props: true
        },
        {
            path: '/product/search/:statement',
            component: Search,
            name: 'Search',
            props: true
        },
        {
            path: '/fast/order',
            component: Fast_Track,
            name: 'fast_track'
        },
        {
            path: '/kitchen',
            component: Kitchen,
            name: 'kitchen'
        },
        {
            path: '/user/kitchens',
            component: User_Kitchen,
            name: 'user_kitchen'
        },
        {
            path: '/kitchen/checkout',
            component: Kitchen_CheckOut,
            name: 'kitchen_checkout'
        },
        {
            path: '/kitchen/payment',
            component: Kitchen_Payment,
            name: 'kitchen_payment'
        },
        {
            path: '/kitchen/booking/success',
            component: Kitchen_Payment_Success,
            name: 'booking_success'
        },
        {
            path: '/order/status',
            component: Order_Status,
            name: 'order_status'
        },
        {
            path: '/order/payment',
            component: Payment,
            name: 'payment'
        },
        {
            path: '/order/payment/success',
            component: PaymentSuccess,
            name: 'payment_success'
        },
        {
            path: '/order/payment/error',
            component: PaymentError,
            name: 'payment_error'
        },
        {
            path: '/wishlist',
            component: WishList,
            name: 'wishlist'
        },

    ],

});

const openRoutes = [
                      'home',
                      'about',
                      'contact',
                      'order_status',
                      'payment', 
                      'fast_track',
                      'search',
                      'productCategory', 
                      'product-info', 
                      'cart', 
                      'checkout',
                      'mall',
                      'reset',
                      'auth.login',
                      'auth.register',
                      'payment_success',
                      'payment_error',
                      'wishlist',
                      'kitchen'
                    
                    ];

router.beforeEach((to, from, next) => {
    if (openRoutes.includes(to.name)) {
        next();
    } else if (store.getters.AUTH_STATUS) {
        next();
    } else {
        next('/login');
    }
});

export default router;
