<template>
    <div class="here-map">
                  <div  class="navbar-search navbar-search-dark form-inline mr-3 mt-1 d-md-flex ml-lg-auto">
                                            <div class="form-group mb-0">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-search text-black-50"></i></span>
                                                    </div>
                                                    <input class="products form-control" placeholder="Destination Address" v-model="address" type="text">
                                                </div>
                                                <div class="input-group input-group-alternative ml-2">
                                                    <button class="btn btn-primary btn-sm" @click.prevent="destination()" >Get Direction</button>
                                                    </div>
                                            </div>
        </div>
        <br>
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
                geocoder:{},
                    center:{
                    lat:0,
                    lng:0
                    },
                    address:'Osara Close,Abuja'
            }
        },
        props: {
            appId: String,
            appCode: String,
            width: String,
            height: String,
        },
        created() {
            this.platform = new H.service.Platform({"apikey":this.appCode}); 
            this.router = this.platform.getRoutingService();
            this.geocoder = this.platform.getGeocodingService();
            this.destination()
           },
           
        methods:{
            destination(){
                let geocodingParameters = {
                    searchText:this.address,
                    jsonattributes : 1
                    };

                this.geocoder.geocode(
                    geocodingParameters,
                    (result) => {
                        console.log(result);
                        var locations = result.response.view[0].result;
                        console.log(locations);
                        
                        //this.addLocationsToMap(locations)
                        let group = new  H.map.Group()
                        let position
                        let i

                        // Add a marker for each location found
                        for (i = 0;  i < locations.length; i += 1) {
                            position = {
                            lat: locations[i].location.displayPosition.latitude,
                            lng: locations[i].location.displayPosition.longitude
                            };
                           let marker = new H.map.Marker(position);
                            marker.label = locations[i].location.address.label;
                            group.addObject(marker);
                        }

                        this.getDirection(this.center,position);

                        group.addEventListener('tap', function (evt) {
                            this.map.setCenter(evt.target.getGeometry());
                            var bubble =  new H.ui.InfoBubble(evt.target.getGeometry(), {
                            // read custom data
                            content: evt.target.getData()
                            });
                        }, false);

                        // Add the locations group to the map
                        this.map.addObject(group);
                        this.map.setCenter(group.getBoundingBox().getCenter());
                            
                        },
                    (error) => {
                        alert('Can\'t reach the remote server');
                        }
                );
            },
            init(){
                 navigator.geolocation.getCurrentPosition(position =>{
                this.center.lat = position.coords.latitude
                this.center.lng = position.coords.longitude
                this.map = new H.Map(this.$refs.map,this.platform.createDefaultLayers().vector.normal.map);
                this.map.getViewModel().setLookAtData({tilt: 45});
                // Add behavior to the map: panning, zooming, dragging.
                let behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(this.map));
            
                // Create an icon, an object holding the latitude and longitude, and a marker:
                let icon = new H.map.Icon('http://maps.google.com/mapfiles/ms/icons/blue.png')
                let marker = new H.map.Marker(this.center,{icon: icon})
                this.map.addObject(marker);
                this.map.setCenter(this.center);
                this.map.setZoom(18)
                this.interleave()
                this.updatelocation(this.center);
                this.destination()
                console.log(this.center);
                });
         
         
            },
            updatelocation(center){
                let id = localStorage.getItem('executor_user_id');
                let form = new FormData();
                form.append('lat',center.lat)
                form.append('lng',center.lng)
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
                    let parts = point.split(',');
                    linestring.pushLatLngAlt(parts[0], parts[1]);
                });

                // Retrieve the mapped positions of the requested waypoints:
                startPoint = route.waypoint[0].mappedPosition;
                endPoint = route.waypoint[1].mappedPosition;


                // Create a marker for the start point:
                let startMarker = new H.map.Marker({
                    lat: startPoint.latitude,
                    lng: startPoint.longitude
                });

                // Create a marker for the end point:
                let endMarker = new H.map.Marker({
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
            getDirection(start,stop){
             let routingParameters = {
                    // The routing mode:
                    'mode': 'fastest;car;traffic:enabled',
                    // The start point of the route:
                    'waypoint0': `${start.lat},${start.lng}`,
                    // The end point of the route:
                    'waypoint1': `${stop.lat},${stop.lng}`,
                    // To retrieve the shape of the route we choose the route
                    // representation mode 'display'
                    'representation': 'display'
                    }
             router.calculateRoute(routingParameters, this.onResult(),this.onError());
            },
            interleave(){
                let provider = this.map.getBaseLayer().getProvider();

                // get the style object for the base layer
                let style = provider.getStyle();

                let changeListener = () => {
                    if (style.getState() === H.map.Style.State.READY) {
                    style.removeEventListener('change', changeListener);

                    // create a provider and a layer that are placed under the buildings layer
                    let objectProvider = new H.map.provider.LocalObjectProvider();
                    let objectLayer = new H.map.layer.ObjectLayer(objectProvider);
                    // add a circle to this provider the circle will appear under the buildings
                    objectProvider.getRootGroup().addObject(new H.map.Circle(this.map.getCenter(), 500));
                    // add the layer to the map
                    this.map.addLayer(objectLayer);

                    // extract buildings from the base layer config 
                    // in order to inspect the config calling style.getConfig()
                    buildings = new H.map.Style(style.extractConfig('buildings'));
                    // create the new layer for the buildings
                    buildingsLayer = this.platform.getOMVService().createLayer(buildings);
                    // add the layer to the map
                    this.map.addLayer(buildingsLayer);

                    // the default object layer and its objects will remain on top of the buildings layer
                    this.map.addObject(new H.map.Marker(this.map.getCenter()));
                    }
                    style.addEventListener('change', changeListener);
                  }
                }
            },
            addLocationsToMap(locations){
                
                }
            
            
       }
</script>