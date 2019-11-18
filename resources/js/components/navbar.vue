<template>
    <!-- Begin Header Area -->
    <header>
        <!-- Begin Header Top Area -->
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <!-- Begin Header Top Left Area -->
                    <div class="col-lg-6 col-md-6">
                        <div class="header-top-left d-lg-flex">
                            <div class="m-2">
                                <span>Telephone Enquiry:</span>
                                <a href="#">(+123) 123 321 345</a>
                            </div>
                            <div class="m-2">
                                <span>Email:</span>
                                <a href="#">info@smorfarm.com</a>
                            </div>
                        </div>
                    </div>
                    <!-- Header Top Left Area End Here -->
                    <!-- Begin Header Top Right Area -->
                    <div class="col-lg-6 col-md-6">
                        <div class="header-top-right">
                            <ul class="ht-menu" v-if="valid">
                                <!-- Begin Setting Area -->
                                <li>{{ app.user.name }}</li>
                                <li v-if="valid">
                                    <router-link :to="{name:'profile'}">Profile</router-link>
                                </li>
                                <li v-if="valid">
                                    <a @click.stop="logout" href="javascript:;">Log out</a>
                                </li>
                            </ul>
                            <ul class="ht-menu" v-else>
                                <li>
                                    <i class="fa fa-user text-black"></i>
                                </li>
                                <li class="font-italic text-black">
                                    <router-link :to="{name:'auth.login'}" class="text-black">Login</router-link>
                                </li>
                                <li class="font-italic text-black">
                                    <router-link :to="{name:'auth.register'}" class="text-black">Register</router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Header Top Right Area End Here -->
                </div>
            </div>
        </div>
        <!-- Header Top Area End Here -->
        <!-- Begin Header Middle Area -->
        <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
            <div class="container">
                <div class="row">
                    <!-- Begin Header Logo Area -->
                    <div class="col-lg-3">
                        <div class="logo pb-sm-30 pb-xs-30">
                            <router-link :to="{name:'home'}">
                                <div class="h1 text-black">
                                    <strong class="mor">SMOR</strong>
                                    Farm
                                </div>
                            </router-link>
                        </div>
                    </div>
                    <!-- Header Logo Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                        <!-- Begin Header Middle Searchbox Area -->
                        <form v-on:submit.prevent="search" class="hm-searchbox mr-4">
                            <input type="text" v-model="word" placeholder="Search Product ..." />
                            <button class="li-btn" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                        <!-- Header Middle Searchbox Area End Here -->
                        <div class="header-middle-right">

                            <div class="hm-menu">
                                <div class="hm-minicart-trigger" data-toggle="modal" data-target="#myModal">
                                    <span class="item-icon"></span>
                                    <span class="item-text">
                                        &#8358; {{app.totalprice}}
                                        <span class="cart-item-count">{{app.badge}}</span>
                                    </span>
                                </div>
                                <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content mt-100">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Cart Items </h4>
                                            </div>
                                            <div class="minicart">
                                                <ul class="minicart-product-list">
                                                    <li v-for="(cart,n) in app.cart" :key="cart.id">
                                                        <a href="#" class="minicart-product-image">
                                                            <img :src="`/storage/images/product/${cart.image}`" alt="cart products" />
                                                        </a>
                                                        <div class="minicart-product-details">
                                                            <h6>
                                                                <a href="#">{{cart.name}}</a>
                                                            </h6>
                                                            <span class="text-black">&#8358; {{cart.price}} x {{cart.quantity}}</span>
                                                        </div>
                                                        <button class="close" @click="removeCart(n)" title="Remove">
                                                            <i class="fa fa-close"></i>
                                                        </button>
                                                    </li>

                                                </ul>
                                                <p class="minicart-total">
                                                    SUBTOTAL:
                                                    <span>&#8358; {{app.totalprice}}</span>
                                                </p>
                                                <div class="minicart-button">

                                                    <div v-if="cartEmpty">

                                                    </div>
                                                    <router-link :to="{name:'checkout'}" v-else class="li-button li-button-fullwidth"  data-dismiss="modal">
                                                        <span>Checkout</span>
                                                    </router-link>

                                                    <button type="button" class="mt-2 btn btn-danger btn-block li-button-fullwidth " data-dismiss="modal">Close</button>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Header Middle Right Area End Here -->
                </div>
            </div>
        </div>
        <!-- Header Middle Area End Here -->
        <!-- Begin Header Bottom Area -->
        <div class="header-bottom header-sticky d-none d-lg-block d-xl-block justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-2 col-lg-2"></div>
                    <div class="col-lg-10">
                        <!-- Begin Header Bottom Menu Area -->
                        <div class="hb-menu">
                            <nav>
                                <ul>
                                    <li>
                                        <router-link :to="{name:'home'}">Home</router-link>
                                    </li>
                                    <li class="megamenu-holder">
                                        <a href="#">Categories</a>
                                        <div class="megamenu hb-megamenu container-fluid">

                                            <router-link class="category" :to="{name:'mall'}">&nbsp;All&nbsp; </router-link>
                                            <br>
            <router-link class="category" v-for="category in app.categories" :key="category.id" :to="{name:'ProductByCategory', params:{category:category.title}}">
                &nbsp;{{category.title}}&nbsp;
            </router-link>






                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Smor Restuarant</a>
                                    </li>
                                    <li>
                                        <a href="#">Smor Caterer</a>
                                    </li>
                                    <li>
                                        <router-link :to="{name:'order_status'}">Check Order Status</router-link>
                                    </li>
                                    <li>
                                        <a href="#">About Us</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact</a>
                                    </li>

                                </ul>

                            </nav>
                        </div>
                        <!-- Header Bottom Menu Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Bottom Area End Here -->
        <!-- Begin Mobile Menu Area -->
        <div class="mobile-menu-area d-lg-none d-xl-none col-12 ml-1">
            <div class="container">
                <div class="row">
                    <div class="mobile-menu"></div>
                </div>
            </div>
        </div>
        <!-- Mobile Menu Area End Here -->

    </header>
    <!-- Header Area End Here -->
</template>

<script>
import Flash from "../util/flash";
import Auth from "../util/store";
import {
    get
} from "../util/api";



export default {
    name: "Navbar",
    props: ["app"],

    created() {
        Event.$on("CartRemove", ()=>{this.refCart()});
        this.refCart(),

       Event.$on('Loggedin...',()=>{
            this.app.initUser()
            Auth.init()
        })
    },
    data() {
        return {
            word:''
        };
    },
    computed: {
        valid() {
            if (this.app.auth.api_token && this.app.auth.user_id) {
                return true;
            }
            return false;
        },
        cartEmpty() {
            if (this.app.cart.length===0) {
                return true;
            }
            return false;
        }
    },
    methods: {
        logout() {
            let $this = this;
            $this.app.spin = true;
            get(BASE_URL + "/api/auth/logout").then(() => {
                Auth.remove(),
                    this.app.user = "",
                    Flash.setSuccess("You have successfully logged out!");
                $this.app.spin = false;
                this.$router.push({
                    name: "auth.login"
                });
            });
        },

        removeCart(product) {
            let $this = this;
            $this.app.cart.splice(product, 1);
            this.storeCart();
        },
        storeCart() {
            let $this = this;
            let parsed = JSON.stringify($this.app.cart);
            localStorage.setItem('cart', parsed);
            this.refCart();
        },
        refCart() {
            let $this = this;
            if (localStorage.getItem('cart')) {
                $this.app.cart = JSON.parse(localStorage.getItem('cart'));
                $this.app.badge = $this.app.cart.length;
                $this.app.totalprice = $this.app.cart.reduce((total, item) => {
                    return total + item.quantity * item.price;
                }, 0);

            }

        },
        search(){
            let $this = this;
            Event.$emit('Search')

            $this.$router.push({
                    name: "Search",
                    params:{statement:this.word}
                });
                this.word = '';



        }

    }
};
</script>
