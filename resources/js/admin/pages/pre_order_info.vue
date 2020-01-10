<template>
    <div class="main-content">
        <!-- Navbar -->
        <Navbar :nav="admin"/>

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
                                        <label><b>Total :</b>&#8358;{{order.total}}</label>

                                    </div>
                                    <div class="col-md-6 mb-20 p-2">
                                        <label><b>User Type :</b> {{order.user_type}}</label>

                                    </div>
                                    <div class="col-md-6 mb-20 p-2">
                                        <label><b>Status :</b>
                                            <span v-if="status_0(order.status)" class="btn btn-light">Pending</span>
                                            <span v-if="status_1(order.status)" class="btn btn-success"><i class="fa fa-check"></i> Completed</span>
                                        </label>

                                    </div>
                                    <div class="col-md-6 mb-20 p-2">
                                        <label><b>Payment ID :</b> {{order.payment_id}}</label>

                                    </div>
                                    <div class="col-md-6 mb-20 p-2">
                                        <label><b>Ticket ID:</b> {{order.ticket_id}}</label>

                                    </div>
                                    <div class="col-md-6 mb-20 p-2">
                                        <label><b> Driver : </b><i class="fa fa-user text-black"></i> {{order.driver}}
                                        </label>
                                    </div>
                                    <div class="col-md-12 col-12 mb-20 p-2">
                                        <label><b>Order : </b></label>
                                        <div class=" align-content-lg-start" v-for="item in order.Orders" :key="item.id">{{item.name}} &nbsp; {{item.quantity}}</div>

                                    </div>
                                    <div class="col-md-6 mb-20 p-2">
                                        <label><b> Date Order To Be Deliver :</b> </label>
                                        <div>
                                            {{order.date_to_deliver}}
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-20 p-2">
                                        <label><b>Time Order To Be Deliver :</b> </label>
                                        <div>
                                            {{order.time_to_deliver}}
                                        </div>
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
                                        <router-link :to="{name:'admin.pre_order'}" class="row justify-content-center">
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
                Orders:[],
                total: "",
                user_type: "",
                ticket_id: "",
                status: "",
                payment_id:'',
                updated_at: '',
                created_at: '',
                time_to_deliver:'',
                date_to_deliver:'',
                driver:'',
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
            get(BASE_URL + `/api/pre/order/${id}`).then(function (response) {

                if (response.data) {

                    $this.order.name = response.data.order.user;
                    $this.order.address = response.data.user.address;
                    $this.order.alt_address = response.data.user.alt_address;
                    $this.order.gender = response.data.user.gender;
                    $this.order.email = response.data.user.email;
                    $this.order.phone = response.data.user.phone;
                    $this.order.Orders = JSON.parse(response.data.order.orders);
                    $this.order.total = response.data.order.total;
                    $this.order.user_type = response.data.order.user_type;
                    $this.order.ticket_id = response.data.order.ticket_id;
                    $this.order.time_to_deliver = response.data.order.time_to_deliver;
                    $this.order.date_to_deliver = response.data.order.date_to_deliver;
                    $this.order.status = response.data.order.status
                    $this.order.created_at = response.data.order.created_at;
                    $this.order.updated_at = response.data.order.updated_at;
                    $this.order.payment_id = response.data.order.payment_id;
                    $this.order.driver = response.data.driver;
                }
            });
        },

    },

};
</script>

<style>
</style>
