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
                           <img :src="`/storage/images/users/${profile.profile.user_image}`" v-if="!img" class="img-circle" alt="Profile Pic" srcset="">
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
                            <input class="mb-0" type="text" v-model="profile.profile.name" v-bind:class="{'is-invalid':errorName}" placeholder="Full Name"   />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorName}}</div>
                        </div>
                        <div class="col-md-6 mb-20">
                  <label>Gender</label>
                  <select
                    v-model="profile.profile.gender"
                  >
                    <option value="1">Male</option>
                    <option value="0">Female</option>
                  </select>
                  <div class="mt-2 p-2 font-italic text-danger">{{errorGender}}</div>
                </div>
                        <div class="col-md-6 col-12 mb-20">
                            <label>Phone</label>
                            <input class="mb-0" type="text" v-model="profile.profile.phone" v-bind:class="{'is-invalid':errorPhone}" placeholder="Phone" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorPhone}}</div>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label>Email</label>
                            <input class="mb-0" type="email" v-model="profile.profile.email" v-bind:class="{'is-invalid':errorEmail}" placeholder="Email Address" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorEmail}}</div>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label>Address</label>
                            <input class="mb-0" type="text" v-model="profile.profile.address" v-bind:class="{'is-invalid':errorAddress}" placeholder="Address" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorAddress}}</div>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label>Alternate Address</label>
                            <input class="mb-0" type="text" v-model="profile.profile.alt_address" v-bind:class="{'is-invalid':errorAlt_Address}" placeholder="Alt Address" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorAlt_Address}}</div>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label>State</label>
                            <input class="mb-0" type="text" v-model="profile.profile.state" v-bind:class="{'is-invalid':errorState}" placeholder="State" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorState}}</div>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label>New Password</label>
                            <input class="mb-0" type="password" v-model="password" v-bind:class="{'is-invalid':errorPassword}" placeholder="Password" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorPassword}}</div>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label>Confirm New Password</label>
                            <input class="mb-0" type="password" v-model="passwordConf" v-bind:class="{'is-invalid':errorPasswordConf}" placeholder="Confirm Password" />
                            <div class="mt-2 p-2 font-italic text-danger">{{errorPasswordConf}}</div>
                        </div>
                        <div class="col-12">
                            <router-link :to="{name:'mall'}" class="float-left">
                                            <button class="btn btn-secondary mt-0">
                                                <i class="fa fa-arrow-left"></i> Back
                                            </button>
                                        </router-link>
                  <button type="submit" class="btn btn-profile.profile mt-0 float-right">
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
import { post,get } from "../../util/api";
import Flash  from  '../../util/flash'
import { mapGetters } from "vuex";
export default {
    name:"edit_profile",
    data() {
       return{
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
    computed: mapGetters({ profile : "USER" }),
    methods:{
        update(){
           this.errors = [];
            let $this = this;
            if (this.profile.profile.name.length < 3 || this.profile.profile.name === '') {
                this.errorName = "Full Name is Required";
                this.errors.push(this.errorName);
            } else {
                this.errorName = null;
            }
            if (this.profile.profile.phone == null || this.profile.profile.phone === '') {
                this.errorPhone = "Phone is Required";
                this.errors.push(this.errorPhone);
            } else {
                this.errorPhone = null;
            }
            if (this.profile.profile.address == null || this.profile.profile.address === '') {
                this.errorAddress = "Address is Required";
                this.errors.push(this.errorAddress);
            } else {
                this.errorAddress = null;
            }
            if (this.profile.profile.gender == null || this.profile.profile.gender === '') {
                this.errorGender = "Gender is Required";
                this.errors.push(this.errorGender);
            } else {
                this.errorGender = null;
            }
            if (this.profile.profile.alt_address == null || this.profile.profile.alt_address === '') {
                this.errorAlt_Address = "Alt_Address is Required";
                this.errors.push(this.errorAlt_Address);
            } else {
                this.errorAlt_Address = null;
            }
            if (this.profile.profile.email == '') {
                this.errorEmail = "Email is Required";
                this.errors.push(this.errorEmail);
            } else {
                this.errorEmail = null;
            }

            if (this.profile.profile.email.length < 10) {
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
                    name: $this.profile.profile.name,
                    email: $this.profile.profile.email,
                    address: $this.profile.profile.address,
                    alt_address: $this.profile.profile.alt_address,
                    phone: $this.profile.profile.phone,
                    gender: $this.profile.profile.gender,
                    image:$this.profile.profile.image,
                    state:$this.profile.profile.state,
                    password: this.password,
                    password: this.passwordConf
                }
                $this.$store.dispatch('spinner',true);
                $this.$store.dispatch('update_user',data)
                $this.$store.dispatch('auth');
                Flash.setSuccess('Profile update was successfully!');
                $this.$toast.success('Profile update was successfully!!',{
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
                $this.$store.dispatch('spinner',false);
                 $this.$router.push({
                            name: "profile"
                        });
                        
                

            }

        },
        getImage(e) {
             let img = e.target.files[0];
             this.profile.profile.user_image = e.target.files[0];
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
