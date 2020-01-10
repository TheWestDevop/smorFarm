<template>
    <div class="page-section mb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-md-8 col-xs-8 col-lg-8 mb-30">
                    <div class="login-form bg-gray">
                        <div class="container">
                            <h4>Review Your Order</h4>
                            <div class="container">
                                <div class="delivery-time">
                                    <br><br>
                                    <h4 class="">Delivery Time</h4>
                                    <div class="row">
                                        <div class="col-md-6 mb-20">

                                            <select v-model="deliveryState" >
                                                <option value="0" >As Soon As Possible</option>
                                                <option value="1">Later</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div v-if="deliveryState==1">
                                        <p class="text-gray">
                                     Specified Delivery Date and Time
                                    </p>
                                        <div class="row">
                                        <div class="col-md-6 mb-20">
                                        <input class="mb-0" type="date"  value="2020-01-01" v-model="deliver_later_date" @change="delivery_state" />
                                        </div>
                                        <div class="col-md-6 mb-20">
                                        <input class="mb-0" type="time" v-model="deliver_later_time"  @change="delivery_state"/>
                                        </div>
                                    </div>
                                    </div>
                                    <p class="text-gray" v-else>
                                     Estimated Delivery Time 00:30 Hour
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-sm-4 col-md-4 col-xs-4 col-lg-4 mb-30">

                    <div class="login-form bg-gray">

                        <div class="container">
                            <h4>Your Cart</h4>

                            <div v-for="(cart,n) in cart" :key="cart.id">
                                <div class="m-2">
                                    <div class="d-inline">
                                        <strong class=" mt-5">{{cart.name}}</strong>
                                        <div class="float-right text-center">&#8358;{{cart.price}}</div>
                                    </div>
                                    <br>
                                    <div class="d-inline">
                                        <div class="d-inline-flex">
                                            <i class="fa fa-minus fa-1x decrease m-2" @click="decrease(n)"></i>
                                            <div class="m-2">{{cart.quantity }}</div>
                                            <i class="fa  fa-plus fa-1x increase m-2" @click="increase(n)"></i>

                                        </div>

                                        <div class="float-right text-center">
                                            <i class="text-danger fa fa-close" @click="removeCart(n)"></i>
                                        </div>

                                    </div>
                                    <hr class="hr">
                                </div>

                            </div>

                        </div>
                        <div class=" cart-footer">

                            <b class="mt-2 p-2 font-italic text-danger">{{errorOrder}}</b>
                            <b class="mt-2 p-2 font-italic text-danger">{{errorCart}}</b>
                            <div class="d-inline">
                                <div class="float-left">Sub Total</div>
                                <div class="float-right text-center">&#8358;{{total}}</div>
                            </div>
                            <br>
                            <div class="d-inline">
                                <div class="float-left">Delivery Fee</div>
                                <div class="float-right text-center">&#8358;{{delivery}}</div>
                            </div>
                            <br>
                            <div class="d-inline">
                                <div class="float-left">Service Charges</div>
                                <span class="float-right text-center">&#8358;{{service_charge}}</span>
                            </div>
                            <br>
                            <div class="d-inline">
                                <div class="float-left">Service Tax</div>
                                <span class="float-right text-center">&#8358;{{service_tax}}</span>
                            </div>
                            <br>
                            <div class="d-inline">
                                <div class="float-left">Vat Charge</div>
                                <span class="float-right text-center">&#8358;{{vat}}</span>
                            </div>
                            <br>
                            <hr>
                            <div class="d-inline">
                                <strong class="float-left font-weight-bold">Amount Payable</strong>
                                <span class="float-right text-center font-weight-bold">&#8358;{{payable_total}}</span>
                            </div>

                        </div>
                        <div class="col-12 mt-3">

                            <div v-if="check">
                                <br>
                                 <small class="text-danger mt-1" v-if='app.user.profile.address == ""'>Update delivery address in your profile  </small>

                                    <button type="submit" class="btn btn-success btn-block mt-1" v-if="cartEmpty" @click="verifyDetails">
                                        <i class="fa fa-shopping-cart"></i> Place Order Now
                                    </button>


                               <!--
                                    <button @click="makeOrder(app.auth.user_id)"  class="btn btn-success btn-block">
                                        <i class="fa fa-money"></i> Place Order Now</button> -->
                            </div>
                            <div v-else>
                                <router-link :to="{name:'fast_track'}" v-if="cartEmpty">
                                    <button type="submit" class="btn btn-success btn-block">
                                        <i class="fa fa-shopping-cart"></i> Place Order Now
                                    </button>
                                </router-link>
                                <router-link :to="{name:'auth.login'}" v-if="cartEmpty">
                                    <button type="submit" class="btn btn-primary btn-block mt-2">
                                        <i class="fa fa-sign-in"></i> Place Order Now
                                    </button>
                                </router-link>
                                <router-link :to="{name:'auth.register'}" v-if="cartEmpty">
                                    <button type="submit" class="btn btn-info btn-block mt-2">
                                        <i class="fa fa-user"></i> Place Order Now
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
import {
    post
} from '../util/api'
import Flash from '../util/flash'
export default {
    name: "CheckOut",
    props: ['app'],
    data() {
        return {
            cart: [],
            total: 0,
            delivery: 500,
            service_charge: 25,
            service_tax: 25,
            vat: 10.00,
            deliveryState:0,
            deliver_later_date:'2020-01-01',
            deliver_later_time:'12:00',
            errorOrder: "",
            errorCart: "",

        };
    },
    created() {
        this.$on("CartRemoved", () => {
            this.viewCart();
        });
        this.viewCart();
        this.app.initUser();

    },
    computed: {
        check() {
            if (this.app.auth.api_token === "" || this.app.auth.api_token === null || this.app.auth.user_id === "" || this.app.auth.user_id === NaN) {
                return false
            }
            return true
        },
        cartEmpty() {
            if (this.app.cart.length === 0) {
                return false;
            }
            return true;
        },
        payable_total() {
            this.app.over_total = this.total + this.delivery + this.service_charge + this.service_tax + this.vat;
            return this.total + this.delivery + this.service_charge + this.service_tax + this.vat
        },

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
            this.$emit('CartRemove')
            this.storeCart();
            $this.$toast.info('Product removed', {
                position: 'bottom-center',
                timeout: 1000,
                closeOnClick: true,
                pauseOnFocusLoss: true,
                pauseOnHover: false,
                draggable: true,
                draggablePercent: 0.6,
                hideCloseButton: false,
                hideProgressBar: true,
                icon: true,
            })

        },
        storeCart() {
            let parsed = JSON.stringify(this.cart);
            localStorage.setItem('cart', parsed);
            this.viewCart();
        },

        decrease(product) {
            let $this = this;
            if (this.cart[product].quantity === 1) {
                return;
            }
            this.cart[product].quantity -= 1
            $this.app.totalprice = this.cart.reduce((total, item) => {
                return total + item.quantity * item.price;
            }, 0);
            this.storeCart()
        },
        increase(product) {
            let $this = this;
            this.cart[product].quantity += 1
            $this.app.totalprice = this.cart.reduce((total, item) => {
                return total + item.quantity * item.price;
            }, 0);
            this.storeCart()
        },
        delivery_state(){
           let $this = this;
           if (this.deliveryState==1) {
              $this.app.deliveryState = this.deliveryState
              $this.app.deliveryOn.delivery_date = this.deliver_later_date
              $this.app.deliveryOn.delivery_time = this.deliver_later_time
           }
        },
        verifyDetails(){
            if (this.app.user.profile.address === "" || this.app.user === ""  ) {
             this.$toast.error('Update delivery address in your profile ', {
                position: 'bottom-center',
                timeout: 1000,
                closeOnClick: true,
                pauseOnFocusLoss: true,
                pauseOnHover: false,
                draggable: true,
                draggablePercent: 0.6,
                hideCloseButton: false,
                hideProgressBar: true,
                icon: true,
            })
            } else {
              this.$router.push({
                    name: "payment"
                });
            }

        }


    }
}
</script>
