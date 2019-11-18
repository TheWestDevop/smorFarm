<template>

    <div class="main-content">
        <Navbar />
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
                            <div class="card-header bdeliveries-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                                            <div class="form-group mb-0">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-search text-black-50"></i></span>
                                                    </div>
                                                    <input class="products form-control" placeholder="Search Driver Name " v-model="name" type="text">
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="col m-2 text-center">
                                        <h2 class="mb-0">Driver Deliveries</h2>
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
                                            <th scope="col">Driver Name </th>
                                            <th scope="col">Customer</th>


                                            <th scope="col">Status</th>
                                            <th scope="col">Added</th>
                                            <th scope="col">Last Updated </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr v-for="deliveries in filterDeliveries" :key="deliveries.id">
                                            <th scope="row">
                                                {{deliveries.driver_name}}
                                            </th>

                                            <td>
                                                {{deliveries.user}}
                                            </td>


                                            <td>
                                                <span v-if="status_0(deliveries.status)" class="btn btn-light">Pending</span>
                                                <span v-if="status_1(deliveries.status)" class="btn btn-success"><i class="fa fa-check"></i> Completed</span>
                                            </td>
                                            <td>
                                                {{deliveries.created_at}}
                                            </td>
                                            <td>
                                                {{deliveries.updated_at}}
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <br>
                                    <Pagination :paginations="admin.deliveries.pagination" @paginate="getdeliveriess()" :offset="5" />
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
    get
} from '../util/api'
export default {
    name: 'deliveries',
    props: ['admin'],
    components: {
        Navbar,
        Pagination
    },
    mounted() {
        this.getDeliveries()
    },
    computed: {
        filterDeliveries() {
            let $this = this
            return $this.admin.deliveries.data.filter((deliveries) => {
                
                return deliveries.driver_name.match(this.name);

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
        getDeliveries() {
            let $this = this
            get(BASE_URL + `/api/deliveries?page=${$this.admin.deliveries.pagination.current_page}`).then((response) => {

                $this.admin.deliveries.data = response.data.data;
                $this.admin.deliveries.pagination.current_page = response.data.current_page;
                $this.admin.deliveries.pagination.total = response.data.total;
                $this.admin.deliveries.pagination.per_page = response.data.per_page;
                $this.admin.deliveries.pagination.last_page = response.data.last_page;
                $this.admin.deliveries.pagination.from = response.data.from;
                $this.admin.deliveries.pagination.to = response.data.to;

            });
        },

    }

}
</script>
