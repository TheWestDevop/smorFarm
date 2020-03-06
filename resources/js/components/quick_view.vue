<template>
  <!-- Begin Quick View | Modal Area -->
            <div class="modal fade modal-wrapper" id="exampleModalCenter" >
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-inner-area row">
                                <div class="col-lg-5 col-md-6 col-sm-6">
                                   <!-- Product Details Left -->
                                    <div class="product-details-left">
                                        <div class="product-details-images slider-navigation-1">
                                            <div class="lg-image">
                                                <img :src="`/storage/images/product/${product.product_image}`" alt="product image">
                                            </div>
                                            <div class="lg-image">
                                                <img :src="`/storage/images/product/${product.product_image}`" alt="product image">
                                            </div>
                                            <div class="lg-image">
                                                <img :src="`/storage/images/product/${product.product_image}`" alt="product image">
                                            </div>
                                            <div class="lg-image">
                                                <img :src="`/storage/images/product/${product.product_image}`" alt="product image">
                                            </div>
                                            <div class="lg-image">
                                                <img :src="`/storage/images/product/${product.product_image}`" alt="product image">
                                            </div>
                                            <div class="lg-image">
                                                <img :src="`/storage/images/product/${product.product_image}`" alt="product image">
                                            </div>
                                        </div>
                                        <div class="product-details-thumbs slider-thumbs-1">
                                            <div class="sm-image"><img :src="`/storage/images/product/${product.product_image}`" alt="product image thumb"></div>
                                            <div class="sm-image"><img :src="`/storage/images/product/${product.product_image}`" alt="product image thumb"></div>
                                            <div class="sm-image"><img :src="`/storage/images/product/${product.product_image}`" alt="product image thumb"></div>
                                            <div class="sm-image"><img :src="`/storage/images/product/${product.product_image}`" alt="product image thumb"></div>
                                            <div class="sm-image"><img :src="`/storage/images/product/${product.product_image}`" alt="product image thumb"></div>
                                            <div class="sm-image"><img :src="`/storage/images/product/${product.product_image}`" alt="product image thumb"></div>
                                        </div>
                                    </div>
                                    <!--// Product Details Left -->
                                </div>

                                <div class="col-lg-7 col-md-6 col-sm-6">
                                    <div class="product-details-view-content pt-60">
                                        <div class="product-info">
                                            <h2>{{product.title}}</h2>

                                            <div class="rating-box pt-20">
                                                <ul class="rating rating-with-review-item">
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li><i class="fa fa-star-o"></i></li>
                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                    <li class="review-item"><a href="#">Read Review</a></li>
                                                    <li class="review-item"><a href="#">Write Review</a></li>
                                                </ul>
                                            </div>
                                            <div class="price-box pt-20">
                                                <span class="new-price new-price-2">&#8358; {{product.price}}</span>
                                                <span class="old-price ml-5"> <del>&#8358; {{actual_price(product.price)}} </del> </span>
                            
                                            </div>
                                            <div class="product-desc">
                                                <p>
                                                    <span>{{product.description}}</span>
                                                </p>
                                            </div>
                                        
                                            <div class="single-add-to-cart">
                                                <form action="#" class="cart-quantity">
                                                    
                                                    <button class="add-to-cart text-white github-btn" @click.prevent="add_cart(product)"><i class="fa fa-cart-plus fa-2x ml-2"></i></button>
                                                </form>
                                            </div>
                                            <div class="product-additional-info pt-25">
                                                <a class="wishlist-btn" href="#" @click.prevent="wishlist(product)"><i class="fa fa-heart-o"></i>Add to wishlist</a>
                                                <div class="product-social-sharing pt-25">
                                                    <ul>
                                                        <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                                        <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                                        <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a></li>
                                                        <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Quick View | Modal Area End Here -->
</template>

<script>
import { mapGetters } from "vuex";
export default {
    name:"Quick_product_view",
    
    computed:mapGetters({ product: "SINGLE_PRODUCT" }),
    methods:{
        add_cart(product){
            if (this.$store.getters.CART.some(item => item.id === product.id)) {

            return this.$toast.warning('Product added already',{
              position:'bottom-center',
              timeout:500,
              closeOnClick:true,
              pauseOnFocusLoss:true,
              pauseOnHover:false,
              draggable:true,
              draggablePercent:0.6,
              hideCloseButton:false,
              hideProgressBar:true,
              icon:true,
              })


          }else{
             this.$store.dispatch('AddCartItem',product);
           this.$toast.success('Product Added To Cart', {
            position: 'bottom-center',
            timeout: 500,
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
       },
      
    }
}
</script>

<style>

</style>