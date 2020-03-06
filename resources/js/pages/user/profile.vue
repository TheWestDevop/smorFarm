<template>
    <div class="page-section mb-60">
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                    <form>
                        <div class="login-form">
                            <h2 class="login-title">Profile</h2>

                            <div class="row">
                                <div class="col-md-6 col-12 mb-20">
                                    <img :src="`/storage/images/users/${profile.profile.user_image}`" v-if="!img" class="img-circle" alt="Profile.profile Pic" srcset="">
                                </div>
                                <div class="col-md-6 mb-20">

                                </div>
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Full Name</label>
                                    
                                     <p class="mb-0 h5">{{profile.profile.name}}</p>
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Gender</label>
                                    <select v-model="profile.profile.gender" disabled style="border:none!important;">
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    </select>
                                        
                                </div>
                                <div class="col-md-6 col-12 mb-20">
                                    <label>Phone</label>
                                    <p class="mb-0 h5">{{profile.profile.phone}}</p>
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Email</label>
                                      <p class="mb-0 h5">{{profile.profile.email}}</p>
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Address</label>
                                    <p class="mb-0 h5">{{profile.profile.address}}</p>

                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Alternate Address</label>
                
                                        <p class="mb-0 h5">{{profile.profile.alt_address}}</p>
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>State</label>
                                    <p class="mb-0 h5">{{profile.profile.state}}</p>
                                </div>

                                <div class="col-12">
                                    <router-link :to="{name:'mall'}" class="float-left">
                                        <button class="btn btn-secondary mt-0">
                                            <i class="fa fa-arrow-left"></i> Back
                                        </button>
                                    </router-link>
                                    <button type="submit" class="btn btn-profile.profile mt-0 float-right" @click.stop="edit">
                                        <i class="fa fa-pencil"></i> Edit
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
import { mapGetters } from "vuex";
export default {
    name: "profile",
    computed: mapGetters({ profile : "USER" }),
    methods: {
        edit() {
           let $this = this;
           $this.$router.push({name:'edit_profile'});
        },

        

    }

}
</script>

<style>

</style>
