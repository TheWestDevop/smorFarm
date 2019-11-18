<template>
    <div class="page-section  mb-60">

        <!-- Begin Product Area -->
        <div class="product-area pt-60 pb-50">

            <div class="container">

                <div class="tab-content">
                    <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                        <div class="row">
                            <div class="row" v-if="validateProduct(data)">
                                <div v-for="product in data" :key="product.id" class="col-lg-4 col-md-4">

                                    <div class="single-product-wrap m-2">
                                        <div class="product-image">

                                            <img :src="`/storage/images/product/${product.product_image}`" alt="Li's Product Image">


                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        {{product.description}}
                                                    </h5>

                                                </div>
                                                <h4><a class="product_name" href="#">{{product.title}}</a></h4>
                                                <div class="price-box">
                                                    <span class="new-price">&#8358;{{product.price}}</span>
                                                </div>
                                                <div class="add-action">
                                                    <ul class="add-actions-link mb-4">
                                                        <li class="add-cart">
                                                            <div class="text-center" @click="addCart(product)">Add to cart</div>
                                                        </li>
                                                      <li><input type="number" v-model="quantity" class="text-center mr-3" style="background: #753585;color:white; width:55px; height:30px;"></li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
import {
    get
} from "../util/api";

export default {
    name: 'product_category',
    props: ['app'],
    components: {
        pagination
    },
    data() {
        return {
            quantity: 1,
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
        addCart(product) {
            let $this = this;
            $this.app.cartadd.id = product.id;
            $this.app.cartadd.name = product.title;
            $this.app.cartadd.price = product.price;
            $this.app.cartadd.image = product.product_image;
            $this.app.cartadd.quantity = this.quantity;
            $this.app.cart.push($this.app.cartadd);
            $this.app.cartadd = {}
            this.quantity = 1;
            this.storeCart();

        },
        storeCart() {
            let $this = this;
            let parsed = JSON.stringify($this.app.cart);
            localStorage.setItem('cart', parsed);
            this.viewCart();
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
