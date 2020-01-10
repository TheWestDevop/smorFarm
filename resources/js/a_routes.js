import Vue from 'vue';
import VueRouter from 'vue-router';

//admin
import Admin_Index from './admin/pages//dashboard';
import Admin_Profile from './admin/pages/profile';

//order
import Admin_Orders from './admin/pages/orders';
import Admin_Order_Info from './admin/pages/order_info';
import Admin_Order_Driver from './admin/pages/update_driver';

//pre order
import Admin_Pre_Orders from './admin/pages/pre_order';
import Admin_Pre_Order_Info from './admin/pages/pre_order_info';
import Admin_Pre_Order_Driver from './admin/pages/update_driver_pre_order';

//product
import Admin_Upload_Product from './admin/pages/Upload_Product';
import Admin_Edit_Product from './admin/pages/edit_Product';
import Admin_Info_Product from './admin/pages/product_info';
import Admin_Product from './admin/pages/products';

//deliveries
import Admin_Deliveries from './admin/pages/deliveries';

//Categories
import Admin_Categories from './admin/pages/categories';
import Admin_New_Category from './admin/pages/new_category';
import Admin_Edit_Category from './admin/pages/edit_category';


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

//store
import Admin_Store from './admin/pages/store';



Vue.use(VueRouter);

export default new VueRouter({
    routes: [
   {
    path: '/',
    component: Admin_Index,
    name:'admin.home'
   },
   {
    path: '/Profile',
    component: Admin_Profile,
    name:'admin_profile'
   },
   {
    path: '/Order',
    component: Admin_Orders,
    name:'admin.order'
   },
   {
    path: '/Order/:id/Info',
    component:Admin_Order_Info,
    name:'admin.info_order',
    props:true
   },
   {
    path: '/Order/:id/Driver',
    component:Admin_Order_Driver,
    name:'admin.update_driver',
    props:true
   },
   {
    path: '/Pre/Order',
    component: Admin_Pre_Orders,
    name:'admin.pre_order'
   },
   {
    path: '/Pre/Order/:id/Info',
    component:Admin_Pre_Order_Info,
    name:'admin.info_pre_order',
    props:true
   },
   ,
   {
    path: '/Pre/Order/:id/Driver',
    component:Admin_Pre_Order_Driver,
    name:'admin.update_driver_pre_order',
    props:true
   },
   {
    path: '/Upload/Product',
    component:Admin_Upload_Product,
    name:'admin.upload_product'
   },
   {
    path: '/Edit/Product/:id',
    component:Admin_Edit_Product,
    name:'admin.edit_product',
    props:true
   },
   {
    path: '/Product/:id/Info',
    component:Admin_Info_Product,
    name:'admin.info_product',
    props:true
   },
   {
    path: '/Products',
    component:Admin_Product,
    name:'admin.product'
   },
   {
    path: '/Deliveries',
    component:Admin_Deliveries,
    name:'admin.deliveries'
   },
   {
    path: '/Driver',
    component:Admin_Driver,
    name:'admin.driver'
   },
   {
    path: '/Add/Driver',
    component:Admin_New_Driver,
    name:'admin.new_driver'
   },
   {
    path: '/Edit/:id/Driver',
    component:Admin_Edit_Driver,
    name:'admin.edit_driver',
    props:true
   },
   {
    path: '/Customers',
    component:Admin_Customer,
    name:'admin.customer'
   },
   {
    path: '/Add/Customer',
    component:Admin_New_Customer,
    name:'admin.new_customer'
   },
   {
    path: '/Edit/:id/Customer',
    component:Admin_Edit_Customer,
    name:'admin.edit_customer',
    props:true
   },
   {
    path: '/Staffs',
    component:Admin_Staff,
    name:'admin.staff'
   },
   {
    path: '/Add/Staff',
    component:Admin_New_Staff,
    name:'admin.new_staff'
   },
   {
    path: '/Edit/:id/Staff',
    component:Admin_Edit_Staff,
    name:'admin.edit_staff',
    props:true
   },
   {
    path: '/Info/:id/Staff',
    component:Admin_Info_Staff,
    name:'admin.info_staff',
    props:true
   },
   {
    path: '/Logistics',
    component:Admin_Logistics,
    name:'admin.logistics'
   },
   {
    path: '/New/Logistics',
    component:Admin_New_Logistics,
    name:'admin.new_logistics'
   },
   {
    path: '/Edit/:id/Logistics',
    component:Admin_Edit_Logistics,
    name:'admin.edit_logistics',
    props:true
   },
   {
    path: '/Categories',
    component:Admin_Categories,
    name:'admin.categories'
   },
   {
    path: '/Add/Category',
    component:Admin_New_Category,
    name:'admin.new_category'
   },
   {
    path: '/Edit/:id/Category',
    component:Admin_Edit_Category,
    name:'admin.edit_category',
    props:true
   },
   {
    path: '/Product/Store',
    component: Admin_Store,
    name:'admin.store'
   },
     ],

});
