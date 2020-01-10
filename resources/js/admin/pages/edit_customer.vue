<template>
    <div class="main-content">
        <!-- Navbar -->
        <Navbar :nav="admin"/>

        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                        <form v-on:submit.prevent="onUpdate">
                            <div class="login-form">
                                <h4 class="login-title text-center">Customer Information</h4>
                                <div class="row">

                                    <br>
                                    <div class="col-md-6 col-12 mb-20 p-2">
                                        <label><b>Customer Name :</b></label>

                                        <input type="text" class="form-control" v-model="name" id="">

                                    </div>
                                    <div class="col-md-6 col-12 mb-20 p-2">
                                        <label><b> Address :</b></label>
                                        <input type="text" class="form-control" v-model="address" id="">
                                    </div>
                                    <div class="col-md-6 col-12 mb-20 p-2">
                                        <label><b> Gender :</b></label>

                                        <select v-model="gender" id="" class="form-control">
                                            <option value="1">Male</option>
                                            <option value="0">Female</option>
                                        </select>

                                    </div>
                                    <div class="col-md-6 col-12 mb-20 p-2">
                                        <label><b> Alternate Address :</b></label>
                                        <input type="text" class="form-control" v-model="alt_address" id="">
                                    </div>
                                    <div class="col-md-6 col-12 mb-20 p-2">
                                        <label><b> Contact :</b></label>
                                        <input type="text" class="form-control" v-model="phone" id="">

                                    </div>
                                    <div class="col-md-6 col-12 mb-20 p-2">
                                        <label><b> Email :</b></label>
                                        <input type="email" class="form-control" v-model="email" id="">
                                    </div>
                                    <div class="col-md-6 col-12 mb-20 p-2">
                                        <label><b> State :</b></label>
                                        <input type="text" class="form-control" v-model="state" id="">
                                    </div>

                                    <div class="col-md-6 mb-20 p-2">
                                        <label><b>Total Order Number:</b>&nbsp;{{total_order}}</label>

                                    </div>

                                    <div class="col-md-6 mb-20 p-2">
                                        <label><b> Date Added :</b> </label>
                                        <div>
                                            {{created_at}}
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <router-link :to="{name:'admin.customer'}" class="float-left">
                                            <button class="btn btn-secondary mt-0">
                                                <i class="fa fa-arrow-left"></i> Back
                                            </button>
                                        </router-link>
                                        <button class="btn btn-info mt-0 float-right">
                                            <i class="fa fa-upload"></i> Updated
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Auth from "../util/Auth";
import Flash from "../../util/flash"
import {
    post,
    get
} from "../util/api";
import Navbar from '../components/navbar'

export default {
    name: "edit_customer",
    components: {
        Navbar
    },
    created() {
        this.id = this.$route.params.id;
        this.getUser(this.id)
    },
    data() {
        return {
            id: '',
            name: "",
            address: "",
            alt_address: "",
            phone: "",
            total_order: "",
            created_at: '',
            email: '',
            gender: '',
            state:''

        }
    },
    methods: {

        getUser(id) {
            let $this = this;
            get(BASE_URL + `/api/customer/${id}`).then(function (response) {

                if (response.data) {

                    $this.name = response.data.name;
                    $this.address = response.data.address;
                    $this.alt_address = response.data.alt_address;
                    $this.gender = response.data.gender;
                    $this.email = response.data.email;
                    $this.phone = response.data.phone;
                     $this.state = response.data.state;
                    $this.total_order = response.data.total_order;
                    $this.created_at = response.data.created_at;

                }
            });
        },
        onUpdate() {
            let $this = this;
            if (!$this.id == null || !$this.id == '') {


                var data;

                let form = new FormData();

                form.append('name', $this.name)
                form.append('address', $this.address)
                form.append('alt_address', $this.alt_address)
                form.append('gender', $this.gender)
                form.append('email', $this.email)
                form.append('phone', $this.phone)
                form.append('state', $this.state)


                data = form

                post(BASE_URL + `/api/update/customer/${$this.id}`, data).then(function (response) {

                    if (response.data.message) {
                        $this.$router.push({
                            name: "admin.customer"
                        });
                        this.$toast.success('Customer Update Was Successfully !!!', {
                                position: 'top-center',
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
                        Flash.setSuccess("Customer Update Was Successfully!");
                    } else {
                            this.$toast.error('You Are Unauthorized!!!', {
                                position: 'top-center',
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
                        Flash.setError("You Are Unauthorized!!!");

                    }
                });
            }else {
                this.$toast.error('Error refresh and try again !!!', {
                                position: 'top-center',
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
                        Flash.setError("Error refresh and try again !!!");

                    }
        }

    },

};
</script>

<style>
</style>
