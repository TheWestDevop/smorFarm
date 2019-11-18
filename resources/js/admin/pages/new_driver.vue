<template>
  <div class="main-content">
    <!-- Navbar -->
       <Navbar/>

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
          <form v-on:submit.prevent="onCreate">
            <div class="login-form">
              <h4 class="login-staff text-center">Adding New Driver </h4>
              <div class="row">
                <div class="col-md-6 mb-20">
                  <label>Staff </label>
                  <select
                    v-model="staff"
                    class="form-control"
                  >
                  <option value="" > Select Staff Name Here </option>
                    <option v-for="staff in admin.staff.data"
                    :key="staff.id"   >{{staff.name}}</option>
                  </select>
                  <div class="mt-2 p-2 font-italic text-danger">{{errorStaff}}</div>
                </div>
                <div class="col-md-6 mb-20">
                  <label>Logistics</label>
                  <select
                    v-model="ride"
                    class="form-control"
                  >
                  <option value="" > Select Logistics Method Here </option>
                    <option v-for="ride in admin.logistics.data"
                    :key="ride.id" >{{ride.title}}</option>
                  </select>
                  <div class="mt-2 p-2 font-italic text-danger">{{errorRide}}</div>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block mt-0">
                    <i class="fa fa-plus"></i> Add
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
import Auth from "../util/adminAuth";
import { post, get } from "../util/api";
import Navbar from '../components/navbar'

export default {
  name: "New_Driver",
  props: ["admin"],
   components:{
        Navbar
    },
  data() {
    return {
      staff: "",
      ride: "",
      flash:Flash.state,
      errorStaff: "",
      errorRide: "",
      errors: []
    };
  },
  created(){
     /* let $this = this;
      if(Auth.state.api_token === ''|| Auth.state.api_token === null
       && Auth.state.admin_id === '' || Auth.state.admin_id === null) {

       }*/
  },
  methods: {
    onCreate() {
      this.errors = [];

      if (this.staff.length < 0 && this.staff === 0 || this.staff === "" ) {
        this.errorStaff = "Staff is Required";
        this.errors.push(this.errorStaff);
      } else {
        this.errorStaff = null;
      }
      if (this.ride.length < 0 && this.ride === 0 || this.ride === "" ) {
        this.errorRide = "Logistics is Required";
        this.errors.push(this.errorRide);
      } else {
        this.errorRide = null;
      }


      if (!this.errors.length) {

             let $this = this;

       let form = new FormData();
       form.append('staff_id',$this.staff)
       form.append('logistics_id',$this.ride)
       let data = form
        post(BASE_URL + "/api/driver/new", data).then(function(response) {
          console.log(response.data);
          if (response.data) {
          Flash.setSuccess("Driver Added !!!");
          $this.staff = '';
          $this.ride =  '';
          } else{
            Flash.setError("You are Unauthorized!!!");

          }
        });
      }
    },



  },

};
</script>

<style>
</style>
