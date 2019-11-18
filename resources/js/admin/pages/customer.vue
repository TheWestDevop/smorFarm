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

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card bg-gradient-default shadow">
                            <div class="card-header bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                        <h2 class="text-white mb-0">Customer</h2>
                                    </div>
                                    <div class="col">
                                        <ul class="nav nav-pills justify-content-end">
                                            <li class="nav-item  mr-2 mr-md-0 active">
                                                <a href="#fasttrack" data-target="#fasttrack" class="nav-link py-2 px-3 active" data-toggle="tab">
                                                    <span class="d-none d-md-block">Fast Track Customer</span>
                                                    <span class="d-md-none">FC</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#rcustomer" class="nav-link py-2 px-3" data-toggle="tab">
                                                    <span class="d-none d-md-block">Registered Customer</span>
                                                    <span class="d-md-none">RC</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content container card-body">
                                <div class="tab-pane active" id="fasttrack">
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
                                                                        <input class="products form-control" v-model="name" placeholder="Search Customer" type="text">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <div class="col m-2 text-center">
                                                            <h2 class="mb-0">Fast Track Customer <i class="fa fa-users"></i></h2>
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
                                                                <th scope="col">Name </th>
                                                                <th scope="col">Address</th>

                                                                <th scope="col">Gender</th>
                                                                <th scope="col">Email</th>
                                                                <th scope="col">Phone</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tr v-for="fast_track in filterfastuser" :key="fast_track.id">
                                                                <th scope="row">
                                                                    {{fast_track.name}}
                                                                </th>

                                                                <td>
                                                                    {{fast_track.address}}
                                                                </td>

                                                                <td v-if="fast_track.gender==1"><i class="fa fa-male fa-2x"></i></td>
                                                                <td v-else><i class="fa fa-female fa-2x"></i></td>
                                                                <td>{{fast_track.email}}</td>
                                                                <td>{{fast_track.phone}}</td>

                                                                <td>

                                                                    <button class="btn btn-danger" @click="removeFastUser(fast_track.id)"><i class="fa fa-trash"></i></button>

                                                                </td>

                                                            </tr>

                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="row justify-content-center">
                                                    <div class="col-md-12">
                                                        <br>
                                                        <Pagination :paginations="admin.fast_customer.pagination" @paginate="getFastUser()" :offset="5" />
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="rcustomer">
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
                                                                        <input class="products form-control" v-model="name" placeholder="Search Customer" type="text">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <div class="col m-2 text-center">
                                                            <h2 class="mb-0">Registered Customer <i class="fa fa-users"></i></h2>
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
                                                                <th scope="col">Name </th>
                                                                <th scope="col">Address</th>
                                                                  <th scope="col">Gender</th>
                                                                <th scope="col">Email</th>
                                                                <th scope="col">Phone</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tr v-for="customer in filteruser" :key="customer.id">
                                                                <th scope="row">
                                                                    {{customer.name}}
                                                                </th>

                                                                <td>
                                                                    {{customer.address}}
                                                                </td>

                                                                <td v-if="customer.gender==1"><i class="fa fa-male fa-2x"></i></td>
                                                                <td v-else><i class="fa fa-female fa-2x"></i></td>
                                                                <td>{{customer.email}}</td>
                                                                <td>{{customer.phone}}</td>

                                                                <td>

                                                                    <div class="dropdown">
                                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <i class="fas fa-ellipsis-v"></i>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow p-3">
                                                                            <button class="btn btn-primary" @click="editUser(customer.id)"><i class="fa fa-eraser text-white"></i></button>
                                                                            <button class="btn btn-danger" @click="deleteUser(customer.id)"><i class="fa fa-trash"></i></button>

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
                                                        <Pagination :paginations="admin.customer.pagination" @paginate="getUser()" :offset="5" />
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
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

    computed: {
        filterfastuser() {
            let $this = this
            return $this.admin.fast_customer.data.filter((user) => {

                return user.name.match(this.name);

            });

        },
        filteruser() {
            let $this = this
            return $this.admin.customer.data.filter((user) => {

                return user.name.match(this.name);

            });

        },

    },

    data() {
        return {
            flash: Flash.state,
            name: '',

        }

    },
    created(){
       this.getFastUser();
       this.getUser();
    },
    methods: {

        getFastUser() {
            let $this = this
            get(BASE_URL + `/api/all/customer?page=${$this.admin.fast_customer.pagination.current_page}`).then((response) => {

                $this.admin.fast_customer.data = response.data.fast_track.data;
                $this.admin.fast_customer.pagination.current_page = response.data.fast_track.current_page;
                $this.admin.fast_customer.pagination.total = response.data.fast_track.total;
                $this.admin.fast_customer.pagination.per_page = response.data.fast_track.per_page;
                $this.admin.fast_customer.pagination.last_page = response.data.fast_track.last_page;
                $this.admin.fast_customer.pagination.from = response.data.fast_track.from;
                $this.admin.fast_customer.pagination.to = response.data.fast_track.to;

            });
        },
        removeFastUser(id) {
            post(BASE_URL + `/api/fast/user/${id}/delete`).then((response) => {
                Flash.setSuccess("Fast Track Customer Deleted !!!");
                this.getFastUser();
            });
        },
        getUser() {
            let $this = this
            get(BASE_URL + `/api/all/customer?page=${$this.admin.customer.pagination.current_page}`).then((response) => {

                $this.admin.customer.data = response.data.r_customer.data;
                $this.admin.customer.pagination.current_page = response.data.r_customer.current_page;
                $this.admin.customer.pagination.total = response.data.r_customer.total;
                $this.admin.customer.pagination.per_page = response.data.r_customer.per_page;
                $this.admin.customer.pagination.last_page = response.data.r_customer.last_page;
                $this.admin.customer.pagination.from = response.data.r_customer.from;
                $this.admin.customer.pagination.to = response.data.r_customer.to;

            });
        },
        removeUser(id) {
            post(BASE_URL + `/api/fast/user/${id}/delete`).then((response) => {
                Flash.setSuccess("Customer Deleted !!!");
                this.getFastUser();
            });
        },
        editUser(id) {
            let $this = this
            $this.$router.push({
                name: "admin.edit_customer",
                params: {
                    id: id
                }
            });
        },
        deleteUser(id){
           post(BASE_URL + `/api/customer/${id}/delete`).then((response) => {
                Flash.setSuccess("Customer Deleted !!!");
                this.getFastUser();
            });
        }


    }

}
</script>
