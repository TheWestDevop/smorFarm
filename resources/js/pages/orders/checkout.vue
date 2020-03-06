<template>
    <div class="checkout-area pt-60 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="coupon-accordion">
                        <!--Accordion Start-->
                        <h3 v-if="this.$store.getters.AUTH_STATUS === false">
                            Returning customer?
                            <router-link :to="{name:'auth.login'}">
                                <span id="showlogin">Click here to login</span>
                            </router-link>
                        </h3>

                        <!--Accordion End-->
                        <!--Accordion Start-->
                        <h3>
                            Have a coupon?
                            <span id="showcoupon">Click here to enter your code</span>
                        </h3>
                        <div id="checkout_coupon" class="coupon-checkout-content">
                            <div class="coupon-info">
                                <form action="#">
                                    <p class="checkout-coupon">
                                        <input placeholder="Coupon code" type="text" />
                                        <input value="Apply Coupon" type="submit" />
                                    </p>
                                </form>
                            </div>
                        </div>
                        <!--Accordion End-->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <form action="#">
                        <div class="checkbox-form">
                            <h3>Billing Details</h3>
                            <div class="row">
                                <div class="col-md-12" v-if="this.$store.getters.AUTH_STATUS === false">
                                    <div class="country-select">
                                        <label>
                                            Country
                                            <span class="required">*</span>
                                        </label>
                                        <input type="text" v-model="country" readonly="true" />
                                    </div>
                                </div>
                                <div class="col-md-6" v-if="this.$store.getters.AUTH_STATUS === false">
                                    <div class="checkout-form-list">
                                        <label>
                                            First Name
                                            <span class="required">*</span>
                                        </label>
                                        <input placeholder v-model="fname" type="text" />
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorFname}}</div>
                                    </div>
                                </div>
                                <div class="col-md-6" v-if="this.$store.getters.AUTH_STATUS === false">
                                    <div class="checkout-form-list">
                                        <label>
                                            Last Name
                                            <span class="required">*</span>
                                        </label>
                                        <input placeholder v-model="lname" type="text" />
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorLname}}</div>
                                    </div>
                                </div>
                                <div class="col-md-12" v-if="this.$store.getters.AUTH_STATUS === false">
                                    <div class="country-select clearfix">
                                        <label>
                                            Gender
                                            <span class="required">*</span>
                                        </label>
                                        <select v-model="gender">
                                            <option value="0">Female</option>
                                            <option value="1">Male</option>
                                            <option value="">---Select Gender---</option>
                                        </select>
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorGender}}</div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="checkout-form-list" v-if="this.$store.getters.AUTH_STATUS === false">
                                        <label>
                                            Address
                                            <span class="required">*</span>
                                        </label>
                                        <input placeholder="Street address" v-model="address" type="text" />
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorAddress}}</div>
                                    </div>
                                </div>
                                <div class="col-md-12" v-if="this.$store.getters.AUTH_STATUS === false">
                                    <div class="checkout-form-list">
                                        <input placeholder="Apartment, suite, unit etc. (optional)" v-model="apartment" type="text" />
                                    </div>
                                </div>

                                <div class="col-md-6" v-if="this.$store.getters.AUTH_STATUS === false">
                                    <div class="checkout-form-list">
                                        <label>
                                            State
                                            <span class="required">*</span>
                                        </label>
                                        <input type="text" v-model="state" readonly="true" />
                                    </div>
                                </div>

                                <div class="col-md-6" v-if="this.$store.getters.AUTH_STATUS === false">
                                    <div class="checkout-form-list">
                                        <label>
                                            Email Address
                                            <span class="required">*</span>
                                        </label>
                                        <input placeholder v-model="email" type="email" />
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorEmail}}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list" v-if="this.$store.getters.AUTH_STATUS === false">
                                        <label>
                                            Phone
                                            <span class="required">*</span>
                                        </label>
                                        <input type="text" v-model="phone" />
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorPhone}}</div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="different-address">
                                <div class="ship-different-title">
                                    <h3>
                                        <label>Deliver to a different address?</label>
                                        <input id="ship-box" v-model="ship_2" type="checkbox" />
                                    </h3>
                                </div>
                                <div id="ship-box-info" class="row" style="display: none;">
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>
                                                First Name
                                                <span class="required">*</span>
                                            </label>
                                            <input placeholder v-model="ship_2_fname" type="text" />
                                            <div class="mt-2 p-2 font-italic text-danger">{{errorDeliverFname}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>
                                                Last Name
                                                <span class="required">*</span>
                                            </label>
                                            <input placeholder v-model="ship_2_lname" type="text" />
                                            <div class="mt-2 p-2 font-italic text-danger">{{errorDeliverLname}}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>
                                                Address
                                                <span class="required">*</span>
                                            </label>
                                            <input placeholder="Street address" v-model="ship_2_address" type="text" />
                                            <div class="mt-2 p-2 font-italic text-danger">{{errorDeliverAddress}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <input placeholder="Apartment, suite, unit etc. (optional)" v-model="ship_2_apartment" type="text" />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>
                                                Email Address
                                                <span class="required">*</span>
                                            </label>
                                            <input placeholder v-model="ship_2_email" type="email" />
                                            <div class="mt-2 p-2 font-italic text-danger">{{errorDeliverEmail}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>
                                                Phone
                                                <span class="required">*</span>
                                            </label>
                                            <input type="text" v-model="ship_2_phone" />
                                            <div class="mt-2 p-2 font-italic text-danger">{{errorDeliverPhone}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-notes">
                                    <div class="checkout-form-list">
                                        <label>Order Notes</label>
                                        <textarea id="checkout-mess" v-model="order_note" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="different-address" v-if="this.$store.getters.AUTH_STATUS === true">
                                <div class="ship-different-title">
                                    <h4>
                                        <label>You Want Us Deliver The Order Later ?</label>
                                        <input v-model="pre_orders" type="checkbox" />
                                    </h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>
                                                Date
                                                <span class="required">*</span>
                                            </label>
                                            <input placeholder v-model="pre_order_date" type="date" />
                                            <br>
                                            <div class="mt-2 p-2 font-italic text-danger">{{errorDate}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>
                                                Time
                                                <span class="required">*</span>
                                            </label>
                                            <select v-model="pre_order_time" >
                                                <option value="6:00pm">6:00pm</option>
                                                <option value="4:00pm">4:00pm</option>
                                                <option value="2:00pm">2:00pm</option>
                                                <option value="12:00pm">12:00pm</option>
                                                <option value="10:00am">10:00am</option>
                                                <option value="8:00am">8:00am</option>
                                                <option value="">---Select Time---</option>
                                            </select>
                                            <br>
                                            <div class="mt-2 p-2 font-italic text-danger">{{errorTime}}</div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="your-order">
                        <h3>Your order</h3>
                        <div class="your-order-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="cart-product-name">Product</th>
                                        <th class="cart-product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="cart_item" v-for="product in $store.getters.CART" :key="product.id">
                                        <td class="cart-product-name">
                                            {{product.name}}
                                            <strong class="product-quantity">× {{product.quantity}}</strong>
                                        </td>
                                        <td class="cart-product-total">
                                            <span class="amount">&#8358;{{product.price * product.quantity}}</span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td>
                                            <span class="amount">&#8358;{{$store.getters.CART_TOTAL}}</span>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td>
                                            <strong>
                                                <span class="amount">&#8358;{{$store.getters.TOTAL}}</span>
                                            </strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div id="accordion">
                                    <div class="card active">
                                        <div class="card-header" id="#payment-1">
                                            <h5 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Direct Bank Transfer.</a>
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="collapse" data-parent="#accordion" style>
                                            <div class="card-body">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be delivered until the funds have cleared in our account.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-button-payment" v-if="this.$store.getters.AUTH_STATUS === false">

                                    <button @click.prevent="Order()" class="btn-1"  >Place order <i class="fa fa-cart-plus"></i></button>
                                    
                                </div>
                                <div class="order-button-payment" v-else>
                                    <button @click.prevent="User_Order()" class="btn-1 github-btn" v-if="!pre_orders" >Place order <i class="fa fa-cart-plus"></i></button>
                                    <button @click.prevent="Pre_Order()" v-else  class="btn-2 github-btn">Place Pre order <i class="fa fa-calendar"></i></button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Checkout",
    data() {
        return {
            pre_orders: '',
            pre_order_date: "",
            errorDate: "",
            pre_order_time: "",
            errorTime: "",
            ship_2: "",
            state: "Lagos",
            country: "Nigeria",
            fname: "",
            ship_2_fname: "",
            errorDeliverFname: "",
            errorFname: "",
            lname: "",
            ship_2_lname: "",
            errorDeliverLname: "",
            errorLname: "",
            address: "",
            ship_2_address: "",
            errorDeliverAddress: "",
            errorAddress: "",
            apartment: "",
            ship_2_apartment: "",
            phone: "",
            ship_2_phone: "",
            errorDeliverPhone: "",
            errorPhone: "",
            gender: "",
            errorGender: "",
            email: "",
            ship_2_email: "",
            errorDeliverEmail: "",
            errorEmail: "",
            password: '',
            errorPassword: "",
            errorDelivers: [],
            errors: [],
            order_note: '',
        };
    },
    methods: {
        Order() {
            this.errors = [];

            let $this = this;

            if (this.fname.length < 3 || this.fname === "") {
                this.errorFname = "First Name is Required";
                this.errors.push(this.errorFname);
            } else {
                this.errorFname = null;
            }
            if (this.lname.length < 3 || this.lname === "") {
                this.errorLname = "Last Name is Required";
                this.errors.push(this.errorLname);
            } else {
                this.errorLname = null;
            }

            if (this.address == "" || this.address.length < 10) {
                this.errorAddress = "Address is Required";
                this.errors.push(this.errorAddress);
            } else {
                this.errorAddress = null;
            }

            if (this.gender == "" || this.gender == null) {
                this.errorGender = "Gender is Required";
                this.errors.push(this.errorGender);
            } else {
                this.errorGender = null;
            }
            if (this.email == "" || this.email.length < 5) {
                this.errorEmail = "Email is Required";
                this.errors.push(this.errorEmail);
            } else {
                this.errorEmail = null;
            }

            if (this.phone.length < 10 || this.phone == "") {
                this.errorPhone = "invalid Phone number";
                this.errors.push(this.errorPhone);
            } else {
                this.errorPhone = null;
            }
            
            if (this.ship_2) {
                if (this.ship_2_fname.length < 3 || this.ship_2_fname === "") {
                    this.errorDeliverFname = "First Name is Required";
                    this.errorDelivers.push(this.errorDeliverFname);
                } else {
                    this.errorDeliverFname = null;
                }
                if (this.ship_2_lname.length < 3 || this.ship_2_lname === "") {
                    this.errorDeliverLname = "Last Name is Required";
                    this.errorDelivers.push(this.errorDeliverLname);
                } else {
                    this.errorDeliverLname = null;
                }

                if (this.ship_2_address == "" || this.ship_2_address.length < 10) {
                    this.errorDeliverAddress = "Address is Required";
                    this.errorDelivers.push(this.errorDeliverAddress);
                } else {
                    this.errorDeliverAddress = null;
                }

                if (this.ship_2_email == "" || this.ship_2_email.length < 5) {
                    this.errorDeliverEmail = "Email is Required";
                    this.errorDelivers.push(this.errorDeliverEmail);
                } else {
                    this.errorDeliverEmail = null;
                }

                if (this.ship_2_phone.length < 11 || this.ship_2_phone == "") {
                    this.errorDeliverPhone = "invalid Phone number";
                    this.errorDelivers.push(this.errorDeliverPhone);
                } else {
                    this.errorDeliverPhone = null;
                }

                if (!this.errorDelivers.length) {
                    let full_name = this.ship_2_fname + ' ' + this.ship_2_lname
                    let DeliverDetail = {
                        name: full_name,
                        address: this.ship_2_address,
                        email: this.ship_2_email,
                        phone: this.ship_2_phone,
                        note: this.order_note
                    }
                    this.$store.dispatch('deliverTo', DeliverDetail);
                }
            }

            if (!this.errors.length) {
                let full_name = this.fname + ' ' + this.lname
                let userData = {
                    name: full_name,
                    address: this.address,
                    gender: this.gender,
                    phone: this.phone,
                    email: this.email,
                    apartment: this.apartment,
                    note: this.order_note

                };
                
                if (!this.ship_2 && this.$store.getters.AUTH_STATUS === false) {
                    this.$store.dispatch('deliverTo', userData);
                }
                
                
                    this.$store.dispatch('fastUser', userData);
                

                this.$router.push({
                    name: "payment"
                });
            }
        },
        Pre_Order() {
            this.errors = [];

            let $this = this;

            
              if (this.pre_order_date === "") {
                    this.errorDate = "Pre Order Delivery Date is Required";
                    this.errors.push(this.errorDate);
                } else {
                    this.errorDate = null;
                }
                if (this.pre_order_time === "") {
                    this.errorTime = "Pre Order Delivery Time is Required";
                    this.errors.push(this.errorTime);
                } else {
                    this.errorTime = null;
                }
            

            if (this.ship_2) {
                if (this.ship_2_fname.length < 3 || this.ship_2_fname === "") {
                    this.errorDeliverFname = "First Name is Required";
                    this.errorDelivers.push(this.errorDeliverFname);
                } else {
                    this.errorDeliverFname = null;
                }
                if (this.ship_2_lname.length < 3 || this.ship_2_lname === "") {
                    this.errorDeliverLname = "Last Name is Required";
                    this.errorDelivers.push(this.errorDeliverLname);
                } else {
                    this.errorDeliverLname = null;
                }

                if (this.ship_2_address == "" || this.ship_2_address.length < 10) {
                    this.errorDeliverAddress = "Address is Required";
                    this.errorDelivers.push(this.errorDeliverAddress);
                } else {
                    this.errorDeliverAddress = null;
                }

                if (this.ship_2_email == "" || this.ship_2_email.length < 5) {
                    this.errorDeliverEmail = "Email is Required";
                    this.errorDelivers.push(this.errorDeliverEmail);
                } else {
                    this.errorDeliverEmail = null;
                }

                if (this.ship_2_phone.length < 11 || this.ship_2_phone == "") {
                    this.errorDeliverPhone = "invalid Phone number";
                    this.errorDelivers.push(this.errorDeliverPhone);
                } else {
                    this.errorDeliverPhone = null;
                }

                if (!this.errorDelivers.length) {
                    let full_name = this.ship_2_fname + ' ' + this.ship_2_lname
                    let DeliverDetail = {
                        name: full_name,
                        address: this.ship_2_address,
                        email: this.ship_2_email,
                        phone: this.ship_2_phone
                    }
                    this.$store.dispatch('DeliverTo', DeliverDetail);
                }
            }

            if (!this.errors.length) {
              

                let info = {
                    date: this.pre_order_date,
                    time: this.pre_order_time
                }

                if (!this.ship_2) {
                    this.$store.dispatch('deliverTo', this.$store.getters.USER.profile);
                }

                this.$store.dispatch('preOrderDeliveryInfo', info);
                this.$router.push({
                    name: "payment"
                });
            }
        },
        User_Order(){
            if (this.ship_2) {
                if (this.ship_2_fname.length < 3 || this.ship_2_fname === "") {
                    this.errorDeliverFname = "First Name is Required";
                    this.errorDelivers.push(this.errorDeliverFname);
                } else {
                    this.errorDeliverFname = null;
                }
                if (this.ship_2_lname.length < 3 || this.ship_2_lname === "") {
                    this.errorDeliverLname = "Last Name is Required";
                    this.errorDelivers.push(this.errorDeliverLname);
                } else {
                    this.errorDeliverLname = null;
                }

                if (this.ship_2_address == "" || this.ship_2_address.length < 10) {
                    this.errorDeliverAddress = "Address is Required";
                    this.errorDelivers.push(this.errorDeliverAddress);
                } else {
                    this.errorDeliverAddress = null;
                }

                if (this.ship_2_email == "" || this.ship_2_email.length < 5) {
                    this.errorDeliverEmail = "Email is Required";
                    this.errorDelivers.push(this.errorDeliverEmail);
                } else {
                    this.errorDeliverEmail = null;
                }

                if (this.ship_2_phone.length < 11 || this.ship_2_phone == "") {
                    this.errorDeliverPhone = "invalid Phone number";
                    this.errorDelivers.push(this.errorDeliverPhone);
                } else {
                    this.errorDeliverPhone = null;
                }

                if (!this.errorDelivers.length) {
                    let full_name = this.ship_2_fname + ' ' + this.ship_2_lname
                    let DeliverDetail = {
                        name: full_name,
                        address: this.ship_2_address,
                        email: this.ship_2_email,
                        phone: this.ship_2_phone,
                        note: this.order_note
                    }
                    this.$store.dispatch('deliverTo', DeliverDetail);
                }
            }

            
            
                
                if (!this.ship_2 && this.$store.getters.AUTH_STATUS === true) {
                    this.$store.dispatch('deliverTo', this.$store.getters.USER.profile);
                }
                
                this.$router.push({
                    name: "payment"
                });
            
        }
    }
};
</script>

<style>
</style>
