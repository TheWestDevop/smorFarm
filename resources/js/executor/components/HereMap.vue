<template>
    <div class="here-map">
        <div ref="map" v-bind:style="{ width: width, height: height }"></div>
    </div>
</template>

<script>
import {
    post
} from '../../util/api';

    export default {
        name: "HereMap",
         data() {
            return {
                map: {},
                platform: {},
                router:{},
                routingParameters:{
                    // The routing mode:
                    'mode': 'fastest;car',
                    // The start point of the route:
                    'waypoint0': 'geo!50.1120423728813,8.68340740740811',
                    // The end point of the route:
                    'waypoint1': 'geo!52.5309916298853,13.3846220493377',
                    // To retrieve the shape of the route we choose the route
                    // representation mode 'display'
                    'representation': 'display'
                    },
                    center:{
                lat:0,
                lng:0
            }
            }
        },
        props: {
            appId: String,
            appCode: String,
            width: String,
            height: String,
        },
        created() {
            this.updatelocation();
            console.log(this.center.lat +" " + this.center.lng);
            this.platform = new H.service.Platform({
           "apikey":this.appCode
         });
             // Get an instance of the routing service:
            this.router = this.platform.getRoutingService();
            this.map = new H.Map(this.$refs.map,this.platform.createDefaultLayers().vector.normal.map);
            this.map.setCenter({lat:"9.09741", lng:"9.09741"});
            this.map.setZoom(10);
            this.map.addLayer(defaultLayers.vector.normal.trafficincidents);
            
            console.log('position : lat' + this.lat + ' lng ' + this.lng )
            this.dropMaker("9.09741","9.09741")
         },
        methods:{
            dropMaker(lat,lng){
                let marker = new H.map.Maker({lat:lat,lng:lng})
                this.map.addObject(marker);
            },
            updatelocation(){
            let id = localStorage.getItem('executor_user_id');
            navigator.geolocation.getCurrentPosition(position =>{
             let $this = this
             $this.center.lat = position.coords.latitude
             $this.center.lng = position.coords.longitude
 
           });
             let form = new FormData();
             form.append('lat',this.center.lat)
             form.append('lng',this.center.lng)
             post(BASE_URL + `/api/driver/location/${id}`,form).then((response) => {});
            
            },
            onResult(result){

                

                let route,routeShape,startPoint,endPoint,linestring;
                if(result.response.route) {
                // Pick the first route from the response:
                route = result.response.route[0];
                // Pick the route's shape:
                routeShape = route.shape;

                // Create a linestring to use as a point source for the route line
                linestring = new H.geo.LineString();

                // Push all the points in the shape into the linestring:
                routeShape.forEach(function(point) {
                    var parts = point.split(',');
                    linestring.pushLatLngAlt(parts[0], parts[1]);
                });

                // Retrieve the mapped positions of the requested waypoints:
                startPoint = route.waypoint[0].mappedPosition;
                endPoint = route.waypoint[1].mappedPosition;


                // Create a marker for the start point:
                var startMarker = new H.map.Marker({
                    lat: startPoint.latitude,
                    lng: startPoint.longitude
                });

                // Create a marker for the end point:
                var endMarker = new H.map.Marker({
                    lat: endPoint.latitude,
                    lng: endPoint.longitude
                });

                // Create an outline for the route polyline:
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
                // create a group that represents the route line and contains
                // outline and the pattern
                let routeLine = new H.map.Group();
                routeLine.addObjects([routeOutline, routeArrows]);
 
                // Add the route polyline and the two markers to the map:
                this.map.addObjects([routeOutline, routeArrows, startMarker, endMarker]);

                // Set the map's viewport to make the whole route visible:
                this.map.getViewModel().setLookAtData({bounds: routeLine.getBoundingBox()});
                
                }

            },
            direction(){
                router.calculateRoute(this.routingParameters, this.onResult,
                function(error) {
                    alert(error.message);
                });
            }
        }
    }
</script>