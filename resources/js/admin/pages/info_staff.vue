<template>
    <div class="main-content">
        <!-- Navbar -->
        <Navbar />

        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
           
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                        <form >
                            <div class="login-form">
                                <h2 class="login-name text-center "> Staff Information </h2>
                                <div class="row">
                                    <div class="col-md-6 mb-20">
                                        
                    <div  class="mr-5">
                    <img :src="`/storage/images/staff/${this.staff_image}`"  alt="Staff image"   class="product_img" srcset />
                    </div>
                
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        
                                    </div>
                                    <div class="col-md-6  mb-20">
                                        <label>Staff Name</label>
                                        <input class=" form-control mb-0" type="text" v-model="name" placeholder="Full Name" readonly />
                                       
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Address</label>
                                        <input class=" form-control mb-0" type="text" v-model="address" placeholder="address" readonly/>
            
                                    </div>
                                    <div class="col-md-6  mb-20">
                                        <label>Phone</label>
                                        <input class=" form-control mb-0" type="text" v-model="phone" placeholder="Phone" readonly/>
                                        
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Gender</label>
                                        <select v-model="gender" class="form-control" disabled>
                                        
                                            <option value="1">Male</option>
                                            <option value="0">Female</option>
                                        </select>
                                       
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Email</label>
                                        <input class=" form-control mb-0" type="email" v-model="email" placeholder="Email" readonly/>
                                        
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Job Title</label>
                                        <input class=" form-control mb-0" type="text" v-model="job_title" placeholder="Job Title" readonly/>
                                      
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Marriage Status</label>
                                        <select v-model="marriage_status" class=" form-control" disabled>
                                            
                                            <option value="married">Married</option>
                                            <option value="single">Single</option>
                                        </select>
                                        
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Next Of Kin</label>

                                        <input class=" form-control mb-0" type="text" v-model="next_of_kin" placeholder="Next Of Kin" readonly/>
                                      
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Next Of Kin Address</label>

                                        <input class=" form-control mb-0" type="text" v-model="next_of_kin_address" placeholder="Next Of Kin Address" readonly/>
                                        
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Next Of Kin Phone</label>

                                        <input class=" form-control mb-0" type="text" v-model="next_of_kin_phone" placeholder="Next Of Kin Phone" readonly/>
                                        
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Salary</label>

                                        <input class=" form-control mb-0" type="text" v-model="salary" placeholder="Salary" readonly/>
                    
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>State</label>
                                        <select v-model="state" class=" form-control" disabled>
                                            
                                            <option value="Lagos">Lagos</option>
                                            <option value="Abuja">Abuja</option>
                                            <option value="Osun">Osun</option>
                                            <option value="Port harcourt">Port harcourt</option>
                                            <option value="Kano">Kano</option>
                                            <option value="Oyo">Oyo</option>
                                        </select>
                                        
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Country</label>
                                        <select v-model="country" class=" form-control" disabled>
                                           
                                            <option value="Nigeria">Nigeria</option>
                                        </select>
                                        
                                    </div>
                                    <div class="col-12">
                                       
                    <router-link :to="{name:'admin.staff'}">
                                            <button class="btn btn-secondary btn-block mt-5">
                                                <i class="fa fa-arrow-left"></i> Back
                                            </button>
                                        </router-link>
          
                
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

import Auth from "../util/Auth";
import {
    post,
    get
} from "../util/api";
import Navbar from '../components/navbar'

export default {
    name: "New_State",
    props: ["admin"],
    components: {
        Navbar
    },
    data() {
        return {
            id:"",
            name: "",
            phone: "",
            email: "",
            gender: "",
            salary: "",
            address: '',
            next_of_kin: "",
            next_of_kin_address: "",
            next_of_kin_phone: "",
            staff_image: "",
            job_title:'',
            marriage_status: "",
            state: "",
            country: '',
            
        };
    },
    created() {
        /* let $this = this;
         if(Auth.state.api_token === ''|| Auth.state.api_token === null
          && Auth.state.admin_id === '' || Auth.state.admin_id === null) {

          }*/
          this.id = this.$route.params.id;
          this.getStaff(this.id);
    },
    methods: {
       

        getStaff(id){
            let $this = this;
        get(BASE_URL + `/api/staff/${id}`).then(function(response) {

          if (response.data) {
                        $this.name = response.data.name;
                        $this.phone = response.data.phone,
                        $this.email = response.data.email,
                        $this.gender = response.data.gender;
                        $this.salary = response.data.salary;
                        $this.address = response.data.address;
                        $this.next_of_kin = response.data.next_of_kin;
                        $this.next_of_kin_address = response.data.next_of_kin_address;
                        $this.next_of_kin_phone = response.data.next_of_kin_phone;
                        $this.job_title=response.data.job_title;
                        $this.staff_image = response.data.img;
                        $this.marriage_status = response.data.married_status;
                        $this.state = response.data.state;
                        $this.country = response.data.country;
          }
        })
        },
      

    },

};
</script>

<style>
</style>
