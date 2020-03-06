<template>

    <div class="main-content">
        <Navbar :nav="admin" />
        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
            <div class="alert alert-success text-center w-50 mx-auto" v-if="flash.success">
                {{flash.success}}
            </div>
            <div class="alert alert-danger text-center  w-50 mx-auto" v-if="flash.error">
                {{flash.error}}
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card bg-gradient-default shadow">
                            <div class="card-header bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                        <h2 class="text-white mb-0">Delivery Man Movement</h2>
                                    </div>
                                    <div class="col">
                                        <ul class="nav nav-pills justify-content-end">
                                            <li class="nav-item  mr-2 mr-md-0 active">
                                                <a href="#fasttrack" data-target="#fasttrack" class="nav-link py-2 px-3 active" data-toggle="tab">
                                                    <span class="d-none d-md-block">Track Driver</span>
                                                    <span class="d-md-none">TD</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#rcustomer" class="nav-link py-2 px-3" data-toggle="tab">
                                                    <span class="d-none d-md-block">Avaliable Driver</span>
                                                    <span class="d-md-none">AD</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content container card-body">
                                <div class="tab-pane active" id="fasttrack">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 ">

                                                <gmap-map
                                                    :center="center"
                                                    :zoom="12"
                                                    style="width:100%;height:400px;">

                                                  <gmap-info-window 
                                                  :options="infoOptions"
                                                  :option="infoWindowPos"
                                                  :opened="infoWinOpen"
                                                  @closeclick="infowinOpen=false"
                                                  >
                                                        {{infoContent}}
                                                  </gmap-info-window>



                                                    <gmap-marker
                                                        :key="index"
                                                        v-for="(m,index) in markers"
                                                        :position="m.position"
                                                        :clickable="true"
                                                        @click="toggleInfoWindow(m,index)"
                                                        
                                                    >

                                                    </gmap-marker>
                                                </gmap-map>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="rcustomer">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12 ">
                                            <div class="card shadow">
                                                <div class="card-header bdriver-0">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                                                                <div class="form-group mb-0">
                                                                    <div class="input-group input-group-alternative">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fas fa-search text-black-50"></i></span>
                                                                        </div>
                                                                        <input class="products form-control" v-model="name" placeholder="Search Driver Name" type="text">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <div class="col m-2 text-right">
                                                            <h2 class="mb-0">Delivery Men <i class="fa fa-users"></i></h2>
                                                        </div>
                                                        <div class="col">

                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <!-- Projects table -->
                                                    <table class="table align-items-center table-flush">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th scope="col">Driver Name </th>
                                                                <th scope="col">Status</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tr v-for="driver in filterDrivers" :key="driver.id">
                                                                <th scope="row">
                                                                    {{driver.staff_name}}
                                                                </th>

                                                                <td>
                                                                    <span v-if="status_0(driver.avaliability_status)" class="btn btn-light"><i class="fa fa-truck-pickup"></i> Booked</span>
                                                                    <span v-if="status_1(driver.avaliability_status)" class="btn btn-success"><i class="fa fa-arrow-down"></i> Avaliable</span>
                                                                    <span v-if="status_2(driver.avaliability_status)" class="btn btn-primary"><i class="fa fa-arrow-up"></i> Offine</span>
                                                                    <span v-if="status_3(driver.avaliability_status)" class="btn btn-warning"><i class="fa fa-trash"></i> Removed</span>
                                                                </td>

                                                            </tr>

                                                        </tbody>
                                                    </table>

                                                </div>
                                                <div class="row justify-content-center">
                                                    <div class="col-md-12">
                                                        <br>
                                                        <Pagination :paginations="admin.customer.pagination" @paginate="getUser()" :offset="5" />
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import Navbar from '../components/navbar'
import Flash from "../../util/flash"
import Pagination from "../components/pagination";
import {
    post,
    get
} from '../util/api'
export default {
    name: 'tracker',
    props: ['executor'],
    components: {
        Navbar,
        Pagination
    },
    mounted() {
        this.getDrivers()
        setInterval(() => {
         this.updateDriverLocation()
        }, 5000);
    },
    computed: {
        filterDrivers() {
            let $this = this
            return $this.admin.drivers.data.filter((driver_info) => {
                return driver_info.staff_name.match(this.name);

            });

        },
    },
    data() {
        return {
            flash: Flash.state,
            name: '',
            center:{
                lat:6.538810011243441,
                lng:3.4081426833243245
            },
            markers:[],
            infoContent:'',
            infoWindowPos:{
                lat:0,
                lng:0
            },
            infoWinOpen:false,
            currentMidx:null,
            infoOptions:{
              pixelOffset:{
                width:0,
                height:35
              }
            },


        }

    },
    methods: {

        status_1(status) {
            if (status == 1) {
                return true;
            }
            return false
        },
        status_0(status) {
            if (status == 0) {
                return true;
            }
            return false
        },
        status_2(status) {
            if (status == 2) {
                return true;
            }
            return false
        },
        status_3(status) {
            if (status == 3) {
                return true;
            }
            return false
        },
        getDrivers() {
            let $this = this
            get(BASE_URL + `/api/driver?page=${$this.admin.drivers.pagination.current_page}`).then((response) => {
                $this.admin.drivers.data = response.data.data;
                $this.admin.drivers.pagination.current_page = response.data.current_page;
                $this.admin.drivers.pagination.total = response.data.total;
                $this.admin.drivers.pagination.per_page = response.data.per_page;
                $this.admin.drivers.pagination.last_page = response.data.last_page;
                $this.admin.drivers.pagination.from = response.data.from;
                $this.admin.drivers.pagination.to = response.data.to;

            });
        },
        updateDriverLocation(){
          let $this = this
            get(BASE_URL + `/api/driver/location`).then((response) => {

                for (const mark in response.data) {
                   const marker = {
                    lat:mark.lat,
                    lng:mark.lng,
                     }
                $this.markers.push({position:maker,driver_name:mark.driver_name});
                console.log(this.markers)
                }
            });

        },
        toggleInfoWindow(marker,index){
           this.infoWindowPos = marker.position;
           this.infoContent = marker.driver_name

           if (this.currentMidx == index) {
               this.infoWinOpen = !this.infoWinOpen;
           } else {
               this.infoWinOpen = true;
               this.currentMidx = index;
           }
        }


    }

}
</script>
