<template>
    <div>
        <SideNav :executor="this" />
        <router-view :executor="this"></router-view>
    </div>
</template>

<script>
import SideNav from "../executor/components/SideNav";
import {
    get,post
} from "../executor/util/api";

export default {
    name: "executor",
    components: {
        SideNav
    },
    data() {
        return {
            executor:[],
            orders: {
                data: [],
                pagination: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1,
                    last_page: 0
                },

            },
            api_token : localStorage.getItem('executor_api_token'),
            notify:{
                count:0,
                notification:[]
            },
            center:{
                lat:0,
                lng:0
            },
            name:''
        }

    },
    created() {
        this.getOrders();
        this.initExecutor();
        this.getNotification();
        this.updatelocation()
         
    },
    methods: {
        initExecutor() {

            get(BASE_URL + '/api/auth/executor/init').then((response) => {
                if (response.data.user.id) {
                    this.executor = response.data;
                }else{
                    console.log('')
                }

            })
        },
        getOrders() {
            let $this = this
            get(BASE_URL + `/api/executor/${this.api_token}/orders`).then((response) => {
             
                $this.orders.data = response.data.data;
                $this.orders.pagination.current_page = response.data.current_page;
                $this.orders.pagination.total = response.data.total;
                $this.orders.pagination.per_page = response.data.per_page;
                $this.orders.pagination.last_page = response.data.last_page;
                $this.orders.pagination.from = response.data.from;
                $this.orders.pagination.to = response.data.to;

            });
        },

        getNotification() {
            let $this = this
            get(BASE_URL + `/api/executor/${this.api_token}/new/order/notification/`).then((response) => {
                $this.notify.count = response.data.count;
                $this.notify.notification = response.data.notification;
            });
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
            
        }


    }
}
</script>

<style >

</style>
