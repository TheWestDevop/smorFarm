<template>
  <div class="main-content">
    <!-- Navbar -->
       <Navbar :nav="admin"/>

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
              <h4 class="login-staff text-center">Edit Driver </h4>
              <div class="row">
                <div class="col-md-6 mb-20">
                  <label>Staff </label>
                   <input type="text" class="form-control" v-model="staff" id="" readonly>
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
<router-link :to="{name:'admin.driver'}" class="float-left">
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
      id:'',
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
  mounted(){
      this.id = this.$route.params.id;
      this.getDriver(this.id)
  },
  methods: {
    onUpdate() {

             let $this = this;

       let form = new FormData();
       form.append('logistics_id',$this.ride)
       let data = form
        post(BASE_URL + `/api/driver/${this.id}/update`, data).then(function(response) {
          console.log(response.data);
          if (response.data) {

          $this.staff = '';
          $this.ride =  '';
            $this.$router.push({
                name: "admin.driver",
            });
            this.$toast.success('Driver Updated !!!', {
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
            Flash.setSuccess("Driver Updated !!!");
          } else{
            Flash.setError("You are Unauthorized!!!");

          }
        });

    },
     getDriver(id){
        let $this = this;
        get(BASE_URL + `/api/driver/${id}/info`).then(function(response) {
          console.log(response.data)
          if (response.data) {

          $this.staff = response.data.staff;
          $this.ride =  response.data.ride;

          }
        });
    },


  },

};
</script>

<style>
</style>
