<template>
<!-- Begin Register Content Area -->
<div class="page-section mb-60">
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
               <form v-on:submit.prevent="onSubmit">
                <div class="login-form">
                    <h4 class="login-title">Register</h4>
                    <div class="mt-2 p-2 font-italic text-danger text-center">{{errorMsg}}</div>
                    <div class="row">
                        <div class="col-md-6 col-12 mb-20">
                            <label>First Name</label>
                            <input class="mb-0" type="text" v-model="fname" v-bind:class="{'is-invalid':errorFname}" placeholder="First Name" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorFname}}</div>
                        </div>
                        <div class="col-md-6 col-12 mb-20">
                            <label>Last Name</label>
                            <input class="mb-0" type="text" v-model="lname" v-bind:class="{'is-invalid':errorLname}" placeholder="Last Name" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorLname}}</div>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label>Email Address</label>
                            <input class="mb-0" type="email" v-model="email" v-bind:class="{'is-invalid':errorEmail}" placeholder="Email Address" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorEmail}}</div>
                        </div>
                          <div class="col-md-6 mb-20">
                  <label>Gender</label>
                  <select
                    v-model="gender"
                  >
                  <option value="">-----------------------------</option>
                    <option value="1">Male</option>
                    <option value="0">Female</option>
                  </select>
                  <div class="mt-2 p-2 font-italic text-danger">{{errorGender}}</div>
                </div>
                        <div class="col-md-6 mb-20">
                            <label>Password</label>
                            <input class="mb-0" type="password" v-model="password" v-bind:class="{'is-invalid':errorPassword}" placeholder="Password" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorPassword}}</div>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label>Confirm Password</label>
                            <input class="mb-0" type="password" v-model="passwordConf" v-bind:class="{'is-invalid':errorPasswordConf}" placeholder="Confirm Password" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorPasswordConf}}</div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="register-button mt-0">Register</button>
                        </div>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Login Register Area End Here -->
</template>

<script>

import { post } from "../../util/api";


export default {
    name: "Register",
    props: ['app'],
    data() {
       return{

        fname: '',
        errorFname: '',
        lname: '',
        errorLname: '',
        fullname: '',
        email: '',
        errorEmail: '',
        gender: '',
        errorGender: '',
        password: '',
        errorPassword: '',
        passwordConf: '',
        errorPasswordConf: '',
        errorMsg: '',
        errors: [],
        }

    },
    methods: {
        onSubmit() {

            this.errors = [];
            let $this = this;
            if (this.fname.length < 3 || this.fname === '') {
                this.errorFname = "First Name is Required";
                this.errors.push(this.errorFname);
            } else {
                this.errorFname = null;
            }
            if (this.lname.length < 3 || this.lname === '') {
                this.errorLname = "Last Name is Required";
                this.errors.push(this.errorLname);
            } else {
                this.errorLname = null;
            }

            if (this.email == '') {
                this.errorEmail = "Email is Required";
                this.errors.push(this.errorEmail);
            } else {
                this.errorEmail = null;
            }
           if (this.gender === '' || this.gender === null ) {
                this.errorGender = "Gender is Required";
                this.errors.push(this.errorGender);
            } else {
                this.errorGender = null;
            }

            if (this.email.length < 10) {
                this.errorEmail = "Email has to be atleast 10 character long";
                this.errors.push(this.errorEmail);
            } else {
                this.errorEmail = null;
            }
            if (this.password == '' && this.passwordConf == '') {
                this.errorPassword = "Password is Required";
                this.errorPasswordConf = "Password is Required";
                this.errors.push(this.errorPassword);
            } else {
                this.errorPassword = null;
            }
            if (this.password.length < 7 && this.passwordConf.length < 7) {
                this.errorPassword = "Password can't be less then 7";
                this.errors.push(this.errorPassword);
            } else {
                this.errorPassword = null;
            }
            if (this.passwordConf !== this.password) {
                this.errorPasswordConf = "Password doesn't Matched";
                this.errors.push(this.errorPasswordConf);
            } else {
                this.errorPasswordConf = null;
            }

            $this.fullname = this.fname + ' ' + this.lname;
            $this.$store
          .dispatch("spinner", true)
            if (!this.errors.length) {

                let data = {
                    name: $this.fullname,
                    email: $this.email,
                    gender:$this.gender,
                    password: this.password,
                    password: this.passwordConf
                }
                 
                post(BASE_URL+'/api/auth/register', data).then(function (response) {


                    if (response.data.user) {
                        
                        this.$store.dispatch('register',response.data);
                        $this.$store.dispatch("get_available_kitchen");
                        $this.$store.dispatch("get_unavailable_kitchen");
                        Flash.setSuccess('You have successfully create an account!');
                        
                        $this.$store
          .dispatch("spinner", false)
                        $this.$router.push({
                            name: "mall"
                        });
                        $this.$toast.success('You have successfully create an account!',{
                                position:'bottom-center',
                                timeout:10000,
                                closeOnClick:true,
                                pauseOnFocusLoss:true,
                                pauseOnHover:false,
                                draggable:true,
                                draggablePercent:0.6,
                                hideCloseButton:false,
                                hideProgressBar:true,
                                icon:true,})


                    }else{
                        $this.$store
          .dispatch("spinner", false)
                        $this.$router.push({
                            name: "auth.login"
                        });
                        Flash.setError(response.data.error);
                        $this.errorMsg = response.data.error;
                        $this.$toast.error(response.data.error,{
                                position:'bottom-center',
                                timeout:10000,
                                closeOnClick:true,
                                pauseOnFocusLoss:true,
                                pauseOnHover:false,
                                draggable:true,
                                draggablePercent:0.6,
                                hideCloseButton:false,
                                hideProgressBar:true,
                                icon:true,})

                    }



                })

            }

        }
    },


};
</script>

<style>
</style>
