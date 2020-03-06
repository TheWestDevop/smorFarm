<template>
  <!-- Begin Li's Laptops Product | Home V2 Area -->
  <section class="product-area li-laptop-product li-laptop-product-2 pb-45">
    <div class="container">
      <div class="row">
        <!-- Begin Li's Section Area -->
        <div class="col-lg-12">
          <div class="li-section-title">
            <h2>
              <span>Discount Products</span>
            </h2>
            <ul class="li-sub-category-list">
              <li class="active">
                <router-link to='market'>
                  see more
                  <i class="fa fa-arrow-right"></i>
                </router-link>
              </li>
            </ul>
          </div>
          <div class="li-banner pt-15">
            <div class="row">
              <!-- Begin Single Banner Area -->
              <div class="col-lg-6 col-md-6">
                <div class="single-banner">
                  <a href="#">
                    <img src="images/slider/15.jpg" alt="Li's Static Banner" />
                  </a>
                </div>
              </div>
              <!-- Single Banner Area End Here -->
              <!-- Begin Single Banner Area -->
              <div class="col-lg-6 col-md-6">
                <div class="single-banner pt-xs-30">
                  <a href="#">
                    <img src="images/slider/36.jpg" alt="Li's Static Banner" />
                  </a>
                </div>
              </div>
              <!-- Single Banner Area End Here -->
            </div>
          </div>
          <div class="ad-product">
            <div
              v-for="product in products.data"
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
                      :src="`images/product/${product.product_image}`"
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
                      <span class="new-price">&#8358; {{product.price}}</span>
                      <span class="discount-percentage">-{{product.discount}}%</span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- single-product-wrap end -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Li's Section Area End Here -->
  </section>
  <!-- Li's Discount Products Product | Home V2 Area End Here -->
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "banner_product",
  computed: mapGetters({ products: "DISCOUNT_PRODUCT" }),
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
  }
};
</script>

<style>
</style>