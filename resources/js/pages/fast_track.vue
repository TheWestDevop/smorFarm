<template>
  <div class="page-section mb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">

                    <div class="login-form bg-gray">
                      <h3 class="login-title">Customer Delivery Details</h3>
                    <div class="row">
                        <div class="col-md-6 col-12 mb-20">
                            <label>First Name</label>
                            <input class="mb-0" type="text" v-model="fname"  placeholder="First Name" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorFname}}</div>
                        </div>
                        <div class="col-md-6 col-12 mb-20">
                            <label>Last Name</label>
                            <input class="mb-0" type="text" v-model="lname"  placeholder="Last Name" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorLname}}</div>
                        </div>
                        <div class="col-md-12 mb-20">
                            <label>Gender </label>
                            <select v-model="gender"  class="mb-0">

                                <option value="1">Male</option>
                                <option value="0">Female</option>
                            </select>
                            <div class="mt-2 p-2 font-italic text-danger">{{errorGender}}</div>
                        </div>
                        <div class="col-md-12 mb-20">
                            <label>Delivery Address</label>
                            <input class="mb-0" type="text" v-model="address"  placeholder="Delivery Address" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorAddress}}</div>
                        </div>
                        <div class="col-md-12 mb-20">
                            <label>Alternative Address</label>
                            <input class="mb-0" type="text" v-model="alternate_address"  placeholder="Alternative Address" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorAlternateAddress}}</div>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label>Phone </label>
                            <input class="mb-0" type="text" v-model="phone"  placeholder="Phone Number" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorPhone}}</div>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label>Email </label>
                            <input class="mb-0" type="email" v-model="email"  placeholder="Email" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorEmail}}</div>
                        </div>
                        <div class="col-12">
                            <button @click="Order" class="btn btn-primary btn-block mt-0">Make Payment <i class="fa fa-thumbs-o-up"></i></button>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Flash from '../util/flash';
import {
    post
} from "../util/api";
export default {
name:'FastTrack',
props:['app'],
data() {
       return{

        fname: '',
        errorFname: '',
        lname: '',
        errorLname: '',
        address: '',
        errorAddress: '',
        alternate_address: '',
        errorAlternateAddress: '',
        phone: '',
        errorPhone: '',
        gender:2,
        errorGender:'',
        email:'',
        errorEmail:"",
        errors: [],
        }

    },
    methods: {
        Order() {

            this.errors = [];

            let $this = this;

            if (this.fname.length < 3 || this.fname === '') {
                this.errorFname = "First Name is Required";
                this.errors.push(this.errorFname);
            } else {
                this.errorFname = null;
            }
            if (this.lname.length < 3 || this.lname === '') {
                this.errorLname = "Last Name is Required";
                this.errors.push(this.errorLname);
            } else {
                this.errorLname = null;
            }

            if (this.address == '' || this.address.length < 10) {
                this.errorAddress = "Address is Required";
                this.errors.push(this.errorAddress);
            } else {
                this.errorAddress = null;
            }

            if (this.gender == '' || this.gender == null) {
                this.errorGender = "Gender is Required";
                this.errors.push(this.errorGender);
            } else {
                this.errorGender = null;
            }
            if (this.email == '' || this.email.length < 5) {
                this.errorEmail = "Email is Required";
                this.errors.push(this.errorEmail);
            } else {
                this.errorEmail = null;
            }

            if (this.alternate_address == '' && this.alternate_address == '') {
                this.errorAlternateAddress = "Alternate Address is Required";
                this.errors.push(this.errorAlternateAddress);
            } else {
                this.errorAlternateAddress = null;
            }
            if (this.phone.length < 11 || this.phone == '') {
                this.errorPhone = "invalid Phone number";
                this.errors.push(this.errorPhone);
            } else {
                this.errorPhone = null;
            }



            if (!this.errors.length) {
               let $this = this
                 $this.app.fastUser.fname = this.fname
                 $this.app.fastUser.lname = this.lname
                 $this.app.fastUser.deliveryAddress = this.address
                 $this.app.fastUser.alt_deliveryAddress = this.alternate_address
                 $this.app.fastUser.gender = this.gender
                 $this.app.fastUser.phone = this.phone
                 $this.app.fastUser.email = this.email

                this.app.$router.push({
                            name: "payment"
                        });
              /*  let $this = this;
                $this.fullname = this.fname + ' ' + this.lname;
                 let form = new FormData();
                    form.append('name',$this.fullname)
                    form.append('address',$this.address)
                    form.append('alt_address',$this.alternate_address)
                    form.append('phone',$this.phone)
                    form.append('gender',$this.gender)
                    form.append('email',$this.email)
                    form.append('cart',localStorage.getItem('cart'))
                    form.append('total',$this.app.totalprice)

                    let data = form
                                post(BASE_URL + "/api/order", data).then(function(response) {
                                    Flash.setSuccessOrder(`${$this.fullname}, Your Order is on it way and  your Order Ticket Id is ${response.data}`);
                                    $this.app.cart = [];
                                    $this.app.badge = 0;
                                    $this.app.totalprice = '';
                                    localStorage.setItem('cart','');
                                    $this.app.spin =false;
                                    $this.app.$router.push({name: "home"});


                                });


     */
            }

        }
    }
}
</script>
