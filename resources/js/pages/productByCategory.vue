<template>
    <div class="page-section  mb-60">

        <!-- Begin Product Area -->
        <div class="product-area pt-60 pb-50">

            <div class="container">

                <div class="tab-content">
                    <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                        <div class="row">
                            <div class="row" v-if="validateProduct(data)">
                                <div v-for="product in data" :key="product.id" class="col m-2">

                                   <Product :app="app" :product="product" />

                                </div>
                            </div>
                            <div class="row" v-else>

                                <div class="col-lg-12 text-center mx-auto">
                                    <p class="text-black font-weight-bold mt-5 p-5">No Product Found </p>
                                </div>

                            </div>

                        </div>

                        <div class="row justify-content-center">
                            <pagination :paginations="app.all_products.paginations" @paginate="getProduct()" :offset="4">
                            </pagination>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- Product Area End Here -->
    </div>
</template>

<script>
import Auth from '../util/store';
import pagination from '../components/pagination.vue'
import Product from '../components/product.vue'
import {
    get
} from "../util/api";

export default {
    name: 'product_category',
    props: ['app'],
    components: {
        pagination,
        Product
    },
    data() {
        return {
            category: "",
            data: []
        }
    },
    created() {
        this.category = this.$route.params.category;
        Event.$on('productCategory',()=>{
            console.log("event started....")
            this.getProduct()
        })
        let $this = this;
        $this.app.spin = true;
        this.viewCart()
        this.getProduct()
        $this.app.spin = false;
    },

    methods: {
        getProduct() {
            let $this = this;
            $this.app.spin = true;
            get(BASE_URL + "/api/all/products/category/" + this.category).then((response) => {
                $this.app.spin = false;
                $this.data = response.data.data;
                $this.app.all_products.paginations.current_page = response.data.current_page;
                $this.app.all_products.paginations.total = response.data.total;
                $this.app.all_products.paginations.per_page = response.data.per_page;
                $this.app.all_products.paginations.last_page = response.data.last_page;
                $this.app.all_products.paginations.from = response.data.from;
                $this.app.all_products.paginations.to = response.data.to;
                $this.app.spin = false;

            });

        },
         gotoCategory(){
            Event.$emit('productCategory')
         },
        viewCart() {
            let $this = this;
            if (localStorage.getItem('cart')) {
                $this.app.cart = JSON.parse(localStorage.getItem('cart'));
                $this.app.badge = $this.app.cart.length;
                $this.app.totalprice = $this.app.cart.reduce((total, item) => {
                    return total + item.quantity * item.price;
                }, 0);
            }

        },
        validateProduct(product) {
            if (product == '') {
                return false;
            }
            return true;
        },

    },

};
</script>
