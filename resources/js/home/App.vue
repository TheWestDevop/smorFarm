<template>
  <div class="body-wrapper">
    <Navbar />

    <Spinner v-if="spin === true" />
    <router-view v-else></router-view>
    <Footer />
    <Product_View />
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import axios from "axios";
import Navbar from "../components/navbar.vue";
import Footer from "../components/footer.vue";
import Spinner from "../components/spinner";
import Product_View from "../components/quick_view";
var CronJob = require('cron').CronJob

export default {
  name: "app",
  components: {
    Navbar,
    Footer,
    Spinner,
    Product_View
  },
  created() {
    this.$store.dispatch("GetCartItem");
    this.$store.dispatch("GetWishListItem");
    this.$store.dispatch("fetchAllProduct");
    this.$store.dispatch("fetchLatestProduct");
    this.$store.dispatch("fetchDiscountProduct");
    this.$store.dispatch("fetchTrendingProduct");
    this.$store.dispatch("get_available_kitchen");
    this.$store.dispatch("get_unavailable_kitchen");
     const job = new CronJob("* * * * *",()=>{this.$store.dispatch("updateBooking")});
     job.start()

    if (this.$store.getters.AUTH_STATUS === true) {
      this.$store.dispatch("get_notification");
      this.$store.dispatch(
        "fetchAllUserOrder",
        this.$store.state.UserModule.user.user.id
      );
      this.$store.dispatch(
        "fetchAllUserPreOrder",
        this.$store.state.UserModule.user.user.id
      );
      this.$store.dispatch(
        "fetchallUserkitchen",
        this.$store.state.UserModule.user.user.name
      );
    }

    axios.interceptors.response.use(undefined, function(err) {
      return new Promise((resolve, reject) => {
        if (err.status === 401 && err.config && !err.config.isRetryRequest) {
          this.$store.dispatch("logOut").then(() => {
            this.$router.push({
              name: "auth.login"
            });
          });
        }
      });
    });
  },
  computed: mapGetters({ spin: "DATA_LOADING" })
};
</script>

<style>
</style>
