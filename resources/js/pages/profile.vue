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
                                    <img :src="`/storage/images/users/${info.user_image}`" v-if="!img" class="img-circle" alt="Profile Pic" srcset="">
                                </div>
                                <div class="col-md-6 mb-20">

                                </div>
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Full Name</label>
                                    <input class="mb-0" type="text" v-model="info.name" v-bind:class="{'is-invalid':errorName}" placeholder="Full Name" readonly/>
                                    <div class="mt-2 p-2 font-italic text-danger">{{errorName}}</div>
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Gender</label>
                                    <select v-model="info.gender" readonly>
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    </select>

                                </div>
                                <div class="col-md-6 col-12 mb-20">
                                    <label>Phone</label>
                                    <input class="mb-0" type="text" v-model="info.phone" v-bind:class="{'is-invalid':errorPhone}" placeholder="Phone" readonly/>

                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Email</label>
                                    <input class="mb-0" type="email" v-model="info.email" v-bind:class="{'is-invalid':errorEmail}" placeholder="Email Address" readonly/>

                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Address</label>
                                    <input class="mb-0" type="text" v-model="info.address" v-bind:class="{'is-invalid':errorAddress}" placeholder=" Address" readonly/>

                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Alternate Address</label>
                                    <input class="mb-0" type="text" v-model="info.alt_address" v-bind:class="{'is-invalid':errorAlt_Address}" placeholder="Alt Address" readonly/>

                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>State</label>
                                    <input class="mb-0" type="text" v-model="info.state" v-bind:class="{'is-invalid':errorState}" placeholder="State" readonly />

                                </div>

                                <div class="col-12">
                                    <router-link :to="{name:'mall'}" class="float-left">
                                        <button class="btn btn-secondary mt-0">
                                            <i class="fa fa-arrow-left"></i> Back
                                        </button>
                                    </router-link>
                                    <button type="submit" class="btn btn-info mt-0 float-right" @click.stop="edit">
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
import {
    get
} from "../util/api";
import Flash from '../util/flash'
export default {
    name: "profile",
    props:['app'],
    data() {
        return {
            id: '',
            info: {
                name: '',
                phone: '',
                email: '',
                address: '',
                alt_address: '',
                user_image: '',
                gender: '',
                state: '',

            },
        }

    },
    created() {
        let $this = this;
        $this.id = localStorage.getItem('user_id');
        $this.getUserInfo()
    },
    methods: {
        edit() {
           let $this = this;
           $this.app.$router.push({name:'edit_profile'});
        },

        getUserInfo() {
            let $this = this;

            get(BASE_URL + `/api/user/${$this.id}/`).then(function (response) {

                if (response.data) {

                    $this.info = response.data['0'];

                }

            })

        },

    }

}
</script>

<style>

</style>
