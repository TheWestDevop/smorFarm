<template>
    <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
        <!-- single-product-wrap start -->
        <div class="single-product-wrap">
            <div class="product-image">
                <a href="#">
                    <img :src="`images/product/${product.product_image}`" alt="Li's Product Image" />
                </a>

            </div>
            <div class="product_desc">
                <div class="product_desc_info">
                    <div class="product-review">
                        <h5 class="manufacturer">
                            <a href="#" @click="about_us()">SmorFarm</a>
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
                        <a href="#" class="product_name">{{product.title}}</a>
                    </h4>
                    <div class="price-box">
                        <span class="new-price new-price-2">&#8358; {{product.price}}</span>
                        <span class="old-price float-right">&#8358; {{actual_price(product.price)}}</span>
                    </div>
                </div>
                <div class="add-actions">
                    <ul class="add-actions-link">
                        <li class="add-cart github-btn active">
                            <a href="#" @click.prevent="add2cart(product)"><i class="fa fa-cart-plus fa-2x ml-1"></i></a>
                        </li>
                        <li class="mini github-btn active">
                            <a href="#" title="quick view" class="quick-view-btn row justify-content-center text-white" data-toggle="modal" data-target="#exampleModalCenter" @click="view(product.id)">
                                <i class="fa fa-eye"></i>
                            </a>
                        </li>
                        <li class="mini github-btn active">
                            <a class="links-details row justify-content-center text-white" href="#" @click.prevent="wishlist(product)">
                                <i class="fa fa-heart-o"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- single-product-wrap end -->
    </div>
</template>

<script>
export default {
    name: 'product_grid_view',
    props: ['product'],
    methods: {
        add2cart(product) {
            if (this.$store.getters.CART.some(item => item.id === product.id)) {

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
                this.$store.dispatch('AddCartItem', product);
                this.$toast.success(`${product.title} Added To Cart`, {
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
        view(id) {
            this.$store.dispatch('fetchSingleProduct', id)
        },
        actual_price(price) {
            return parseFloat(price * 0.25) + parseInt(price);
        },
        product_info(id) {
            this.$store.dispatch('fetchSingleProduct', id)
            this.$router.push({
                name: "product-info"
            });
        },
        about_us() {
            this.$router.push({
                name: "about"
            });
        }

    }
};
</script>

<style>
</style>
