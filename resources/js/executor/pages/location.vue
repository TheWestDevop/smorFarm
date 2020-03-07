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
                            <div class="container">
                                <HereMap 
                                    appId="vFeicXHJJygakyap4B5z"
                                    appCode="OcTEbIGbMuGF56h_Z1E_Ammaoy-SROE8DWJsaUZBkFc"
                                    lat= this.lat
                                    lng= this.lng
                                    width="100%"
                                    height="400px"
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
         this.lat = this.executor.center.lat.toString()
         this.lng = this.executor.center.lng.toString()
    },
    computed: {
       

    },
    data() {
        return {
            flash: Flash.state,
            lat:'',
            lng:'' 
        }

    },
    methods: {
         getDirection(){
             let routeOutline = new H.map.Polyline(linestring, {
                    style: {
                        lineWidth: 10,
                        strokeColor: 'rgba(0, 128, 255, 0.7)',
                        lineTailCap: 'arrow-tail',
                        lineHeadCap: 'arrow-head'
                    }
                    });
                // Create a patterned polyline:
             let routeArrows = new H.map.Polyline(linestring, {
                style: {
                    lineWidth: 10,
                    fillColor: 'white',
                    strokeColor: 'rgba(255, 255, 255, 1)',
                    lineDash: [0, 2],
                    lineTailCap: 'arrow-tail',
                    lineHeadCap: 'arrow-head' }
                }
                );
            

         }
    }

}
</script>
