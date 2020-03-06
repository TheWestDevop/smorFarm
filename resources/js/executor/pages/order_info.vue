<template>
    <div class="main-content">
        <!-- Navbar -->
        <Navbar :nav="executor"/>

        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                        <form>
                            <div class="login-form">
                                <h4 class="login-title text-center">Order Information</h4>
                                <div class="row">

                                    <br>
                                    <div class="col-md-6 col-12 mb-20 p-2">
                                        <label><b>Customer Name :</b></label>
                                        <div class="">
                                            {{order.name}}
                                        </div>

                                    </div>
                                     <div class="col-md-6 col-12 mb-20 p-2">
                                        <label><b> Address :</b></label>
                                        <div class="">
                                            {{order.address}}
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mb-20 p-2">
                                        <label><b> Gender :</b></label>
                                        <div v-if="order.gender==1" class="">
                                          <i class="fa fa-male text-blue"></i> Male
                                        </div>
                                        <div v-else class="">
                                           <i class="fa fa-female text-black"></i> Female
                                        </div>

                                    </div>
                                    <div class="col-md-6 col-12 mb-20 p-2">
                                        <label><b> Alternate Address :</b></label>
                                        <div class="">
                                            {{order.alt_address}}
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mb-20 p-2">
                                        <label><b> Contact :</b></label>
                                        <div class="">
                                            {{order.phone}}
                                        </div>

                                    </div>
                                     <div class="col-md-6 col-12 mb-20 p-2">
                                        <label><b>Customer Email :</b></label>
                                        <div class="">
                                            {{order.email}}
                                        </div>
                                    </div>


                                    <div class="col-md-6 mb-20 p-2">
                                        

                                    </div>
                                    
                                    <div class="col-md-6 mb-20 p-2">
                                        <label><b>Status :</b>
                                            <span v-if="status_0(order.status)" class="btn btn-light">Pending</span>
                                            <span v-if="status_1(order.status)" class="btn btn-success"><i class="fa fa-check"></i> Completed</span>
                                        </label>

                                    </div>
                                    
                                    <div class="col-md-6 mb-20 p-2">
                                        <label><b> Date Added :</b> </label>
                                        <div>
                                            {{order.created_at}}
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-20 p-2">
                                        <label><b>Last Updated Date :</b> </label>
                                        <div>
                                            {{order.updated_at}}
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <router-link :to="{name:'home'}" class="row justify-content-center">
                                            <button class="btn btn-secondary mt-0">
                                                <i class="fa fa-arrow-left"></i> Back
                                            </button>
                                        </router-link>
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
import {
    post,
    get
} from "../util/api";
import Navbar from '../components/navbar'

export default {
    name: "order_info",
    props:['executor'],
    components: {
        Navbar
    },
    created() {
        this.id = this.$route.params.id;
        this.getOrder(this.id)
    },
    data() {
        return {
            id: '',
            order: {
                name: "",
                address: "",
                alt_address: "",
                phone: "",
                status: "",
                updated_at: '',
                created_at: '',
                email:'',
                gender:''

            }
        }
    },
    methods: {
        status_1(status) {
            if (status == 1) {
                return true;
            }
            return false
        },
        status_0(status) {
            if (status == 0) {
                return true;
            }
            return false
        },
        getOrder(id) {
            let $this = this;
            get(BASE_URL + `/api/order/${id}`).then(function (response) {

                if (response.data) {

                    $this.order.name = response.data.order.user;
                    $this.order.address = response.data.user.address;
                    $this.order.alt_address = response.data.user.alt_address;
                    $this.order.gender = response.data.user.gender;
                    $this.order.email = response.data.user.email;
                    $this.order.phone = response.data.user.phone;
                    $this.order.status = response.data.order.status
                    $this.order.created_at = response.data.order.created_at;
                    $this.order.updated_at = response.data.order.updated_at;

                }
            });
        },

    },

};
</script>

<style>
</style>
