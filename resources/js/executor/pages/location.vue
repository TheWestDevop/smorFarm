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
                                <gmap-map
                                                    :center="executor.center"
                                                    :zoom="15"
                                                    style="width:100%;height:400px;">

                                                  

                                                    <gmap-marker
                                                        
                                                        :position="executor.center"
                                                        @click="center=executor.center"
                                                            
                                                    >

                                                    </gmap-marker>
                                                </gmap-map>

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
    get
} from '../../util/api'
export default {
    name: 'location',
    props: ['executor'],
    components: {
        Navbar,
        Pagination
    },
    mounted() {
         
    },
    computed: {
       

    },
    data() {
        return {
            flash: Flash.state,
            name: '',
        }

    },
    methods: {
        loadMap(){

        }
    }

}
</script>
