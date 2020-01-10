<template>

    <div class="main-content">
        <Navbar :nav="admin" />
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
                                                    <input class="products form-control" v-model="product_name" placeholder="Search Products" type="text">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col m-2 text-center">
                                        <h2 class="mb-0">Products</h2>
                                    </div>

                                    <div class="col">
                                        <router-link :to="{name:'admin.upload_product'}" class="nav-link ">
                                            <button class="btn btn-success"> <i class="fa fa-plus fa-1x"></i> &nbsp; Add New Product </button>
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <!-- Projects table -->
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Product Name </th>
                                            <th scope="col">Picture</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantities</th>
                                            <th scope="col">Category</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr v-for="product in filterProduct" :key="product.id">
                                            <th scope="row">
                                                {{product.title}}
                                            </th>
                                            <td>
                                                <img :src="`/storage/images/product/${product.product_image}`" width="100" height="100" alt="Product Image">
                                            </td>
                                            <td>
                                                &#8358;{{product.price}}
                                            </td>
                                            <td>
                                                {{product.quantity}}
                                            </td>
                                            <td>
                                                {{product.category_id}}

                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow p-3">
                                                        <button class="btn btn-info" @click="moreInfo(product.id)"><i class="fa fa-info"></i></button>
                                                        <button class="btn btn-primary" @click="editProduct(product.id)"><i class="fa fa-eraser"></i></button>
                                                        <button class="btn btn-danger" @click="deleteProduct(product.id)"><i class="fa fa-trash"></i></button>

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
                                        <Pagination :paginations="admin.products.pagination" @paginate="getProducts()" :offset="5" />
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
    name: 'products',
    props: ['admin'],
    components: {
        Navbar,
        Pagination
    },
    created() {
        this.getProducts()
    },
    computed: {
        filterProduct() {
            let $this = this
            return $this.admin.products.products.filter((product) => {

                return product.title.match(this.product_name);

            });

        }

    },
    data() {
        return {
            flash: Flash.state,
            product_name: ''

        }

    },
    methods: {
        getProducts() {
            let $this = this
            get(BASE_URL + `/api/all/products?page=${$this.admin.products.pagination.current_page}`).then((response) => {

                $this.admin.products.products = response.data.data;
                $this.admin.products.pagination.current_page = response.data.current_page;
                $this.admin.products.pagination.total = response.data.total;
                $this.admin.products.pagination.per_page = response.data.per_page;
                $this.admin.products.pagination.last_page = response.data.last_page;
                $this.admin.products.pagination.from = response.data.from;
                $this.admin.products.pagination.to = response.data.to;

            });
        },
        deleteProduct(id) {
            get(BASE_URL + `/api/delete/product/${id}`).then((response) => {
                this.$toast.success('Product Deleted', {
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
                this.getProducts();
            });
        },
        editProduct(id) {
            let $this = this
            $this.$router.push({
                name: "admin.edit_product",
                params: {
                    id: id
                }
            });
        },
        moreInfo(id){
            let $this = this
            $this.$router.push({
                name: "admin.info_product",
                params: {
                    id: id
                }
            });
        }
    }

}
</script>
