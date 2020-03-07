<template>

    <div class="main-content">
        <Navbar :nav="executor" />
        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
            <div class="alert alert-success text-center w-50 mx-auto" v-if="flash.success">
                {{flash.success}}
            </div>
            <div class="alert alert-danger text-center  w-50 mx-auto" v-if="flash.error">
                {{flash.error}}
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 card shadow">
                        <div  class="navbar-search navbar-search-dark form-inline mr-3 mt-1 d-md-flex ml-lg-auto">
                                            <div class="form-group mb-0">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-search text-black-50"></i></span>
                                                    </div>
                                                    <input class="products form-control" placeholder="Destination Address" v-model="address" type="text">
                                                </div>
                                                <div class="input-group input-group-alternative ml-2">
                                                    <button class="btn btn-primary btn-sm" >Get Direction</button>
                                                </div>
                                            </div>
        </div>
        <br>
                           
                                <HereMap 
                                    ref="map"
                                    appId="vFeicXHJJygakyap4B5z"
                                    appCode="OcTEbIGbMuGF56h_Z1E_Ammaoy-SROE8DWJsaUZBkFc"
                                    width="100vw"
                                    height="430px"
                                >

                                </HereMap>

                          
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from '../components/navbar';
import HereMap from '../components/HereMap';
import Flash from "../../util/flash"
import Pagination from "../components/pagination";
import {
    get
} from '../util/api'
export default {
    name: 'location',
    props: ['executor'],
    components: {
        Navbar,
        Pagination,
        HereMap
    },
    mounted() {
      let map = this.$refs.map;
      map.init();  
    },
    computed: {
       

    },
    data() {
        return {
            flash: Flash.state,
            address:''
        }

    },
    methods: {
       getAddress(){
           let map = this.$refs.map;
           map.getAddress(this.address)
           console.log(map.getAddress(this.address));
       }
    }

}
</script>
