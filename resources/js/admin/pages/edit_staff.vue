<template>
    <div class="main-content">
        <!-- Navbar -->
        <Navbar />

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
                                <h2 class="login-name text-center ">Edit Staff Information </h2>
                                <div class="row">
                                    <div class="col-md-6 mb-20">
                                        
                    <div v-if="!img" class="mr-5">
                    <img :src="`/storage/images/staff/${this.staff_image}`"  alt="Staff image"   class="product_img" srcset />
                    </div>
                
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Staff Image</label>
                                        <input type="file" name="staff_image" accept="image/*" @change="getImage" />
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorImage}}</div>
                                        <div v-if="img" class="mr-5 mb-3">
                                            <img :src="avatar" alt="staff image" class="product_img" srcset />
                                        </div>
                                    </div>
                                    <div class="col-md-6  mb-20">
                                        <label>Staff Name</label>
                                        <input class=" form-control mb-0" type="text" v-model="name" placeholder="Full Name" />
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorName}}</div>
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Address</label>
                                        <input class=" form-control mb-0" type="text" v-model="address" placeholder="address" />
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorAddress}}</div>
                                    </div>
                                    <div class="col-md-6  mb-20">
                                        <label>Phone</label>
                                        <input class=" form-control mb-0" type="text" v-model="phone" placeholder="Phone" />
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorPhone}}</div>
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Gender</label>
                                        <select v-model="gender" class="form-control">
                                            <option value="">---Select Gender---</option>
                                            <option value="1">Male</option>
                                            <option value="0">Female</option>
                                        </select>
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorGender}}</div>
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Email</label>
                                        <input class=" form-control mb-0" type="email" v-model="email" placeholder="Email" />
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorEmail}}</div>
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Job Title</label>
                                        <input class=" form-control mb-0" type="text" v-model="job_title" placeholder="Job Title" />
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorJob_Title}}</div>
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Marriage Status</label>
                                        <select v-model="marriage_status" class=" form-control">
                                            <option value="">---Select Marriage Status---</option>
                                            <option value="married">Married</option>
                                            <option value="single">Single</option>
                                        </select>
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorMarriage_Status}}</div>
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Next Of Kin</label>

                                        <input class=" form-control mb-0" type="text" v-model="next_of_kin" placeholder="Next Of Kin" />
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorNext_Of_kin}}</div>
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Next Of Kin Address</label>

                                        <input class=" form-control mb-0" type="text" v-model="next_of_kin_address" placeholder="Next Of Kin Address" />
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorNext_Of_kin_Address}}</div>
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Next Of Kin Phone</label>

                                        <input class=" form-control mb-0" type="text" v-model="next_of_kin_phone" placeholder="Next Of Kin Phone" />
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorNext_Of_kin_Phone}}</div>
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Salary</label>

                                        <input class=" form-control mb-0" type="text" v-model="salary" placeholder="Salary" />
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorSalary}}</div>
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>State</label>
                                        <select v-model="state" class=" form-control">
                                            <option value="">---Select Your State---</option>
                                            <option value="Lagos">Lagos</option>
                                            <option value="Abuja">Abuja</option>
                                            <option value="Osun">Osun</option>
                                            <option value="Port harcourt">Port harcourt</option>
                                            <option value="Kano">Kano</option>
                                            <option value="Oyo">Oyo</option>
                                        </select>
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorState}}</div>
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Country</label>
                                        <select v-model="country" class=" form-control">
                                            <option value="" class="text-center">---Select Your Country---</option>
                                            <option value="Nigeria">Nigeria</option>
                                        </select>
                                        <div class="mt-2 p-2 font-italic text-danger">{{errorCountry}}</div>
                                    </div>
                                    <div class="col-12">
                                       <div class="col-12">
                    <router-link :to="{name:'admin.staff'}" class="float-left">
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
            flash: Flash.state,
            avatar: "",
            img: false,
            errorName: "",
            errorPhone: "",
            errorEmail: "",
            errorGender: "",
            errorSalary: "",
            errorAddress: "",
            errorImage: "",
            errorJob_Title:"",
            errorNext_Of_kin: "",
            errorNext_Of_kin_Address: "",
            errorNext_Of_kin_Phone: "",
            errorStaff_image: "",
            errorMarriage_Status: "",
            errorState: "",
            errorCountry: "",
            errors: []
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
        onUpdate() {
            this.errors = [];

            if (this.name.length < 1 && this.name === "") {
                this.errorName = "Name is Required";
                this.errors.push(this.errorName);
            } else {
                this.errorname = null;
            }
            if (this.phone.length < 2 && this.phone === null || this.phone === "") {
                this.errorPhone = "phone is Required";
                this.errors.push(this.errorPhone);
            } else {
                this.errorphone = null;
            }
            if (this.gender == null || this.gender == "") {
                this.errorGender = "Gender is Required";
                this.errors.push(this.errorGender);
            } else {
                this.errorGender = null;
            }
            if (this.salary.length < 1 && this.salary == "") {
                this.errorSalary =
                    "Salary is required ";
                this.errors.push(this.errorSalary);
            } else {
                this.errorSalary = null;
            }
            if (this.email == null || this.email == "") {
                this.errorEmail =
                    "Email is required ";
                this.errors.push(this.errorEmail);
            } else {
                this.errorEmail = null;
            }
            if (this.address == null || this.address == "") {
                this.errorAddress =
                    "Address is required ";
                this.errors.push(this.errorAddress);
            } else {
                this.errorAddress = null;
            }
            if (this.next_of_kin == null || this.next_of_kin == "") {
                this.errorNext_Of_kin =
                    "Next of Kin is required ";
                this.errors.push(this.errorNext_Of_kin);
            } else {
                this.errorNext_Of_kin = null;
            }
            if (this.next_of_kin_address == null || this.next_of_kin_address == "") {
                this.errorNext_Of_kin_Address =
                    "Next of Kin Address is required ";
                this.errors.push(this.errorNext_Of_kin_Address);
            } else {
                this.errorNext_Of_kin_Address = null;
            }
            if (this.next_of_kin_phone == null || this.next_of_kin_phone == "") {
                this.errorNext_Of_kin_Phone =
                    "Next of Kin Phone is required ";
                this.errors.push(this.errorNext_Of_kin_Phone);
            } else {
                this.errorNext_Of_kin_Phone = null;
            }
            if (this.state == null || this.state == "") {
                this.errorState =
                    "State is required ";
                this.errors.push(this.errorState);
            } else {
                this.errorState = null;
            }
            if (this.job_title == null || this.job_title == "") {
                this.errorJob_Title =
                    "Job Title is required ";
                this.errors.push(this.errorJob_Title);
            } else {
                this.errorJob_Title = null;
            }
            if (this.country == null || this.country == "") {
                this.errorCountry =
                    "Country is required ";
                this.errors.push(this.errorCountry);
            } else {
                this.errorCountry = null;
            }
            if (this.marriage_status == null || this.marriage_status == "") {
                this.errorMarriage_Status =
                    "Marriage Status is required ";
                this.errors.push(this.errorMarriage_Status);
            } else {
                this.errorMarriage_Status = null;
            }
            

            if (!this.errors.length) {

                let $this = this;

                let form = new FormData();
                form.append('name', $this.name)
                form.append('phone', $this.phone)
                form.append('email', $this.email)
                form.append('gender', $this.gender)
                form.append('salary', $this.salary)
                form.append('address', $this.address)
                 form.append('job_title', $this.job_title)
                form.append('marriage_status', $this.marriage_status)
                form.append('next_of_kin', $this.next_of_kin)
                form.append('next_of_kin_address', $this.next_of_kin_address)
                form.append('next_of_kin_phone', $this.next_of_kin_phone)
                form.append('image', $this.staff_image)
                form.append('state', $this.state)
                form.append('country', $this.country)
                let data = form
                post(BASE_URL + `/api/staff/${$this.id}/update`, data).then(function (response) {
                    console.log(response.data);
                    if (response.data.message) {
                        $this.name = "";
                        $this.phone = "",
                        $this.email = "",
                        $this.job_title="",
                        $this.gender = "";
                        $this.salary = "";
                        $this.address = '';
                        $this.next_of_kin = "";
                        $this.next_of_kin_address = "";
                        $this.next_of_kin_phone = "";
                        $this.staff_image = "";
                        $this.marriage_status = "";
                        $this.state = "";
                        $this.country = '';
                        $this.img = false;
                        $this.$router.push({
                            name: "admin.staff",
                        });
                        Flash.setSuccess("You Have Successfull Updated Staff Information");

                    } else {
                        Flash.setError("You are Unauthorized!!!");

                    }
                });
            }
        },

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
        getImage(e) {
            let image = e.target.files[0];
            this.staff_image = e.target.files[0];
            this.read(image);
        },
        read(image) {
            let reader = new FileReader();
            reader.readAsDataURL(image);
            this.img = true;
            reader.onload = e => {
                this.avatar = e.target.result;
            };
        },

    },

};
</script>

<style>
</style>
