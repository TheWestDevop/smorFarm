<template>

    <div class="main-content">
        <Navbar  :nav="admin"/>
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
                            <div class="card-header bcategory-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                                            <div class="form-group mb-0">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-search text-black-50"></i></span>
                                                    </div>
                                                    <input class="products form-control" placeholder="Search Category Name " v-model="name" type="text">
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="col m-2 text-center">
                                        <h2 class="mb-0">Product category</h2>
                                    </div>
                                    <div class="col">
                                        <router-link :to="{name:'admin.new_category'}" class="nav-link ">
                                            <button class="btn btn-success"> <i class="fa fa-plus fa-1x"></i> &nbsp; Add New Category </button>
                                        </router-link>
                                    </div>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <!-- Projects table -->
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Added</th>
                                            <th scope="col">Last Updated </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr v-for="category in filtercategory" :key="category.id">
                                            <th scope="row">
                                                {{category.title}}
                                            </th>

                                            <td>
                                                {{category.description}}
                                            </td>
                                            <td>
                                                {{category.created_at}}
                                            </td>
                                            <td>
                                                {{category.updated_at}}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow p-3">
                                                         <button class="btn btn-primary" @click="editCategory(category.id)"><i class="fa fa-eraser"></i></button>
                                                        <button class="btn btn-danger" @click="deleteCategory(category.id)"><i class="fa fa-trash"></i></button>

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
                                    <Pagination :paginations="admin.categories.pagination" @paginate="getCategory()" :offset="5" />
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
    name: 'category',
    props: ['admin'],
    components: {
        Navbar,
        Pagination
    },

    mounted() {
        this.getCategory()
       
    },
    computed: {
        filtercategory() {
            let $this = this
            return $this.admin.categories.data.filter((category) => {

                return category.title.match(this.name);

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

        getCategory() {
            let $this = this
            get(BASE_URL + `/api/categories?page=${$this.admin.categories.pagination.current_page}`).then((response) => {

                $this.admin.categories.data = response.data.data;
                $this.admin.categories.pagination.current_page = response.data.current_page;
                $this.admin.categories.pagination.total = response.data.total;
                $this.admin.categories.pagination.per_page = response.data.per_page;
                $this.admin.categories.pagination.last_page = response.data.last_page;
                $this.admin.categories.pagination.from = response.data.from;
                $this.admin.categories.pagination.to = response.data.to;

            });
        },

        editCategory(id){
         let $this = this
            $this.$router.push({
                name: "admin.edit_category",
                params: {
                    id: id
                }
            });
        },
        deleteCategory(id){
            let $this = this
           get(BASE_URL + `/api/delete/category/${id}`).then((response) => {
               this.$toast.success('Category Deleted', {
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
               Flash.setSuccess("Category Deleted!!!");
                $this.getCategory();
            });
        }

    }

}
</script>
