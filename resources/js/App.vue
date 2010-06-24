<template>
    <div class="body-wrapper">
        <Navbar :app="this"></Navbar>
        <div class="alert alert-success text-center w-50 mx-auto" v-if="flash.success">
            {{flash.success}}
        </div>
        <div class="alert alert-danger text-center  w-50 mx-auto" v-if="flash.error">
            {{flash.error}}
        </div>
          <div align="center" class="row justify-content-center mt-lg-200 pb-200" v-if="spin">
              <br><br><br><br><br><br>
             <img src="images/spinner/spinner2.svg" />
             <br><br><br><br><br><br><br><br><br><br><br><br><br>
          </div>
        <router-view :app="this" v-else ></router-view>
        <Footer></Footer>

    </div>
</template>

<script>
import Navbar from './components/navbar.vue';
import Footer from './components/footer.vue';
import CheckOut from './pages/checkout.vue';
import FastTrack from './pages/fast_track.vue';
import Mall from './pages/mall.vue';
import Flash from './util/flash';
import Auth from './util/store'
import {
    get
} from "./util/api";

export default {
    name: "app",
    components: {
        Navbar,
        Footer,
        CheckOut,
        FastTrack,
        Mall
    },
    data() {
        return {
            user:[],
            spin: false,
            badge: 0,
            flash: Flash.state,
            auth: Auth.state,
            categories: [],
            all:'',
            latest:'',
            rice: '',
            oil: '',
            pepper: '',
            vegetable: '',
            discount_products:{
            data:{} ,
            paginations:{
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1,
            last_page:0
             }
            },
            orders:{
            data:{} ,
            paginations:{
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1,
            last_page:0
             }
            },
            trending:'',
            tools:'',
            meat: '',
            nigeria:'',
            imported:'',
            cart: [],
            cartadd: {
                id:'',
                name:'',
                price:'',
                image:'',
                quantity:''
            },
            totalprice:'',
            all_products:{
            data:{} ,
            paginations:{
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1,
            last_page:0
             }
            }

        }
    },
    methods: {
        initUser() {

            get(BASE_URL + '/api/auth/init').then((response) => {
                if (response.data.id) {
                    Auth.set(response.data.api_token, response.data.id);
                    this.user = response.data;
                    this.getOrders(response.data.id);
                }else{
                    console.log('')
                }

            })
        },
        getCategory() {

            let $this = this;
            get(BASE_URL + "/api/all/categories").then(function (response) {
                if (response.data) {
                    $this.categories = response.data;
                }
            });
        },
        getAllProduct() {

            let $this = this;
            get(BASE_URL + "/api/all/products").then(function (response) {
                if (response.data) {
                    $this.all_products.data = response.data.data;
                    $this.all_products.paginations.current_page = response.data.current_page;
                    $this.all_products.paginations.total = response.data.total;
                    $this.all_products.paginations.per_page = response.data.per_page;
                    $this.all_products.paginations.last_page = response.data.last_page;
                    $this.all_products.paginations.from = response.data.from;
                    $this.all_products.paginations.to = response.data.to;
                }
            });
        },
        getAllDiscount() {

            let $this = this;
            get(BASE_URL + "/api/all/products/low/discount/").then(function (response) {
                if (response.data) {
                    $this.discount_products.data = response.data.data;
                    $this.discount_products.paginations.current_page = response.data.current_page;
                    $this.discount_products.paginations.total = response.data.total;
                    $this.discount_products.paginations.per_page = response.data.per_page;
                    $this.discount_products.paginations.last_page = response.data.last_page;
                    $this.discount_products.paginations.from = response.data.from;
                    $this.discount_products.paginations.to = response.data.to;
                }
            });
        },
        getAllTools() {
            let $this = this;
            let data = 'Kitchen Tools';
            get(BASE_URL + "/api/all/products/category/"+ data).then(function (response) {
                if (response.data) {
                    $this.tools = response.data.data ;

                }
            });
        },
        getOrders(id){
            let $this = this;
          get(BASE_URL+`/api/user/${id}/order`).then(function (response) {
                    if (response.data) {

                        $this.orders.data = response.data.data
                        $this.orders.paginations.current_page = response.data.current_page;
                        $this.orders.paginations.total = response.data.total;
                        $this.orders.paginations.per_page = response.data.per_page;
                        $this.orders.paginations.last_page = response.data.last_page;
                        $this.orders.paginations.from = response.data.from;
                        $this.orders.paginations.to = response.data.to;
                    }

                })
        }


    },
    created() {
        this.spin = true;
        this.getCategory(),
        this.getAllProduct(),
        this.getAllDiscount(),
        this.getAllTools()
        Auth.init()
        this.initUser()
        Event.$on('Loggedin...',()=>{
            this.initUser()

        })
        this.spin = false;
    },
}
</script>

<style >

</style>
