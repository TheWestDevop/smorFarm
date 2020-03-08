<template>
  <div class="Shopping-cart-area pt-60 pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <form action="#">
                                <div class="table-content table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="li-product-remove">remove</th>
                                                <th class="li-product-thumbnail">images</th>
                                                <th class="cart-product-name">Product</th>
                                                <th class="li-product-price">Unit Price</th>
                                                <th class="li-product-quantity">Quantity</th>
                                                <th class="li-product-subtotal">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(product,index) in $store.getters.CART" :key="product.id">
                                                <td class="li-product-remove"><a href="#" @click.prevent="remove(index)"><i class="fa fa-times"></i></a></td>
                                                <td class="li-product-thumbnail"><a href="#"><img :src="`images/product/${product.image}`" alt="Li's Product Image" class="product_img"></a></td>
                                                <td class="li-product-name"><a href="#">{{product.name}}</a></td>
                                                <td class="li-product-price"><span class="amount">&#8358;{{product.price}}</span></td>
                                                <td class="quantity">
                                                    <label>Quantity</label>
                                                    <div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box" v-model="product.quantity" min="1" type="number">
                                                        <div class="dec qtybutton" @click.prevent="decrease(index)"><i class="fa fa-angle-down"  ></i></div>
                                                        <div class="inc qtybutton" @click.prevent="increase(index)"><i class="fa fa-angle-up" ></i></div>
                                                    <div class="dec qtybutton" @click.prevent="decrease(index)"><i class="fa fa-angle-down"></i></div>
                                                    <div class="inc qtybutton" @click.prevent="increase(index)"><i class="fa fa-angle-up"></i></div>
                                                    </div>
                                                </td>
                                                <td class="li-product-price"><span class="amount">&#8358;{{product.price * product.quantity}}</span></td>
                                                </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="coupon-all">
                                            <div class="coupon2 float-lg-right" >
                                                <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                                <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 ml-auto">
                                        <div class="cart-page-total">
                                            <h2>Cart totals</h2>
                                            <ul>
                                                <li>Subtotal <span>&#8358;{{$store.getters.CART_TOTAL}}</span></li>
                                                <li>Delivery Fee <span>&#8358;{{$store.getters.ALL_SERVICE_CHARGE.delivery}}</span></li>
                                                <li>Service Charges <span>&#8358;{{$store.getters.ALL_SERVICE_CHARGE.service_charge}}</span></li>
                                                <li>Service Tax <span>&#8358;{{$store.getters.ALL_SERVICE_CHARGE.service_tax}}</span></li>
                                                <li>Vat Charge <span>&#8358;{{$store.getters.ALL_SERVICE_CHARGE.vat}}</span></li>
                                                <li>Total <span>&#8358;{{$store.getters.TOTAL}}</span></li>
                                            </ul>
                                            <router-link to="checkout">Proceed to checkout</router-link>
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
name: "Cart",
  methods:{
        remove(product){
             this.$store.dispatch('RemoveCartItem',product);
        },
        increase(n){
            console.log('increase')
             this.$store.dispatch('IncreaseCartItemQuantity',n);
        },
        decrease(n){
            console.log('decrease')
             this.$store.dispatch('DecreaseCartItemQuantity',n);
        }

    }
}
</script>

<style>

</style>