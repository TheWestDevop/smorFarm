<template>
  <!-- Begin Header Area -->

  <header>
    <!-- Begin Header Middle Area -->
    <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
      <div class="container">
        <div class="row">
          <!-- Begin Header Logo Area -->
          <div class="col-lg-3">
            <div class="logo pb-sm-50 pb-xs-50">
              <a href="#">
                <Strong class="mor">Smor</Strong>
              </a>
            </div>
          </div>
          <!-- Header Logo Area End Here -->
          <!-- Begin Header Middle Right Area -->
          <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
            <!-- Begin Header Middle Searchbox Area -->
            <form action="#" class="hm-searchbox">
              <select class="nice-select select-search-category">
                <option value="0">All</option>
                <option value="10">- - - - Grains-Beans</option>
                <option value="17">- - - - Nuts</option>
                <option value="16">- - - - Tubers</option>
                <option value="20">- - - - Vegetables</option>
                <option value="21">- - - - Poultry</option>
                <option value="22">- - - - Meat</option>
                <option value="23">- - - - Fish</option>
                <option value="24">- - - - Seafood</option>
                <option value="25">- - - - Dairy</option>
                <option value="26">- - - - Eggs</option>
                <option value="27">- - - - Oils</option>
                <option value="28">- - - - Fruits</option>
                <option value="18">- - - - Spices</option>
                <option value="29">- - - - Others</option>
              </select>
              <input type="text" placeholder="Enter your search key ..." />
              <button class="li-btn" type="submit">
                <i class="fa fa-search"></i>
              </button>
            </form>
            <!-- Header Middle Searchbox Area End Here -->
            <!-- Begin Header Middle Right Area -->
            <div class="header-middle-right">
              <ul class="hm-menu">
                <!-- Begin Header Middle Wishlist Area -->
                <li class="hm-wishlist">
                  <router-link
                        :to="{name:'wishlist'}"

                      >
                    <span class="cart-item-count wishlist-item-count ">{{$store.getters.WISHLIST.length}}</span>
                    <i class="fa fa-heart-o"></i>
                  </router-link>
                </li>
                <!-- Header Middle Wishlist Area End Here -->
                <!-- Begin Header Mini Cart Area -->
                <li class="hm-minicart">
                  <div class="hm-minicart-trigger">
                    <span class="item-icon"></span>
                    <span class="item-text">
                      &#8358;{{$store.getters.CART_TOTAL}}
                      <span
                        class="cart-item-count"
                      >{{$store.getters.CART_BADGE}}</span>
                    </span>
                  </div>
                  <span></span>
                  <div class="minicart" v-if="$store.getters.CART_BADGE != 0">
                    <ul class="minicart-product-list">
                      <li v-for="(product,index) in $store.getters.CART" :key="product.id">
                        <a href="#" class="minicart-product-image">
                          <img
                            :src="`/storage/images/product/${product.image}`"
                            alt="cart products"
                          />
                        </a>
                        <div class="minicart-product-details">
                          <h6>
                            <a href="#" class="font-weight-bold">{{product.name}}</a>
                          </h6>
                          <span>&#8358;{{product.price}} x {{product.quantity}}</span>
                        </div>
                        <button class="close" @click="remove(index)">
                          <i class="fa fa-close"></i>
                        </button>
                      </li>
                    </ul>
                    <p class="minicart-total">
                      SUBTOTAL:
                      <span>&#8358;{{$store.getters.CART_TOTAL}}</span>
                    </p>
                    <div class="minicart-button">
                      <router-link
                        :to="{name:'cart'}"
                        class="li-button li-button-dark li-button-fullwidth li-button-sm"
                      >
                        <span>View Full Cart</span>
                      </router-link>
                      <router-link
                        :to="{name:'checkout'}"
                        class="li-button li-button-fullwidth li-button-sm"
                      >
                        <span>Checkout</span>
                      </router-link>
                    </div>
                  </div>
                </li>
                <!-- Header Mini Cart Area End Here -->
              </ul>
            </div>
            <!-- Header Middle Right Area End Here -->
          </div>
          <!-- Header Middle Right Area End Here -->
        </div>
      </div>
    </div>
    <!-- Header Middle Area End Here -->
    <!-- Begin Header Bottom Area -->
    <div class="header-bottom header-sticky d-none d-lg-block">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <!-- Begin Header Bottom Menu Area -->
            <div class="hb-menu hb-menu-2 d-xl-block">
              <nav>
                <ul>
                  <li>
                    <router-link :to="{name:'home'}">home</router-link>
                  </li>
                  <li>
                    <router-link :to="{name:'mall'}">Market</router-link>
                  </li>

                  <li>
                    <router-link :to="{name:'kitchen'}">Kitchens</router-link>
                  </li>
                  <li >
                    <a href="#">Book a chef</a>
                  </li>
                  <li>
                    <a href="#">how to</a>
                  </li>
                  <li>
                    <router-link :to="{name:'order_status'}">Order Status</router-link>
                  </li>

                  <li>
                    <a href="#">Customer Care</a>
                  </li>
                    <li class="hb-info f-right" v-if="$store.getters.AUTH_STATUS === true"><a href="#" @click="logout()"><i class="fa fa-sign-out fa-2x mt-1 ml-2"></i></a></li>
                    <li class="hb-info f-right  dropdown" v-if="$store.getters.AUTH_STATUS === true" @click="notification_seen">
                        <a href="#" role="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><span class="notify-item-count" v-if="this.$store.getters.NOTIFICATION_BADGE != 0">{{this.$store.getters.NOTIFICATION_BADGE}}</span><i class="fa fa-bell fa-2x mt-1 ml-2"></i></a>
                         <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right mt-2" aria-labelledby="navbar-default_dropdown_1" v-if="this.$store.getters.NOTIFICATION_BADGE != 0">
                                <p class="dropdown-item"  v-for="(notification,n) in notifications" :key="n.index"> {{notification.message}} <br> <i class="float-right  text-gray" style="font-size:10px!important;">{{notification.created_at | ago }} </i></p>
                            </div>
                        </li>
                    <li class="hb-info f-right dropdown" v-if="$store.getters.AUTH_STATUS === true" data-toggle="dropdown">
                        <a href="#" class="dropdown-toggle"><i class="mt-1">{{$store.getters.USER.user.name}}</i>&nbsp;&nbsp;<i class="fa fa-user fa-1x mt-3 ml-1"></i></a>
                        <ul class="ht-setting-list dropdown-menu">
                        <li><router-link :to="{name:'profile'}">My Profile</router-link></li>
                        <li><router-link :to="{name:'order'}">My Orders</router-link></li>
                        <li><router-link :to="{name:'pre_order'}">My Pre-Orders</router-link></li>
                        <li><router-link :to="{name:'user_kitchen'}">My Kitchens</router-link></li>
                        <!--  <li><router-link :to="{name:'chef'}">My Chefs</router-link></li> -->
                        </ul>

                    </li>
                  <li class="hb-info f-right" v-if="$store.getters.AUTH_STATUS === false">
                    <router-link :to="{name:'auth.register'}">Register</router-link>
                  </li>
                  <!-- Begin Header Bottom Menu Information Area -->
                  <li class="hb-info f-right" v-if="$store.getters.AUTH_STATUS === false">
                    <router-link :to="{name:'auth.login'}">Login</router-link>
                  </li>

                  <!-- Header Bottom Menu Information Area End Here -->
                </ul>
              </nav>
            </div>
            <!-- Header Bottom Menu Area End Here -->
          </div>
        </div>
      </div>
    </div>
    <!-- Header Bottom Area End Here -->
    <!-- Begin Mobile Menu Area -->
    <div class="mobile-menu-area d-lg-none d-xl-none col-12">
      <div class="container">
        <div class="row">
          <div class="mobile-menu"></div>
        </div>
      </div>
    </div>
    <!-- Mobile Menu Area End Here -->
  </header>
  <!-- Header Area End Here -->
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "Navbar",
  computed: mapGetters({ notifications: "NOTIFICATION" }),
  methods: {
    remove(product) {
      this.$store.dispatch("RemoveCartItem", product);
    },
    notification_seen(){
        this.$store.dispatch("notificationSeen")
        setTimeout(()=>{
                   this.$store.dispatch("get_notification");
           },10000);
    },
    logout(){
        this.$store.dispatch("logOut")
            .then(()=>{

                        this.$router.push({
                            name: "auth.login"
                        });
                        this.$toast.success('You are logged Out!',{
                                position:'bottom-center',
                                timeout:5000,
                                closeOnClick:true,
                                pauseOnFocusLoss:true,
                                pauseOnHover:false,
                                draggable:true,
                                draggablePercent:0.6,
                                hideCloseButton:false,
                                hideProgressBar:true,
                                icon:true,})
                 })

    }
  }
};
</script>
