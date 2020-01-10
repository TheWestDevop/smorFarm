<template>
    <div class="main-content">
        <!-- Navbar -->
        <Navbar :nav="admin" />

        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
            <div class="alert alert-success text-center w-50 mx-auto" v-if="flash.success">
                {{flash.success}}
            </div>
            <div class="alert alert-danger text-center  w-50 mx-auto" v-if="flash.error">
                {{flash.error}}
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                        <form v-on:submit.prevent="onUpdate">
                            <div class="login-form">
                                <h4 class="login-staff text-center">Edit Logistics </h4>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 mb-20">

                                        <input class="form-control mb-0" type="text" v-model="title" placeholder="Logistics Title">
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorTitle}}</div>
                                    </div>
                                    <div class="col-md-6 mb-20">

                                        <input type="text" v-model="plate" placeholder="Plate Number" class="form-control mb-0" id="">
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorPlateNumber}}</div>
                                    </div>
                                    <div class="col-md-12 mb-20">
                                        <label>Staff</label>
                                        <select v-model="staff" class="form-control mb-0">
                                            <option value="" class="text-center">---Select Driver Here---</option>
                                            <option v-for="staff in admin.staff.data" :key="staff.id">{{staff.name}}</option>
                                        </select>
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorStaff}}</div>
                                    </div>

                                    <div class="col-12">
                                        <router-link :to="{name:'admin.logistics'}" class="float-left">
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
    </div>
</template>

<script>
import Flash from "../../util/flash";
import Auth from "../util/Auth";
import {
    post,
    get
} from "../util/api";
import Navbar from '../components/navbar'

export default {
    name: "edit_Logistics",
    props: ["admin"],
    components: {
        Navbar
    },
    data() {
        return {
            title:"",
            plate:"",
            staff:"",
            flash: Flash.state,
            errorTitle:"",
            errorStaff:"",
            errorPlateNumber:"",
            errors: []
        };
    },
    created() {
        /* let $this = this;
         if(Auth.state.api_token == ''|| Auth.state.api_token == null
          && Auth.state.admin_id == '' || Auth.state.admin_id == null) {

          }*/
          this.id = this.$route.params.id;
      this.getLogistics(this.id)
    },

    methods: {
        onUpdate() {
            this.errors = [];

            if (this.title.length < 1 && this.title == null || this.title === "") {
                this.errorTitle = "Title is Required";
                this.errors.push(this.errorTitle);
            } else {
                this.errorTitle = null;
            }
            if (this.staff.length < 1 && this.staff == null || this.staff === "") {
                this.errorStaff = "Staff is Required";
                this.errors.push(this.errorStaff);
            } else {
                this.errorStaff = null;
            }
            if (this.plate.length < 1 && this.plate == null || this.plate === "") {
                this.errorPlateNumber = "Plate Number is Required";
                this.errors.push(this.errorPlateNumber);
            } else {
                this.errorPlateNumber = null;
            }

            if (!this.errors.length) {
                let $this = this;

                let form = new FormData();
                form.append('title', $this.title)
                form.append('plate_number', $this.plate)
                form.append('staff', $this.staff)
                let data = form
                post(BASE_URL + `/api/logistics/${this.id}/update`, data).then(function (response) {

                    if (response.data) {

                        $this.staff = '';
                        $this.title = '';
                        $this.plate_number = '';
                        $this.$router.push({
                            name: "admin.logistics",
                        });
                        this.$toast.success('Logistics Updated !!!', {
                                position: 'top-center',
                                timeout: 1000,
                                closeOnClick: true,
                                pauseOnFocusLoss: true,
                                pauseOnHover: false,
                                draggable: true,
                                draggablePercent: 0.6,
                                hideCloseButton: false,
                                hideProgressBar: true,
                                icon: true,
                                })
                        Flash.setSuccess("Logistics Updated !!!");
                    } else {
                        Flash.setError("You are Unauthorized!!!");

                    }
                });
            }

        }
        ,

        getLogistics(id){
           let $this = this;
        get(BASE_URL + `/api/logistics/${id}/info`).then(function(response) {
          if (response.data) {
              console.log(response.data)
          $this.title = response.data.title;
          $this.plate =  response.data.plate_number;
          $this.staff = response.data.driver_name;
          }
        });
        }

    },

};
</script>

<style>
</style>
