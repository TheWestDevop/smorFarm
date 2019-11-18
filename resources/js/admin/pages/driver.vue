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
                            <div class="card-header bdriver-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                                            <div class="form-group mb-0">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-search text-black-50"></i></span>
                                                    </div>
                                                    <input class="products form-control" v-model="name" placeholder="Search Drivers" type="text">
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="col m-2 text-center">
                                        <h2 class="mb-0">Drivers</h2>
                                    </div>
                                    <div class="col">
                                        <router-link :to="{name:'admin.new_driver'}" class="nav-link ">
                                            <button class="btn btn-secondary"> <i class="fa fa-plus fa-1x"></i> &nbsp; Add New Driver </button>
                                        </router-link>
                                    </div>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <!-- Projects table -->
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Driver Name </th>
                                            <th scope="col">Avaliability Status</th>
                                            <th scope="col">Ride</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Updated At</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr v-for="driver in filterDrivers" :key="driver.id">
                                            <th scope="row">
                                                {{driver.staff_name}}
                                            </th>

                                            <td>
                                                <span v-if="status_0(driver.avaliability_status)" class="btn btn-light"><i class="fa fa-truck-pickup"></i> Booked</span>
                                                <span v-if="status_1(driver.avaliability_status)" class="btn btn-success"><i class="fa fa-arrow-down"></i> Avaliable</span>
                                                <span v-if="status_2(driver.avaliability_status)" class="btn btn-primary"><i class="fa fa-arrow-up"></i> Offine</span>
                                                <span v-if="status_3(driver.avaliability_status)" class="btn btn-warning"><i class="fa fa-trash"></i> Removed</span>

                                            </td>
                                            <td>
                                                {{driver.logistics_id}}
                                            </td>
                                            <td>
                                                {{driver.created_at}}
                                            </td>
                                            <td>
                                                {{driver.updated_at}}
                                            </td>
                                            <td>
                                                 <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow p-3">
                                                          <button class="btn btn-primary" @click="editdriver(driver.id)"><i class="fa fa-eraser"></i></button>
                                                        <button class="btn btn-danger" @click="removedriver(driver.id)"><i class="fa fa-trash"></i></button>

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
                                    <Pagination :paginations="admin.drivers.pagination" @paginate="getDrivers()" :offset="5" />
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
    post,
    get
} from '../util/api'
export default {
    name: 'drivers',
    props: ['admin'],
    components: {
        Navbar,
        Pagination
    },
    mounted() {
        this.getDrivers()
    },
    computed: {
        filterDrivers() {
            let $this = this
            return $this.admin.drivers.data.filter((driver_info) => {
                return driver_info.staff_name.match(this.name);

            });

        },

    },
    data() {
        return {
            flash: Flash.state,
            name: '',
            ride: ''

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
        status_2(status) {
            if (status == 2) {
                return true;
            }
            return false
        },
        status_3(status) {
            if (status == 3) {
                return true;
            }
            return false
        },
        getDrivers() {
            let $this = this
            get(BASE_URL + `/api/driver?page=${$this.admin.drivers.pagination.current_page}`).then((response) => {
                $this.admin.drivers.data = response.data.data;
                $this.admin.drivers.pagination.current_page = response.data.current_page;
                $this.admin.drivers.pagination.total = response.data.total;
                $this.admin.drivers.pagination.per_page = response.data.per_page;
                $this.admin.drivers.pagination.last_page = response.data.last_page;
                $this.admin.drivers.pagination.from = response.data.from;
                $this.admin.drivers.pagination.to = response.data.to;

            });
        },
        removedriver(id) {
            post(BASE_URL + `/api/driver/${id}/delete`).then((response) => {
                this.getDrivers();
            });
        },
        editdriver(id) {
            let $this = this
            $this.$router.push({
                name: "admin.edit_driver",
                params: {
                    id: id
                }
            });
        }

    }

}
</script>
