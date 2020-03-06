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
                    <div class="col-md-12 ">
                        <div class="card shadow">
                            <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                                            <div class="form-group m-5">
                                            
                                                  
                                            </div>
                                            <div class="form-group mb-0">
                                               <button type="submit" class="btn btn-primary" @click="getDirection()">Direction</button> 
                                            </div>
                            </form>
                            <br>
                            <div class="container">
                                <HereMap 
                                    appId="vFeicXHJJygakyap4B5z"
                                    appCode="OcTEbIGbMuGF56h_Z1E_Ammaoy-SROE8DWJsaUZBkFc"
                                    lat= executor.center.lat
                                    lng= executor.center.lng 
                                    width="100%"
                                    height="835px"
                                >

                                </HereMap>

                            </div>
                            
                        </div>
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
} from '../../util/api'
export default {
    name: 'location',
    props: ['executor'],
    components: {
        Navbar,
        Pagination,
        HereMap
    },
    mounted() {
         
    },
    computed: {
       

    },
    data() {
        return {
            flash: Flash.state,
            destination: '',
            
        }

    },
    methods: {
    }

}
</script>
