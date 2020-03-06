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
                                            
                                                    <gmap-autocomplete 
                                                    @place_changed="setPlace">
                                                    </gmap-autocomplete>
                                            </div>
                                            <div class="form-group mb-0">
                                               <button type="submit" class="btn btn-primary" @click="getDirection()">Direction</button> 
                                            </div>
                            </form>
                            <br>
                            <div class="container">
                                <gmap-map           
                                                    ref="map"
                                                    :center="executor.center"
                                                    :zoom="17"
                                                    type="satellite"
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
            destination: '',
            
        }

    },
    methods: {

    setPlace(place) {
      this.destination = place;
    },
    getDirection(){
      let directionsService = new google.maps.DirectionsService;
      let directionsDisplay = new google.maps.DirectionsRenderer;
      directionsDisplay.setMap(this.$refs.map.$mapObject);
      let start = this.executor.center;
      let stop = {
        lat:this.destination.geometry.location.lat(),
        lng:this.destination.geometry.location.lng()
      }
      //google maps API's direction service
      function calculateAndDisplayRoute(directionsService, directionsDisplay, start, stop) {
        directionsService.route({
          origin: start,
          destination: stop,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }

      console.log(this.start);
      console.log(this.stop);

      calculateAndDisplayRoute(directionsService, directionsDisplay, this.start, this.stop);
        }
    }

}
</script>
