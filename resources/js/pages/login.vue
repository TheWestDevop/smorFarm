<template>
    <!-- Begin Login Content Area -->
    <div class="page-section mb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                    <!-- Login Form -->
                    <form v-on:submit.prevent="login">
                        <div class="login-form">
                            <h4 class="login-title">Login</h4>
                            <div class="mt-2 p-2 font-italic text-danger">{{errorMsg}}</div>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email Address</label>
                                    <input class="mb-0" type="email" v-model="email" placeholder="Email Address" v-bind:class="{'is-invalid':errorEmail}" />
                                    <div  class="mt-2 p-2 font-italic text-danger">{{errorEmail}}</div>
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Password</label>
                                    <input class="mb-0" type="password" v-model="password" placeholder="Password" v-bind:class="{'is-invalid':errorPassword}">
                                    <div class="mt-2 p-2  font-italic text-danger">{{errorPassword}}</div>
                                </div>
                                <div class="col-md-12 justify-content-left">
                                    <a href="#"> Forgotten password?</a>
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
import Flash  from  '../util/flash';
import Auth from '../util/store';
import { post } from "../util/api";
export default {
    name: 'Login',
    props: ['app'],
    data() {
        return {
            email: '',
            errorEmail: '',
            password: '',
            errorPassword: '',
            errorMsg: '',
            errors: [],
        }
    },
    methods: {
        login() {
            this.errors = [];
            if (this.email.length < 5 && this.email === '') {
                this.errorEmail = "Invalid Email";
                console.log(this.errorEmail)
                this.errors.push(this.errorEmail);
            } else {
                this.errorEmail = null;
            }
            if (this.password.length < 10 && this.password === '') {
                this.errorPassword = "Invalid Password";
                console.log(this.errorPassword)
                this.errors.push(this.errorPassword);
            } else {
                this.errorPassword = null;
            }
            if (!this.errors.length) {
                 let $this = this;

                let data = {
                    email: this.email,
                    password: this.password
                }

                $this.app.spin =true;
                post(BASE_URL+'/api/auth/login', data).then(function (response) {
                    if (response.data.id) {
                        $this.app.user = response.data;
                        Auth.set(response.data.api_token,response.data.id);
                        Flash.setSuccess('You are logged in!');
                        Event.$emit('Loggedin...');
                        $this.app.spin = false;
                        $this.app.$router.push({
                            name: "mall"
                        });
                    } else {

                        Flash.setError('Invalid Username or Password!');
                        $this.errors.push($this.errorMsg);
                        $this.app.spin = false;
                    }

                })
            }
        }
    },


};
</script>

<style scoped>



</style>
