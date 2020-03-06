<template>
  <div class="Shopping-cart-area pt-60 pb-60">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <form action="#">
            <div class="table-content table-responsive">
              <table class="table" style="border:none">
                <thead>
                  <tr>
                    <th></th>
                    <th class="li-product-thumbnail">images</th>
                    <th class="cart-product-name">Product</th>
                    <th class="li-product-price">Unit Price</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(product,index) in $store.getters.WISHLIST" :key="product.id">
                    <td class="li-product-remove">
                      <a href="#" @click.prevent="removeWishList(index)">
                        <i class="fa fa-times fa-2x"></i>
                      </a>
                    </td>
                    <td class="li-product-thumbnail">
                      <a href="#">
                        <img
                          :src="`/storage/images/product/${product.product_image}`"
                          alt="Li's Product Image"
                          class="product_img"
                        />
                      </a>
                    </td>
                    <td class="li-product-name">
                      <a href="#">{{product.title}}</a>
                    </td>
                    <td class="li-product-price">
                      <span class="amount">&#8358;{{product.price}}</span>
                    </td>

                    <td class="li-product-price">
                        <ul class="add-actions-link row justify-content-center">
                    <li class="add-cart github-btn">
                      <a href="#" @click.prevent="add2cart(product)">
                        <i class="fa fa-cart-plus fa-2x ml-1"></i>
                      </a>
                    </li>
                        </ul>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="coupon-all">
                  <div class="coupon2 float-right">
                      <input class="button" @click.prevent="emptyWishList" name="apply_coupon" value="Remove All Item" type="submit">
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "wishlist",
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
          icon: true
        });
      } else {
        this.$store.dispatch("AddCartItem", product);
        this.$toast.success(`${product.title} Added To Cart`, {
          closeOnClick: true,
          pauseOnFocusLoss: true,
          pauseOnHover: false,
          draggable: true,
          draggablePercent: 0.6,
          hideCloseButton: false,
          hideProgressBar: true,
          icon: true
        });
      }
    },
    removeWishList(product) {
      this.$store.dispatch("RemoveWishListItem", product);
    },
    emptyWishList() {
      this.$store.dispatch("EmptyWishListItem");
    }
  }
};
</script>