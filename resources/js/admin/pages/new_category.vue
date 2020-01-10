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
          <form v-on:submit.prevent="onAdd">
            <div class="login-form">
              <h4 class="login-staff text-center">Add New Category </h4>
              <div class="row">
                <div class="col-md-12 mb-20">
                  <label>Title </label>
                   <input type="text" class="form-control" v-model="title" id="" >
                  <div class="mt-2 p-2 font-italic text-danger">{{errorTitle}}</div>
                </div>
                <div class="col-md-12 mb-20">
                  <label>Description</label>
                  <textarea name="description" v-model="description" class=" form-control w-100"></textarea>
                  <div class="mt-2 p-2 font-italic text-danger">{{errorDescription}}</div>
                </div>
                <div class="col-12">
<router-link :to="{name:'admin.categories'}" class="float-left">
                                            <button class="btn btn-secondary mt-0">
                                                <i class="fa fa-arrow-left"></i> Back
                                            </button>
                                        </router-link>
                  <button type="submit" class="btn btn-primary mt-0 float-right">
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
import Auth from "../util/Auth";
import { post, get } from "../util/api";
import Navbar from '../components/navbar'

export default {
  name: "New_Category",
  props: ["admin"],
   components:{
        Navbar
    },
  data() {
    return {
      id:'',
      title: "",
      description: "",
      flash:Flash.state,
      errorTitle: "",
      errorDescription: "",
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
    onAdd() {

             let $this = this;
            this.errors = [];

      if (this.title.length < 1 && this.title === "") {
        this.errorTitle = "Title is Required";
        this.errors.push(this.errorTitle);
      } else {
        this.errorTitle = null;
      }
      if (this.description === null || this.description === "" ) {
        this.errorDescription = "Description is Required";
        this.errors.push(this.errorDescription);
      } else {
        this.errorDescription = null;
      }

        if (!this.errors.length) {
       let form = new FormData();
       form.append('title',$this.title)
       form.append('description',$this.description)
       let data = form
        post(BASE_URL + `/api/add/category/`, data).then(function(response) {
          console.log(response.data);
          if (response.data) {

          $this.title = '';
          $this.description =  '';
            $this.$router.push({
                name: "admin.categories",
            });
            this.$toast.success('New Category Added !!!', {
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
            Flash.setSuccess("Category Created !!!");
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
