<template>
    <div class="main-content">
        <!-- Navbar -->
        <Navbar :nav="admin"/>

        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                        <form>
                            <div class="login-form">
                                <h4 class="login-title text-center">Update Order Delivery Man</h4>
                                <div class="row">

                                    <br>
                                    <div class="col-md-12 col-12 mb-20 p-2">
                                        <label><b>Driver Name :</b></label>
                                        <select
                    v-model="driver"
                    class="form-control"
                  >
                  <option value="" > Select Driver Name Here </option>
                    <option v-for="driver in drivers_avaliable"
                    :key="driver.id"   >{{driver.staff_name}}</option>
                  </select>

                                    </div>


                                    <div class="col-12">
                                        <router-link :to="{name:'admin.pre_order'}" class="float-left">
                                            <button class="btn btn-secondary mt-0">
                                                <i class="fa fa-arrow-left"></i> Back
                                            </button>
                                        </router-link>
                                        <button class="btn btn-info mt-0 float-right" @click="update">
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
import Auth from "../util/Auth";
import {
    post,get
} from "../util/api";
import Navbar from '../components/navbar'

export default {
    name: "pre_order_driver",
    props: ["admin"],
    components: {
        Navbar
    },
    created() {
        let $this = this;
        this.id = this.$route.params.id;
        $this.getAvaliable_Drivers()
    },
    data() {
        return {
            id: '',
            driver:'',
            errorDriver:'',
            errors:[],
            drivers_avaliable:''
        }
    },
    methods: {
        update(id) {
            let $this = this;


             if (this.driver.length < 0 || this.driver === null || this.driver === "" ) {
                    this.errorDriver = "Delivery Man is Required";
                     $this.$toast.error('Delivery Man is Required', {
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
                    this.errors.push(this.errorDriver);
                        } else {
                    this.errorDriver = null;
                }
             if (!this.errors.length) {
                    let form = new FormData();
                    form.append('driver',$this.driver)

                    post(BASE_URL + `/api/pre/order/${this.id}/driver`, form).then(function (response) {
                        if (response.data) {
                               $this.$toast.success('Delivery Man Updated', {
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
                             $this.$router.push({
                             name: "admin.pre_order",

                               });
                        }
                    });
             }
        },
        getAvaliable_Drivers() {
            let $this = this
            get(BASE_URL + `/api/driver/avaliable`).then((response) => {
                $this.drivers_avaliable = response.data;


            });
        }

    },

};
</script>

<style>
</style>
