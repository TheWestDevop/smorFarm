<template>
    <div class="page-section mb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                    <!-- CheckOut Form -->

                    <div class="login-form bg-gray">

                        <div class="container">
                            <h4 class="font-weight-bold">CART ITEMS</h4>


                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Product Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(cart,n) in cart" :key="cart.id">
                                        <td><img :src="`/storage/images/product/${cart.image}`" class="cart-image" alt="cart products" /></td>
                                        <td class=" mt-5">{{cart.name}}</td>
                                        <td class="text-center">&#8358;{{cart.price}}</td>
                                        <td class="text-center">{{cart.quantity}}</td>
                                        <td>
                                            <button class="close text-center" @click="removeCart(n)" title="Remove">
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <b class="mt-2 p-2 font-italic text-danger">{{errorOrder}}</b>
                            <b class="mt-2 p-2 font-italic text-danger">{{errorCart}}</b>
                        <p class="minicart-total ml-3 h3">
                            TOTAL:
                            <span>&#8358;{{total}}</span>
                        </p>
                        <div class="col-12">

                            <div v-if="check">
                                <br>
                                <button @click="makeOrder(app.auth.user_id)" v-if="cartEmpty" class="btn btn-success btn-block"><i class="fa fa-money"></i> Make Payment</button>
                            </div>
                            <div v-else>
                            <router-link :to="{name:'fast_track'}" v-if="cartEmpty">
                            <button type="submit"  class="btn btn-success btn-block">
                                <i class="fa fa-shopping-cart"></i> Fast Track Order
                            </button>
                            </router-link>
                             <router-link :to="{name:'auth.register'}" v-if="cartEmpty">
                                <button type="submit" class="btn btn-info btn-block mt-2">
                                    <i class="fa fa-user"></i> Be Our Customer
                                </button>
                            </router-link>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Auth from '../util/store'
import {post} from '../util/api'
import Flash from '../util/flash'
export default {
    name: "CheckOut",
    props: ['app'],
    data() {
        return {
            cart: [],
            total: '',
            errorOrder:"",
            errorCart:"",


        };
    },
    created() {
        this.viewCart();
        this.app.initUser();

    },
    computed:{
        check(){
        if (this.app.auth.api_token === "" || this.app.auth.api_token === null || this.app.auth.user_id === "" || this.app.auth.user_id === NaN
       ) {
                return false
            }
            return true
        },
         cartEmpty() {
            if (this.app.cart.length===0) {
                return false;
            }
            return true;
        }
    },
    methods: {


        viewCart() {
            if (localStorage.getItem('cart')) {
                this.cart = JSON.parse(localStorage.getItem('cart'));
                this.total = this.cart.reduce((total, item) => {
                    return total + item.quantity * item.price;
                }, 0);
            }

        },
        removeCart(product) {
            let $this = this;
            this.cart.splice(product, 1);
            $this.app.cart.splice(product, 1);
            $this.app.totalprice = this.cart.reduce((total, item) => {
                return total + item.quantity * item.price;
            }, 0);
            $this.app.badge = this.cart.length
            Event.$emit('CartRemove')
            this.storeCart();
        },
        storeCart() {
            let parsed = JSON.stringify(this.cart);
            localStorage.setItem('cart', parsed);
            this.viewCart();
        },
        makeOrder(id){
            let $this = this;

            if (localStorage.getItem('cart') == null || localStorage.getItem('cart') == ""){
              this.errorOrder = "Cart is Empty";
            }else{
             let form = new FormData();
             form.append('cart',localStorage.getItem('cart'))
             form.append('total',$this.app.totalprice)

             let data = form
                 post(BASE_URL + `/api/user/${id}/order/`, data).then(function(response) {
                    if(response.data){
                    $this.app.cart = [];
                    $this.app.badge = 0;
                    $this.app.totalprice = '';
                    localStorage.setItem('cart','');
                    $this.app.spin =false;
                    $this.app.$router.push({name: "home"});
                    Flash.setSuccessOrder(`Your Order is on it way and  your Order Ticket Id is ${response.data}`);
                     } else {
                        this.errorOrder = "Invalid User, Re-Login and Refresh";
                     }

                 });
            }
        }

    }
}
</script>
