<template>
    <div style="margin-top:-20px!important;">
        <!-- Begin Slider With Banner Area -->
        <div class="slider-with-banner">


                        <div class="slider-area">
                            <div class="slider-active owl-carousel">
                                <!-- Begin Single Slide Area -->
                                <div class="single-slide align-center-left animation-style-01 bg-1">
                                    <div class="slider-progress"></div>
                                    <div class="slider-content text-white">
                                        <h5>
                                            Sale Offer
                                            <span>-50% Off</span> This Week
                                        </h5>
                                        <h2>Fresh Pepper <br> Fresh Vegetable</h2>
                                        <h3>
                                            Starting at
                                            <span>&#8358;150.00</span>
                                        </h3>
                                        <div class="default-btn slide-btn">
                                            <a class="links" href="#/mall">Shopping Now</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Slide Area End Here -->
                                <!-- Begin Single Slide Area -->
                                <div class="single-slide align-center-left animation-style-02 bg-2">
                                    <div class="slider-progress"></div>
                                    <div class="slider-content text-white">
                                        <h5>
                                            Sale Offer
                                            <span>Black Friday</span> This Week
                                        </h5>
                                        <h2>Fat and Healthy Boilers</h2>
                                        <h3>
                                            Starting at
                                            <span>&#8358;1000.00</span>
                                        </h3>
                                        <div class="default-btn slide-btn">
                                            <a class="links" href="#/product/category/chicken">Shopping Now</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Slide Area End Here -->
                                <!-- Begin Single Slide Area -->
                                <div class="single-slide align-center-left animation-style-01 bg-3">
                                    <div class="slider-progress"></div>
                                    <div class="slider-content text-white">
                                        <h5>
                                            Sale Offer
                                            <span>-50% Off</span> This Week
                                        </h5>
                                        <h2>Fresh Tomatoe</h2>
                                        <h3>
                                            Starting at
                                            <span>&#8358;100.00</span>
                                        </h3>
                                        <div class="default-btn slide-btn">
                                            <a class="links" href="#/product/category/Pepper">Shopping Now</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Slide Area End Here -->
                            </div>
                        </div>


        </div>
        <!-- Slider With Banner Area End Here -->
        <!-- Begin Product Area -->
        <div class="product-area pt-60 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="li-product-tab">
                            <ul class="nav li-product-menu">
                                <li><a class="active" data-toggle="tab" href="#li-new-product"><span class="h4">New Arrival</span></a></li>
                                </ul>
                        </div>
                        <!-- Begin Li's Tab Menu Content Area -->
                    </div>
                </div>
                <div class="tab-content">
                    <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                        <div class="row box" v-if="validateProduct(app.all_products.data)">

                            <div v-for="product in app.all_products.data" :key="product.id" class="col m-2 item">

                                <Product :app="app" :product="product" />

                            </div>

                        </div>
                        <div class="row" v-else>

                            <div class="col-lg-12 text-center mx-auto">
                                <p class="text-black font-weight-bold mt-5 p-5">No Product Available</p>
                            </div>

                        </div>
                        <div class="row justify-content-center">
                            <pagination :paginations="app.all_products.paginations" @paginate="getAllProduct()" :offset="5">
                            </pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Area End Here -->

        <!-- Begin Li's Rice Product Area -->
        <section class="product-area li-laptop-product pt-60 pb-45">
            <div class="container">
                <div class="row">
                    <!-- Begin Li's Section Area -->
                    <div class="col-lg-12">
                        <div class="li-section-title">
                            <h2>
                                <span class="h4">Discount Product </span>
                            </h2>
                            <ul class="li-sub-category-list">
                                <li class="active"><a href="#">Made In Nigeria</a></li>
                                <li><a href="#">Imported</a></li>

                            </ul>
                        </div>



                        <div class="row box" v-if="validateProduct(app.discount_products.data)">
                            <div v-for="product in app.discount_products.data" :key="product.id" class="col m-2 item">

                                <Product :app="app" :product="product" />

                            </div>
                        </div>
                        <div class="row" v-else>

                            <div class="col-lg-12 text-center mx-auto">
                                <p class="text-black font-weight-bold mt-5 p-5">No Product Available</p>
                            </div>

                        </div>
                        <div class="row justify-content-center">
                            <pagination :paginations="app.discount_products.paginations" @paginate="getAllDiscount()" :offset="5">
                            </pagination>
                            </div>
                    </div>
                    <!-- Li's Section Area End Here -->
                </div>
            </div>
        </section>
        <!-- Li's Rice Product Area End Here -->
        <!-- Begin Li's Cooking Oil Product Area -->
        <section class="product-area li-laptop-product li-tv-audio-product pb-45">
            <div class="container">
                <div class="row">
                    <!-- Begin Li's Section Area -->
                    <div class="col-lg-12">
                        <div class="li-section-title">
                            <h2>
                                <span class="h4">Cooking Oil</span>
                            </h2>
                            <ul class="li-sub-category-list">
                                <li class="active"><a href="#">Made In Nigeria</a></li>
                                <li><a href="#">Imported</a></li>
                            </ul>
                        </div>
                        <div class="row box" v-if="validateProduct(app.oil)">
                            <div v-for="product in app.oil" :key="product.id" class="col m-2 item">

                                <Product :app="app" :product="product" />

                            </div>
                        </div>
                        <div class="row" v-else>

                            <div class="col-lg-12 text-center mx-auto">
                                <p class="text-black font-weight-bold mt-5 p-5">No Product Available</p>
                            </div>

                        </div>
                    </div>
                    <!-- Li's Section Area End Here -->
                </div>
            </div>
        </section>
        <!-- Li's Cooking Oil Product Area End Here -->
        <!-- Begin Li's Static Home Area -->
        <div class="li-static-home">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Begin Li's Static Home Image Area -->
                        <div class="li-static-home-image"></div>
                        <!-- Li's Static Home Image Area End Here -->
                        <!-- Begin Li's Static Home Content Area -->
                        <div class="li-static-home-content ">
                            <p>Sale Offer <span>-20% Off</span> This Week</p>
                            <h2>Fresh onions</h2>
                            <p class="schedule">
                                Starting at
                                <span> &#8358;100.00 </span>
                                per pack
                            </p>
                            <div class="default-btn">
                                <a href="#/product/category/Fish" class="links">Shopping Now</a>
                            </div>
                        </div>
                        <!-- Li's Static Home Content Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Li's Static Home Area End Here -->
        <!-- Begin Li's Trending Product Area -->
        <section class="product-area li-trending-product pt-60 pb-45">
            <div class="container">
                <div class="row">
                    <!-- Begin Li's Tab Menu Area -->
                    <div class="col-lg-12">
                        <div class="li-product-tab li-trending-product-tab">
                            <h2>
                                <span class="h4">Trending Products</span>
                            </h2>
                            <ul class="nav li-product-menu li-trending-product-menu">
                                <li><a class="active" data-toggle="tab" href="#home1"><span>Made In Imported</span></a></li>
                                <li><a data-toggle="tab" href="#home2"><span>Imported</span></a></li>
                            </ul>
                        </div> <!-- Begin Li's Tab Menu Content Area -->
                        <div class="tab-content li-tab-content li-trending-product-content">
                            <div id="home1" class="tab-pane show fade in active">
                                <div class="row box" v-if="validateProduct(app.trending)">
                                    <div v-for="product in app.trending.nigeria" :key="product.id" class="col m-2 item">

                                        <Product :app="app" :product="product" />

                                    </div>
                                </div>
                                <div class="row" v-else>

                                    <div class="col-lg-12 text-center mx-auto">
                                        <p class="text-black font-weight-bold mt-5 p-5">No Product Available</p>
                                    </div>

                                </div>
                            </div>
                            <div id="home2" class="tab-pane fade">
                                <div class="row box" v-if="validateProduct(app.trending)">
                                    <div v-for="product in app.trending.imported" :key="product.id" class="col m-2 item">

                                        <Product :app="app" :product="product" />

                                    </div>
                                </div>
                                <div class="row" v-else>

                                    <div class="col-lg-12 text-center mx-auto">
                                        <p class="text-black font-weight-bold mt-5 p-5">No Product Available</p>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- Tab Menu Content Area End Here -->
                    </div>
                    <!-- Tab Menu Area End Here -->
                </div>
            </div>
        </section>
        <!-- Li's Trending Product Area End Here -->
        <!-- Begin Li's Kitchen ToolsProducts Area -->
        <section class="product-area li-laptop-product li-trendding-products best-sellers pb-45">
            <div class="container">
                <div class="row">
                    <!-- Begin Li's Section Area -->
                    <div class="col-lg-12">
                        <div class="li-section-title">
                            <h2>
                                <span class="h4">Kitchen Tools</span>
                            </h2>
                        </div>
                        <div class="row box" v-if="validateProduct(app.tools)">
                            <div v-for="product in app.tools" :key="product.id" class="col m-2 item">

                                <Product :app="app" :product="product" />

                            </div>


                        </div>
                        <div class="row" v-else>

                            <div class="col-lg-12 text-center mx-auto">
                                <p class="text-black font-weight-bold mt-5 p-5">No Product Available</p>
                            </div>

                        </div>
                    </div>
                    <!-- Li's Section Area End Here -->
                </div>
            </div>
        </section>
        <!-- Li's Trendding Products Area End Here -->

    </div>

</template>

<script>
import Product from '../components/product.vue'
import pagination from '../components/pagination.vue'
import {
    get
} from "../util/api";
export default {
    name: "Content",
    props: ["app"],
    components: {
        pagination,
        Product
    },
    data() {
        return {
            quantity:1
        };
    },
    created(){
     this.viewCart();
    },
    methods: {
        getAllProduct() {
            let $this = this;
            $this.app.spin = true;
            get(BASE_URL + `/api/all/products?page=${$this.app.all_products.paginations.current_page}`).then(function (response) {
                if (response.data) {
                    $this.app.all_products.data = response.data.data;
                    $this.app.all_products.paginations.current_page = response.data.current_page;
                    $this.app.all_products.paginations.total = response.data.total;
                    $this.app.all_products.paginations.per_page = response.data.per_page;
                    $this.app.all_products.paginations.last_page = response.data.last_page;
                    $this.app.all_products.paginations.from = response.data.from;
                    $this.app.all_products.paginations.to = response.data.to;
                    $this.app.spin = false;
                }
            });
        },
        getAllDiscount() {
            let $this = this;
            $this.app.spin = true;
            get(BASE_URL + `/api/all/products/low/discount/?page=${$this.app.discount_products.paginations.current_page}`).then(function (response) {
                if (response.data) {
                    $this.app.discount_products.data = response.data.data;
                    $this.app.discount_products.paginations.current_page = response.data.current_page;
                    $this.app.discount_products.paginations.total = response.data.total;
                    $this.app.discount_products.paginations.per_page = response.data.per_page;
                    $this.app.discount_products.paginations.last_page = response.data.last_page;
                    $this.app.discount_products.paginations.from = response.data.from;
                    $this.app.discount_products.paginations.to = response.data.to;
                    $this.app.spin = false;
                }
            });
        },
        validateProduct(product) {
            if (product == '') {
                return false;
            }
            return true;
        },
        addCart(product){
          let $this =  this;
          $this.app.cartadd.id = product.id;
          $this.app.cartadd.name = product.title;
          $this.app.cartadd.price = product.price;
          $this.app.cartadd.image = product.product_image;
          $this.app.cartadd.quantity = this.quantity;
          $this.app.cart.push($this.app.cartadd);
          $this.app.cartadd = {}
          this.quantity=1;
          this.storeCart();

        },
        storeCart(){
            let $this =  this;
           let parsed =  JSON.stringify($this.app.cart);
           localStorage.setItem('cart',parsed);
           this.viewCart();
        },
        viewCart(){
            let $this =  this;
          if(localStorage.getItem('cart')){
              $this.app.cart = JSON.parse(localStorage.getItem('cart'));
              $this.app.badge = $this.app.cart.length;
              $this.app.totalprice = $this.app.cart.reduce((total,item)=>{
                      return total + item.quantity * item.price;
              },0);
          }

        },


    }
};
</script>
