<template>
   <!-- Li's Static Home Area End Here -->
            <!-- Begin Li's Trending Product | Home V2 Area -->
            <section class="product-area li-trending-product li-trending-product-2 pt-60 pb-45">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Tab Menu Area -->
                        <div class="col-lg-12">
                            <div class="li-product-tab li-trending-product-tab">
                                <h2>
                                    <span>Trending Products</span>
                                </h2>
                                <ul class="nav li-product-menu li-trending-product-menu">
                                   <li class="active">
                <router-link to='market'>
                  see more
                  <i class="fa fa-arrow-right"></i>
                </router-link>
              </li>
                                </ul>               
                            </div>
                            <!-- Begin Li's Tab Menu Content Area -->
                            <div class="tab-content li-tab-content li-trending-product-content">
                                <div id="home1" class="tab-pane show fade in active">
                                   <div class="ad-product">
            <div
              v-for="product in products"
              :key="product.id"
              class="col-lg-3 col-md-4 col-sm-12"
            >
              <!-- single-product-wrap start -->
              <div class="single-product-wrap">
                <div class="product-image">
                  <a
                    href="#"
                    title="quick view"
                    class="quick-view-btn"
                    data-toggle="modal"
                    data-target="#exampleModalCenter"
                    @click="view(product.id)"
                  >
                    <img
                      :src="`/images/product/${product.product_image}`"
                      alt="Li's Product Image"
                      class="p-image"
                    />
                  </a>
                </div>
                <div class="product_desc">
                  <div class="product_desc_info">
                    <div class="product-review">
                      <h5 class="manufacturer">
                        <a href="#">SmorFarm</a>
                      </h5>
                      <div class="rating-box">
                        <ul class="rating">
                          <li>
                            <i class="fa fa-star-o"></i>
                          </li>
                          <li>
                            <i class="fa fa-star-o"></i>
                          </li>
                          <li>
                            <i class="fa fa-star-o"></i>
                          </li>
                          <li class="no-star">
                            <i class="fa fa-star-o"></i>
                          </li>
                          <li class="no-star">
                            <i class="fa fa-star-o"></i>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <h4>
                      <a class="product_name" href="#">{{product.title}}</a>
                      <a class="m-3 float-right" href="#" @click.prevent="wishlist(product)">
                        <i class="fa fa-heart-o"></i>
                      </a>
                    </h4>
                    <div class="price-box">
                      <span class="new-price  new-price-2">&#8358; {{product.price}}</span>
                      <span class="old-price float-right"> &#8358; {{actual_price(product.price)}} </span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- single-product-wrap end -->
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
            <!-- Li's Trending Product | Home V2 Area End Here -->
   
</template>

<script>
import { mapGetters } from "vuex";
export default {
    name:"trending_product",
     computed: mapGetters({ products: "TRENDING_PRODUCT" }),
     methods:{
      view(id){
         this.$store.dispatch('fetchSingleProduct',id)
      },
      wishlist(product) {
            if (this.$store.getters.WISHLIST.some(item => item.id === product.id)) {

                return this.$toast.warning(`${product.title} added already`, {
                    closeOnClick: true,
                    pauseOnFocusLoss: true,
                    pauseOnHover: false,
                    draggable: true,
                    draggablePercent: 0.6,
                    hideCloseButton: false,
                    hideProgressBar: true,
                    icon: true,
                })

            } else {
                this.$store.dispatch('AddWishListItem', product);
                this.$toast.success(`${product.title} Added To Wishlist`, {
                    closeOnClick: true,
                    pauseOnFocusLoss: true,
                    pauseOnHover: false,
                    draggable: true,
                    draggablePercent: 0.6,
                    hideCloseButton: false,
                    hideProgressBar: true,
                    icon: true,
                }) 
            }
        },
      actual_price(price){
         return parseFloat(price * 0.25) + parseInt(price);
       }
  }
    

}
</script>

<style>

</style>