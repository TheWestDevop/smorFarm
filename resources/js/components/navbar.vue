<template>
  <!-- Begin Header Area -->
  <header>
    <!-- Begin Header Middle Area -->
    <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
      <div class="container">
        <div class="row">
          <!-- Begin Header Logo Area -->
          <div class="col-lg-3">
            <div class="logo pb-sm-30 pb-xs-30">
              <router-link :to="{name:'home'}">
                <div class="h1 text-black">
                  <strong class="mor">SMOR</strong>
                  Farm
                </div>
              </router-link>
            </div>
          </div>
          <!-- Header Logo Area End Here -->
          <!-- Begin Header Middle Right Area -->
          <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
            <!-- Begin Header Middle Searchbox Area -->
            <form v-on:submit.prevent="search" class="hm-searchbox mr-4">
              <input type="text" v-model="word" placeholder="Search Product ..." />
              <button class="li-btn" type="submit">
                <i class="fa fa-search"></i>
              </button>
            </form>
            <!-- Header Middle Searchbox Area End Here -->
            <div class="header-middle-right">
              <div class="hm-menu">
                <div class="hm-minicart-trigger" data-toggle="modal" data-target="#myModal">
                  <span class="item-icon"></span>
                  <span class="item-text">
                    &#8358; {{app.totalprice}}
                    <span class="cart-item-count">{{app.badge}}</span>
                  </span>
                </div>
                <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content mt-100">
                      <div class="modal-header">
                        <h4 class="modal-title">Your Cart</h4>
                      </div>
                      <div class="minicart">
                        <ul class="minicart-product-list">
                          <li v-for="(cart,n) in app.cart" :key="cart.id">
                            <a href="#" class="minicart-product-image">
                              <img
                                :src="`/storage/images/product/${cart.image}`"
                                alt="cart products"
                              />
                            </a>
                            <div class="minicart-product-details">
                              <h6>
                                <strong>
                                  <a href="#">{{cart.name}}</a>
                                </strong>
                              </h6>
                              <span class="text-black">&#8358; {{cart.price}} x {{cart.quantity}}</span>
                            </div>

                            <div class="d-inline-flex mr-5">
                              <i class="fa fa-minus fa-1x decrease m-2" @click="decrease(n)"></i>
                              <div class="m-2">{{cart.quantity }}</div>
                              <i class="fa fa-plus fa-1x increase m-2" @click="increase(n)"></i>
                            </div>

                              <i class="fa fa-close text-danger"  @click="removeCart(n)"></i>



                          </li>
                        </ul>
                        <p class="minicart-total">
                          SUBTOTAL:
                          <span>&#8358; {{app.totalprice}}</span>
                        </p>
                        <div class="minicart-button">
                          <div v-if="cartEmpty"></div>
                          <router-link
                            :to="{name:'checkout'}"
                            v-else
                            class="li-button li-button-fullwidth"
                            data-dismiss="modal"
                          >
                            <span>Checkout</span>
                          </router-link>

                          <button
                            type="button"
                            class="mt-2 btn btn-danger btn-block li-button-fullwidth"
                            data-dismiss="modal"
                          >Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Header Middle Right Area End Here -->
        </div>
      </div>
    </div>
    <!-- Header Middle Area End Here -->
    <!-- Begin Header Bottom Area -->
    <div class="header-bottom header-sticky d-none d-lg-block d-xl-block justify-content-center">
      <div class="container">
        <div class="row">
          <div class="col-xl-2 col-lg-2"></div>
          <div class="col-lg">
            <!-- Begin Header Bottom Menu Area -->
            <div class="hb-menu">
              <nav>
                <ul>
                  <li>
                    <router-link :to="{name:'home'}">Home</router-link>
                  </li>
                  <li class="megamenu-static-holder">
                    <a href="#">Categories</a>
                    <div class="megamenu hb-megamenu">
                      <br />

                      <div class=" d-inline w-100">
                        <router-link
                          class="category"
                          :to="{name:'mall'}"
                        >All</router-link>
                        <a
                          class="category"
                          @click="Category('Vegetables')"
                        >Vegetable</a>
                        <a
                          class="category"
                          @click="Category('Rice')"
                        >Rice</a>
                        <a
                          class="category"
                          @click="Category('Cereals')"
                        >Cereals</a>
                        <a
                          class="category"
                          @click="Category('Fruit')"
                        >Fruit</a>
                        <a
                          class="category"
                          @click="Category('Cooking oil')"
                        >Oil</a>
                        <a
                          class="category"
                          @click="Category('Pepper')"
                        >Pepper</a>
                         <a
                          class="category"
                          @click="Category('Chicken')"
                        >Birds</a>
                        <a
                          class=" category"
                          @click="Category('Meat')"
                        >Meat</a>
                        <a
                          class=" category"
                          @click="Category('Fish')"
                        >Fish</a>
                        <a
                          class=" category"
                          @click="Category('spices')"
                        >Spices</a>
                        <a
                          class=" category"
                          @click="Category('Kitchen Tools')"
                        >Utensils</a>
                        <a
                          class=" category"
                          @click="Category('Others')"
                        >Others</a>
                      </div>

                    </div>
                  </li>

                  <li>
                    <router-link :to="{name:'order_status'}">Check Order Status</router-link>
                  </li>
                  <li>
                    <a href="#">About Us</a>
                  </li>
                  <li>
                    <a href="#">Contact</a>
                  </li>
                  <li v-if="valid" class="dropdown">
                    <a
                      href="#"
                      class="nav-link dropdown-toggle"
                      id="navbarDropdown"
                      role="button"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <strong class="d-inline">
                        <i class="fa fa-user"></i>
                        {{ app.user.user.name }}
                      </strong>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <router-link class="dropdown-item" :to="{name:'profile'}">
                        <i class="fa fa-user-circle"></i>&nbsp;Profile
                      </router-link>

                      <router-link class="dropdown-item" :to="{name:'order'}">
                        <i class="fa fa-stack-exchange"></i>&nbsp;Orders
                      </router-link>
                      <a class="dropdown-item" href="#">
                        <i class="fa fa-money"></i>&nbsp;Wallet
                      </a>
                      <a @click.stop="logout" class="dropdown-item" href="javascript:;">
                        <i class="fa fa-sign-out"></i>&nbsp;Log out
                      </a>
                    </div>
                  </li>
                  <li v-if="valid">
                    <a href="#" data-toggle="modal" data-target="#myModalNotification" @click="notificationView">
                      <i class="fa fa-bell"></i>
                      <div class="notification-count" v-if="count">{{app.notify.count}}</div>
                    </a>
                  </li>

                  <li v-if="valid == false" class="font-italic mt-3 ml-auto">
                    <strong class="d-inline">
                      <router-link :to="{name:'auth.login'}">
                        Login&nbsp;
                        <i class="fa fa-sign-in"></i>
                      </router-link>
                    </strong>
                  </li>
                  <li v-if="valid == false" class="font-italic mt-3 ml-auto">
                    <strong class="d-inline">
                      <router-link :to="{name:'auth.register'}">
                        Register&nbsp;
                        <i class="fa fa-user"></i>
                      </router-link>
                    </strong>
                  </li>
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
    <div class="mobile-menu-area d-lg-none d-xl-none col-12 ml-1">
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
import Flash from "../util/flash";
import Auth from "../util/store";
import { get } from "../util/api";

export default {
  name: "Navbar",
  props: ["app"],

  created() {
    Event.$on("CartRemove", () => {
      this.refCart();
    });
    this.refCart(),
      Event.$on("Loggedin...", () => {
        this.app.initUser();
        Auth.init();
      });
    Event.$on("Ordered", () => {
      this.notify();
    });
    this.notify();
  },
  watch: {},
  data() {
    return {
      word: "",
      total:this.app.totalprice,
    };
  },
  computed: {

    cartEmpty() {
      if (this.app.cart.length === 0) {
        return true;
      }
      return false;
    },
    count() {
      if (this.app.notify.count == 0) {
        return false;
      }
      return true;
    },
    valid() {
      if (this.app.auth.api_token != null && this.app.auth.user_id != NaN) {
        return true;
      }
      return false;
    }
  },
  watch:{

  },
  methods: {
    notify() {
      let $this = this;
      get(BASE_URL + `/api/user/${$this.app.auth.user_id}/notification`).then(
        response => {
          $this.app.notify = response.data;

        }
      );
    },
    logout() {
      let $this = this;
      $this.app.spin = true;
      get(BASE_URL + "/api/auth/logout").then(() => {
        Auth.remove(),
          (this.app.user = ""),
          Flash.setSuccess("You have successfully logged out!");
        $this.app.spin = false;
        this.$router.push({
          name: "auth.login"
        });
      });
    },

    removeCart(product) {
      let $this = this;
      $this.app.cart.splice(product, 1);
      $this.$toast.info("Product removed", {
        position: "bottom-center",
        timeout: 1000,
        closeOnClick: true,
        pauseOnFocusLoss: true,
        pauseOnHover: false,
        draggable: true,
        draggablePercent: 0.6,
        hideCloseButton: false,
        hideProgressBar: true,
        icon: true
      });
      this.$emit("CartRemoved");
      this.storeCart();
    },
    storeCart() {
      let $this = this;
      let parsed = JSON.stringify($this.app.cart);
      localStorage.setItem("cart", parsed);
      this.refCart();
    },
    refCart() {
      let $this = this;
      if (localStorage.getItem("cart")) {
        $this.app.cart = JSON.parse(localStorage.getItem("cart"));
        $this.app.badge = $this.app.cart.length;
        $this.app.totalprice = $this.app.cart.reduce((total, item) => {
          return total + item.quantity * item.price;
        }, 0);
      }
    },
    search() {
      let $this = this;
      Event.$emit("Search");

      $this.$router.push({
        name: "Search",
        params: {
          statement: this.word
        }
      });
      this.word = "";
    },
    Category(category) {
      console.log(category);
      this.$router.push({
        name: "ProductByCategory",
        params: {
          category: category
        }
      });
      Event.$emit("productCategory");
    },
    decrease(product) {
      let $this = this;
      if ($this.app.cart[product].quantity === 1) {
        return;
      }
      $this.app.cart[product].quantity -= 1;
      $this.app.totalprice = $this.app.cart.reduce((total, item) => {
        return total + item.quantity * item.price;
      }, 0);
      let parsed = JSON.stringify($this.app.cart);
      localStorage.setItem("cart", parsed);
    },
    increase(product) {
      let $this = this;
      $this.app.cart[product].quantity += 1;
      $this.app.totalprice = $this.app.cart.reduce((total, item) => {
        return total + item.quantity * item.price;
      }, 0);
      let parsed = JSON.stringify($this.app.cart);
      localStorage.setItem("cart", parsed);
    },
   notificationView(){
         let $this = this;
      get(BASE_URL + `/api/update/notification/${$this.app.auth.user_id}`).then(
        response => {
            this.notify()
        }
      );
    },

  }
};
</script>
