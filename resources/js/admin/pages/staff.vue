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
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                                            <div class="form-group mb-0">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-search text-black-50"></i></span>
                                                    </div>
                                                    <input class="products form-control" v-model="name" placeholder="Search For Staff By  Name " type="text">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col m-2 text-center">
                                        <h2 class="mb-0">Staffs <i class="fa fa-users"></i></h2>
                                    </div>

                                    <div class="col">
                                        <router-link :to="{name:'admin.new_staff'}" class="nav-link ">
                                            <button class="btn btn-success"> <i class="fa fa-plus fa-1x"></i> &nbsp; Add New Staff </button>
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
                                            <th scope="col">Picture</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Job Title</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr v-for="staff in filterStaff" :key="staff.id">
                                            <th scope="row">
                                                {{staff.name}}
                                            </th>
                                            <td>
                                                <img :src="`/storage/images/staff/${staff.img}`" width="100" height="100" alt="Staff Image">
                                            </td>
                                            <td>
                                                {{staff.phone}}
                                            </td>
                                            <td>
                                                {{staff.email}}
                                            </td>
                                            <td v-if="staff.gender==1"><i class="fa fa-male fa-2x"></i></td>
                                            <td v-else><i class="fa fa-female fa-2x"></i></td>

                                            <td>
                                                {{staff.job_title}}

                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow p-3">
                                                        <button class="btn btn-info" @click="moreInfo(staff.id)"><i class="fa fa-info"></i></button>
                                                        <button class="btn btn-primary" @click="editStaff(staff.id)"><i class="fa fa-eraser"></i></button>
                                                        <button class="btn btn-danger" @click="deleteStaff(staff.id)"><i class="fa fa-trash"></i></button>

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
                                    <Pagination :paginations="admin.staff.pagination" @paginate="getStaffs()" :offset="5" />
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
    name: 'staffs',
    props: ['admin'],
    components: {
        Navbar,
        Pagination
    },
    created() {
        this.getStaffs()
    },
    computed: {
        filterStaff() {
            let $this = this
            return $this.admin.staff.data.filter((staff) => {

                return staff.name.match(this.name);

            });

        }

    },
    data() {
        return {
            flash: Flash.state,
            name: ''

        }

    },
    methods: {
        getStaffs() {
            let $this = this
            get(BASE_URL + `/api/all/staff?page=${$this.admin.staff.pagination.current_page}`).then((response) => {

                $this.admin.staff.data = response.data.data;
                $this.admin.staff.pagination.current_page = response.data.current_page;
                $this.admin.staff.pagination.total = response.data.total;
                $this.admin.staff.pagination.per_page = response.data.per_page;
                $this.admin.staff.pagination.last_page = response.data.last_page;
                $this.admin.staff.pagination.from = response.data.from;
                $this.admin.staff.pagination.to = response.data.to;

            });
        
        },
        deleteStaff(id) {
            get(BASE_URL + `/api/staff/${id}/delete`).then((response) => {
                this.getStaffs();
            });
        },
        editStaff(id) {
            let $this = this
            $this.$router.push({
                name: "admin.edit_staff",
                params: {
                    id: id
                }
            });
        },
        moreInfo(id) {
            let $this = this
            $this.$router.push({
                name: "admin.info_staff",
                params: {
                    id: id
                }
            });
        }
    }

}
</script>
