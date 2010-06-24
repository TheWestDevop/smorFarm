<template>
<div class="page-section mb-60">
<div class="container ">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
               <form v-on:submit.prevent="update">
                <div class="login-form">
                    <h4 class="login-title">Profile</h4>
                    <div class="mt-2 p-2 font-italic text-danger text-center">{{errorMsg}}</div>
                    <div class="row">
                      <div class="col-md-6 col-12 mb-20">
                           <img :src="`/storage/images/users/${info.user_image}`" v-if="!img" class="img-circle" alt="Profile Pic" srcset="">
                           </div>
                        <div class="col-md-6 mb-20">
                  <label>Product Image</label>
                  <input
                    type="file"
                    name="image"
                    accept="image/*"

                    @change="getImage"
                  />
                  <div class="mt-2 p-2 font-italic text-danger">{{errorImage}}</div>
                  <div v-if="img" class="mr-5">
                    <img :src="avatar" alt="Profile Pic" height="200" width="200"   class="product_img" style="" srcset />
                  </div>
                </div>
                        <div class="col-md-12 col-12 mb-20">
                            <label>Full Name</label>
                            <input class="mb-0" type="text" v-model="info.name" v-bind:class="{'is-invalid':errorName}" placeholder="Full Name"   />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorName}}</div>
                        </div>
                        <div class="col-md-6 mb-20">
                  <label>Gender</label>
                  <select
                    v-model="info.gender"
                  >
                    <option value="1">Male</option>
                    <option value="0">Female</option>
                  </select>
                  <div class="mt-2 p-2 font-italic text-danger">{{errorGender}}</div>
                </div>
                        <div class="col-md-6 col-12 mb-20">
                            <label>Phone</label>
                            <input class="mb-0" type="text" v-model="info.phone" v-bind:class="{'is-invalid':errorPhone}" placeholder="Phone" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorPhone}}</div>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label>Email</label>
                            <input class="mb-0" type="email" v-model="info.email" v-bind:class="{'is-invalid':errorEmail}" placeholder="Email Address" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorEmail}}</div>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label>Address</label>
                            <input class="mb-0" type="text" v-model="info.address" v-bind:class="{'is-invalid':errorAddress}" placeholder="Address" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorAddress}}</div>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label>Alternate Address</label>
                            <input class="mb-0" type="text" v-model="info.alt_address" v-bind:class="{'is-invalid':errorAlt_Address}" placeholder="Alt Address" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorAlt_Address}}</div>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label>State</label>
                            <input class="mb-0" type="text" v-model="info.state" v-bind:class="{'is-invalid':errorState}" placeholder="State" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorState}}</div>
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
                            <router-link :to="{name:'mall'}" class="float-left">
                                            <button class="btn btn-secondary mt-0">
                                                <i class="fa fa-arrow-left"></i> Back
                                            </button>
                                        </router-link>
                  <button type="submit" class="btn btn-info mt-0 float-right">
                    <i class="fa fa-upload"></i> Update
                  </button>
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
import { post,get } from "../util/api";
import Flash  from  '../util/flash'
export default {
    name:"profile",
    props:['app'],
    data() {
       return{
        id:'',
        info:{
            name:'',
            phone:'',
            email:'',
            address:'',
            alt_address:'',
            user_image:'',
            gender:'',
            state:'',

        },
        errorAddress:'',
        errorAlt_Address:'',
        errorGender:'',
        errorPhone:"",
        errorName: '',
        errorEmail: '',
        password:'',
        errorPassword: '',
        passwordConf: '',
        errorPasswordConf: '',
        errors: [],
        img:false,
        avatar:'',
        checkreadonly:'readonly'
        }

    },
    created(){
    let $this = this;
    $this.id  =  localStorage.getItem('user_id');
    $this.getUserInfo()
    },
    methods:{
        edit(){

        },
        update(){
           this.errors = [];
            let $this = this;
            if (this.info.name.length < 3 || this.info.name === '') {
                this.errorName = "Full Name is Required";
                this.errors.push(this.errorName);
            } else {
                this.errorName = null;
            }
            if (this.info.phone == null || this.info.phone === '') {
                this.errorPhone = "Phone is Required";
                this.errors.push(this.errorPhone);
            } else {
                this.errorPhone = null;
            }
            if (this.info.address == null || this.info.address === '') {
                this.errorAddress = "Address is Required";
                this.errors.push(this.errorAddress);
            } else {
                this.errorAddress = null;
            }
            if (this.info.gender == null || this.info.gender === '') {
                this.errorGender = "Gender is Required";
                this.errors.push(this.errorGender);
            } else {
                this.errorGender = null;
            }
            if (this.info.alt_address == null || this.info.alt_address === '') {
                this.errorAlt_Address = "Alt_Address is Required";
                this.errors.push(this.errorAlt_Address);
            } else {
                this.errorAlt_Address = null;
            }
            if (this.info.email == '') {
                this.errorEmail = "Email is Required";
                this.errors.push(this.errorEmail);
            } else {
                this.errorEmail = null;
            }

            if (this.info.email.length < 10) {
                this.errorEmail = "Email has to be atleast 10 character long";
                this.errors.push(this.errorEmail);
            } else {
                this.errorEmail = null;
            }


            if (this.passwordConf !== this.password) {
                this.errorPasswordConf = "Password doesn't Matched";
                this.errors.push(this.errorPasswordConf);
            } else {
                this.errorPasswordConf = null;
            }


            if (!this.errors.length) {

                let data = {
                    name: $this.info.name,
                    email: $this.info.email,
                    address: $this.info.address,
                    alt_address: $this.info.alt_address,
                    phone: $this.info.phone,
                    gender: $this.info.gender,
                    image:$this.info.image,
                    state:$this.info.state,
                    password: this.password,
                    password: this.passwordConf
                }

                post(BASE_URL+`/api/user/update/${this.id}`, data).then(function (response) {
                    if (response.data) {
                        Flash.setSuccess('Profile update was Successfully!');

                        $this.app.$router.push({
                            name: "mall"
                        });
                    } else if (response.message) {
                        Flash.setError(`Profile update wasn't Successfully!`);

                    }

                })

            }

        },
        getUserInfo(){
           let $this = this;

          get(BASE_URL+`/api/user/${$this.id}/`).then(function (response) {


                    if (response.data) {

                        $this.info = response.data['0'];


                    }

                })

        },
        getImage(e) {
             let img = e.target.files[0];
             this.info.user_image = e.target.files[0];
            this.read(img);
        },
        read(image) {
            let reader = new FileReader();
             reader.readAsDataURL(image);
            this.img = true;
            reader.onload = e => {
             this.avatar = e.target.result;
                };
    },
    }

}
</script>

<style>

</style>
