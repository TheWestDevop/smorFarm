<template>
  <!-- Begin Login Content Area -->
  <div class="page-section mb-60">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
          <!-- Login Form -->
          <form v-on:submit.prevent="login">
            <div class="login-form">
              <h2 class="login-title">Login</h2>
              <div class="mt-2 p-2 font-italic text-danger">{{errorMsg}}</div>
              <div class="row">
                <div class="col-md-12 col-12 mb-20">
                  <label>Email Address</label>
                  <input
                    class="mb-0"
                    type="email"
                    v-model="email"
                    placeholder="Email Address"
                    v-bind:class="{'is-invalid':errorEmail}"
                  />
                  <div class="mt-2 p-2 font-italic text-danger">{{errorEmail}}</div>
                </div>
                <div class="col-12 mb-10">
                  <label>Password</label>
                  <input
                    class="mb-0"
                    type="password"
                    v-model="password"
                    placeholder="Password"
                    v-bind:class="{'is-invalid':errorPassword}"
                  />
                  <div class="mt-2 p-2 font-italic text-danger">{{errorPassword}}</div>
                </div>
                <div class="col-md-12 justify-content-left mb-5 p-2 ml-2">
                  <router-link class="dropdown-item" :to="{name:'reset'}">Forgotten password?</router-link>
                </div>
                <div class="col-md-12 mt-3">
                  <button type="submit" class="register-button mt-0">Login</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content Area End Here -->
</template>

<script>
import { post } from "../../util/api"; 


export default {
  name: "Login",
  data() {
    return {
      email: "",
      errorEmail: "",
      password: "",
      errorPassword: "",
      errorMsg: "",
      errors: [],
    };
  },
  methods: {
    login() {
      this.errors = [];
      
      if (this.email.length < 5 && this.email === "") {
        this.errorEmail = "Invalid Email";
        this.errors.push(this.errorEmail);
        this.$store.dispatch("spinner", false);
      } else {
        this.errorEmail = null;
      }
      if (this.password.length < 10 && this.password === "") {
        this.errorPassword = "Invalid Password";
        this.errors.push(this.errorPassword);
        this.$store.dispatch("spinner", false);
      } else {
        this.errorPassword = null;
      }
      
      this.$store.dispatch("spinner", true);
      if (!this.errors.length) {
        let $this = this;

        let data = {
          email: this.email,
          password: this.password
        };
        post(BASE_URL+'/api/auth/login', data).then(function (response) {

           if (response.data.error) {
            $this.$store.dispatch("spinner", false);
            $this.$toast.error('Wrong username or password given', {
              position: "bottom-center",
              timeout: 10000,
              closeOnClick: true,
              pauseOnFocusLoss: true,
              pauseOnHover: false,
              draggable: true,
              draggablePercent: 0.6,
              hideCloseButton: false,
              hideProgressBar: true,
              icon: true
            });
            return;
          } else {
            $this.$store.dispatch("login",response.data);
            $this.$store.dispatch("get_notification");
            $this.$store.dispatch(
              "fetchAllUserOrder",
              $this.$store.state.UserModule.user.user.id
            );
            $this.$store.dispatch(
              "fetchAllUserPreOrder",
              $this.$store.state.UserModule.user.user.id
            );
            $this.$store.dispatch("get_available_kitchen");
            $this.$store.dispatch("get_unavailable_kitchen");
            $this.$store.dispatch("spinner", false);
            $this.$router.push({
              name: "mall"
            });
            $this.$toast.success("You are logged in!", {
              position: "bottom-center",
              timeout: 5000,
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
        })
        
      }
    }
  }
};
</script>

<style scoped>
</style>
