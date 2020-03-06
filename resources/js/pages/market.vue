<template>
   
            <!-- Begin Li's Content Wraper Area -->
            <div class="content-wraper pt-60 pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 order-1 order-lg-2">
                            <!-- Begin Li's Banner Area -->
                            <div class="single-banner shop-page-banner">
                                <a href="#">
                                    <img src="images/slider/2.jpg" alt="Li's Static Banner">
                                </a>
                            </div>
                            <!-- Li's Banner Area End Here -->
                            <!-- shop-top-bar start -->
                            <div class="shop-top-bar mt-30">
                                <div class="shop-bar-inner">
                                    <div class="product-view-mode">
                                        <!-- shop-item-filter-list start -->
                                        <ul class="nav shop-item-filter-list" role="tablist">
                                            <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                            <li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="list-view" href="#list-view"><i class="fa fa-th-list"></i></a></li>
                                        </ul>
                                        <!-- shop-item-filter-list end -->
                                    </div>
                                    <div class="toolbar-amount">
                                        <span>Showing {{products.pagination.from}} to {{products.pagination.to}} of {{products.pagination.total}}</span>
                                    </div>
                                </div>
                                <!-- product-select-box start -->
                                <div class="product-select-box">
                                    <div class="product-short">
                                        <p>Sort By:</p>
                                        <select class="nice-select">
                                            <option value="trending">Relevance</option>
                                            <option value="sales">Name (A - Z)</option>
                                            <option value="sales">Name (Z - A)</option>
                                            <option value="rating">Price (Low &gt; High)</option>
                                            <option value="date">Rating (Lowest)</option>
                                            <option value="price-asc">Model (A - Z)</option>
                                            <option value="price-asc">Model (Z - A)</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- product-select-box end -->
                            </div>
                            <!-- shop-top-bar end -->
                            <!-- shop-products-wrapper start -->
                            <div class="shop-products-wrapper">
                                <div class="tab-content">
                                    <div id="grid-view" class="tab-pane fade" role="tabpanel">
                                        <div class="product-area shop-product-area">
                                            <div class="row">
                                                <grid_view :product="product" v-for="product in products.data"  :key="product.id"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="list-view" class="tab-pane fade product-list-view active show" role="tabpanel">
                                        <div class="row">
                                            <div class="col">
                                                <list_view :product="product" v-for="product in products.data"  :key="product.id"/>
                                            
                                            </div>
                                        </div>
                                    </div>
                                    <pagination 
                                    :paginations="$store.getters.ALL_PRODUCT.pagination"
                                     @paginate="navigate()" :offset="4" />
                                </div>
                            </div>
                            <!-- shop-products-wrapper end -->
                        </div>
                         <category />

                    </div>
                </div>
            </div>
            <!-- Content Wraper Area End Here -->
</template>

<script>
import { mapGetters } from "vuex";
import category from '../components/product/category.vue';
import grid_view from '../components/product/grid_product_view.vue';
import list_view from '../components/product/list_product_view.vue';
import pagination from '../components/pagination'
export default {
    name:'Market',
    computed: mapGetters({ products: "ALL_PRODUCT" }),
    components:{
        category,
        grid_view,
        list_view,
        pagination
    },
    methods:{
        navigate(){
            this.$store.dispatch('fetchAllProduct')
        }
    }

}
</script>

<style>

</style>