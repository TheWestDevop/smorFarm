<template>
    <div class="row product-layout-list">
        <div class="col-lg-3 col-md-5">
            <div class="product-image">
                <a href="#">
                    <img :src="`/images/product/${product.product_image}`" alt="Li's Product Image" />
                </a>
            </div>
        </div>
        <div class="col-lg-5 col-md-7">
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
                    <p>{{product.description}}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="shop-add-action mb-xs-30">
                <ul class="add-actions-link">
                    <li class="add-cart github-btn">
                        <a href="#" @click.prevent="add2cart(product)"><i class="fa fa-cart-plus fa-2x ml-1"></i></a>
                    </li>
                    <li class="wishlist github-btn">
                        <a href="#" @click.prevent="wishlist(product)">
                            <i class="fa fa-heart-o"></i>Add to wishlist
                        </a>
                    </li>
                    <li class="github-btn">
                        <a class="quick-view" data-toggle="modal" data-target="#exampleModalCenter" @click="view(product.id)" href="#">
                            <i class="fa fa-eye"></i>Quick view
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "list_grid_view",
    props: ["product"],
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
            this.$store.dispatch("fetchSingleProduct", id);
        },
        actual_price(price) {
            return parseFloat(price * 0.25) + parseInt(price);
        },
        product_info(id) {
            this.$store.dispatch("fetchSingleProduct", id);
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
