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
                                                    <input class="products form-control" v-model="name" placeholder="Search Logistics" type="text">
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="col m-2 text-center">
                                        <h2 class="mb-0">Logistics <i class="fa fa-truck"></i></h2>
                                    </div>
                                    <div class="col">
                                        <router-link :to="{name:'admin.new_logistics'}" class="nav-link ">
                                            <button class="btn btn-secondary bg-indigo text-white"> <i class="fa fa-plus fa-1x"></i> &nbsp; Add New Logistics </button>
                                        </router-link>
                                    </div>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <!-- Projects table -->
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Name </th>
                                            <th scope="col">Plate Number</th>
                                            <th scope="col">Driver </th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Updated At</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr v-for="logistics in filterLogistics" :key="logistics.id">
                                            <th scope="row">
                                                    {{logistics.title}}
                                            </th>

                                            <td>
                                                 {{logistics.plate_number}}
                                            </td>
                                            <td>
                                                {{logistics.driver_name}}
                                            </td>
                                            <td>
                                                {{logistics.created_at}}
                                            </td>
                                            <td>
                                                {{logistics.updated_at}}
                                            </td>
                                            <td>
                                                 <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow p-3">
                                                          <button class="btn btn-primary" @click="editLogistics(logistics.id)"><i class="fa fa-eraser"></i></button>
                                                        <button class="btn btn-danger" @click="removeLogistics(logistics.id)"><i class="fa fa-trash"></i></button>

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
                                    <Pagination :paginations="admin.logistics.pagination" @paginate="getLogistics()" :offset="5" />
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
        this.getLogistics()
    },
    computed: {
        filterLogistics() {
            let $this = this
            return $this.admin.logistics.data.filter((logistics_info) => {
                return logistics_info.title.match(this.name);

            });

        },

    },
    data() {
        return {
            flash: Flash.state,
            driverName: '',
            name: '',
            ride: ''

        }

    },
    methods: {
       


        getLogistics() {
            let $this = this
            get(BASE_URL + `/api/all/logistics?page=${$this.admin.logistics.pagination.current_page}`).then((response) => {
                $this.admin.logistics.data = response.data.data;
                $this.admin.logistics.pagination.current_page = response.data.current_page;
                $this.admin.logistics.pagination.total = response.data.total;
                $this.admin.logistics.pagination.per_page = response.data.per_page;
                $this.admin.logistics.pagination.last_page = response.data.last_page;
                $this.admin.logistics.pagination.from = response.data.from;
                $this.admin.logistics.pagination.to = response.data.to;

            });
        },
        removeLogistics(id) {
            post(BASE_URL + `/api/logistics/${id}/delete`).then((response) => {
                this.getLogistics();
            });
        },
        editLogistics(id) {
            let $this = this
            $this.$router.push({
                name: "admin.edit_logistics",
                params: {
                    id: id
                }
            });
        }

    }

}
</script>
