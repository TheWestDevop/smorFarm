<template>
    <div class="here-map">
        <div ref="map" v-bind:style="{ width: width, height: height }"></div>
    </div>
</template>

<script>
    export default {
        name: "HereMap",
         data() {
            return {
                map: {},
                platform: {},
                behavior:'',
            }
        },
        props: {
            appId: String,
            //appCode: String,
            lat: String,
            lng: String,
            width: String,
            height: String,
        },
        created() {
            this.platform = new H.service.Platform({
        "app_id": this.appId
         });
         },
        mounted() { 
            this.map = new H.Map(this.$refs.map,this.platform.createDefaultLayers().vector.normal.map);
            this.map.setCenter({lat:this.lat, lng:this.lng});
            this.map.setZoom(17);
            this.behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(this.map));
            var ui = H.ui.UI.createDefault(map, this.platform.createDefaultLayers());
            
            console.log('position : lat' + this.lat + ' lng ' + this.lng )
            dropMaker(this.lat,this.lng)
        },
        methods:{
            dropMaker(lat,lng){
                let marker = new H.map.Maker({lat:lat,lng:lng})
                this.map.addObject(marker);
            }
        }
    }
</script>