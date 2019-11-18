import Vue from 'vue';
import VueRouter from 'vue-router';

//admin
import Admin_Index from './admin/pages//dashboard';
import Admin_Profile from './admin/pages/profile';

//order
import Admin_Orders from './admin/pages/orders';
import Admin_Order_Info from './admin/pages/order_info';

//product
import Admin_Upload_Product from './admin/pages/Upload_Product';
import Admin_Edit_Product from './admin/pages/edit_Product';
import Admin_Info_Product from './admin/pages/product_info';
import Admin_Product from './admin/pages/products';

//deliveries
import Admin_Deliveries from './admin/pages/deliveries';


//customer
import Admin_Customer from './admin/pages/customer';
import Admin_New_Customer from './admin/pages/new_customer';
import Admin_Edit_Customer from './admin/pages/edit_customer';
//driver
import Admin_Driver from './admin/pages/driver';
import Admin_New_Driver from './admin/pages/new_driver';
import Admin_Edit_Driver from './admin/pages/edit_driver';

//staff
import Admin_Staff from './admin/pages/staff';
import Admin_New_Staff from './admin/pages/new_staff';
import Admin_Edit_Staff from './admin/pages/edit_staff';
import Admin_Info_Staff from './admin/pages/info_staff';
//Logistics
import Admin_Logistics from './admin/pages/logistics';
import Admin_New_Logistics from './admin/pages/new_logistics';
import Admin_Edit_Logistics from './admin/pages/edit_logistics';




Vue.use(VueRouter);

export default new VueRouter({
    routes: [
   {
    path: '/',
    component: Admin_Index,
    name:'admin.home'
   },
   {
    path: '/profile',
    component: Admin_Profile,
    name:'admin_profile'
   },
   {
    path: '/order',
    component: Admin_Orders,
    name:'admin.order'
   },
   {
    path: '/order/:id/info',
    component:Admin_Order_Info,
    name:'admin.info_order',
    props:true
   },
   {
    path: '/upload/product',
    component:Admin_Upload_Product,
    name:'admin.upload_product'
   },
   {
    path: '/edit/product/:id',
    component:Admin_Edit_Product,
    name:'admin.edit_product',
    props:true
   },
   {
    path: '/product/:id/more/info',
    component:Admin_Info_Product,
    name:'admin.info_product',
    props:true
   },
   {
    path: '/products',
    component:Admin_Product,
    name:'admin.product'
   },
   {
    path: '/deliveries',
    component:Admin_Deliveries,
    name:'admin.deliveries'
   },
   {
    path: '/driver',
    component:Admin_Driver,
    name:'admin.driver'
   },
   {
    path: '/Add/driver',
    component:Admin_New_Driver,
    name:'admin.new_driver'
   },
   {
    path: '/Edit/:id/driver',
    component:Admin_Edit_Driver,
    name:'admin.edit_driver',
    props:true
   },
   {
    path: '/customers',
    component:Admin_Customer,
    name:'admin.customer'
   },
   {
    path: '/Add/customer',
    component:Admin_New_Customer,
    name:'admin.new_customer'
   },
   {
    path: '/Edit/:id/customer',
    component:Admin_Edit_Customer,
    name:'admin.edit_customer',
    props:true
   },
   {
    path: '/staffs',
    component:Admin_Staff,
    name:'admin.staff'
   },
   {
    path: '/Add/staff',
    component:Admin_New_Staff,
    name:'admin.new_staff'
   },
   {
    path: '/Edit/:id/staff',
    component:Admin_Edit_Staff,
    name:'admin.edit_staff',
    props:true
   },
   {
    path: '/Info/:id/staff',
    component:Admin_Info_Staff,
    name:'admin.info_staff',
    props:true
   },
   {
    path: '/logistics',
    component:Admin_Logistics,
    name:'admin.logistics'
   },
   {
    path: '/New/logistics',
    component:Admin_New_Logistics,
    name:'admin.new_logistics'
   },
   {
    path: '/Edit/:id/logistics',
    component:Admin_Edit_Logistics,
    name:'admin.edit_logistics',
    props:true
   },
     ],

});
