<template>

    <div class="main-content">
        <Navbar :nav="executor" />
        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
            <div class="alert alert-success text-center w-50 mx-auto" v-if="flash.success">
                {{flash.success}}
            </div>
            <div class="alert alert-danger text-center  w-50 mx-auto" v-if="flash.error">
                {{flash.error}}
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 ">
                        <div class="card shadow">
                            <div class="card-header borders-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                                            <div class="form-group mb-0">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-search text-black-50"></i></span>
                                                    </div>
                                                    <input class="products form-control" placeholder="Search Customer Name " v-model="name" type="text">
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="col m-2 text-center">
                                        <h2 class="mb-0">My Orders </h2>
                                    </div>
                                    <div class="col">

                                    </div>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <!-- Projects table -->
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Customer Name</th>
                                            
                                            <th scope="col">Status</th>
                                            <th scope="col">Time</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr v-for="order in filterorders" :key="order.id">

                                            <td scope="row">
                                                {{order.user}}
                                            </td>
                                            <td>
                                                <span v-if="status_0(order.status)" class="btn btn-light">Pending</span>
                                                <span v-if="status_1(order.status)" class="btn btn-success"><i class="fa fa-check"></i> Completed</span>
                                            </td>
                                            <td>
                                                {{order.created_at}}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow p-3">
                                                        <button class="btn btn-info" @click="moreInfo(order.id)"><i class="fa fa-info"></i></button>
                                                        <button class="btn btn-success" v-if="status_0(order.status)" @click="OrderDeliver(order.id,order.ticket_id,order.user)"><i class="fa fa-check text-white"></i></button>
                                                        <button class="btn btn-light" v-if="status_1(order.status)" @click="OrderDeliveRevised(order.id)"><i class="fa fa-remove text-white"></i></button>
                                                        

                                                    </div>
                                                </div>

                                            </td>

                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <br>
                                    <Pagination :paginations="executor.orders.pagination" @paginate="getOrders()" :offset="5" />
                                    <br>
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
import Navbar from '../components/navbar'
import Flash from "../../util/flash"
import Pagination from "../components/pagination";
import {
    get,post
} from '../../util/api'
export default {
    name: 'orders',
    props: ['executor'],
    components: {
        Navbar,
        Pagination
    },
    mounted() {
         this.getOrders()
    },
    computed: {
        filterorders() {
            let $this = this
            return $this.executor.orders.data.filter((orders) => {
                return orders.user.match(this.name);

            });

        },

    },
    data() {
        return {
            flash: Flash.state,
            name: '',
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
        getOrders() {
            let $this = this
            let token = localStorage.getItem('executor_api_token');
            get(BASE_URL + `/api/executor/${token}/orders?page=${$this.executor.orders.pagination.current_page}`).then((response) => {

                $this.executor.orders.data = response.data.data;
                $this.executor.orders.pagination.current_page = response.data.current_page;
                $this.executor.orders.pagination.total = response.data.total;
                $this.executor.orders.pagination.per_page = response.data.per_page;
                $this.executor.orders.pagination.last_page = response.data.last_page;
                $this.executor.orders.pagination.from = response.data.from;
                $this.executor.orders.pagination.to = response.data.to;

            });
        },
        OrderDeliver(id,ticket,user) {
            get(BASE_URL + `/api/order/${id}/delivered`).then((response) => {
                 this.$toast.success('Order Delivered Updated', {
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
            let message = `Order with Ticket ${ticket} Has Been Delivered, From Delivery Executor`;
                            let form = new FormData();
                             form.append('message', message)
                             form.append('user', user)
                             post(BASE_URL + `/api/create/notification/`, form).then(function (response) {});                     
                this.getOrders();
            });
            this.executor.getNotification();
        },
        OrderDeliveRevised(id) {
            get(BASE_URL + `/api/order/${id}/delivered/revised`).then((response) => {
                 this.$toast.info('Order Delivered Revised', {
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
                let message = `Order with Ticket ${ticket} Has Been Revised, From Delivery Executor`;
                            let form = new FormData();
                             form.append('message', message)
                             form.append('user', user)
                             post(BASE_URL + `/api/create/notification/`, form).then(function (response) {}); 
                this.getOrders();
            });
            this.executor.getNotification();
        },
        moreInfo(id) {
            let $this = this
            $this.$router.push({
                name: "order_info",
                params: {
                    id: id
                }
            });
        },
        

    }

}
</script>
