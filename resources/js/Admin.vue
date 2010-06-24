<template>
    <div>
        <SideNav :admin="this" />
        <router-view :admin="this"></router-view>
    </div>
</template>

<script>
import SideNav from "./admin/components/SideNav";
import {
    get
} from "./admin/util/api";
import Auth from "./admin/util/Auth";
export default {
    name: "admin",
    components: {
        SideNav
    },
    data() {
        return {
            admin:[],
            auth: Auth.state,
            categories: {
                data: [],
                pagination: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1,
                    last_page: 0
                }
            },
            products: {
                products: [],
                pagination: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1,
                    last_page: 0
                }
            },
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
            deliveries: {
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
            drivers: {
                data: [],
                pagination: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1,
                    last_page: 0
                }
            },
            staff: {
                data: [],
                pagination: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1,
                    last_page: 0
                }
            },
            customer: {
                data: [],
                pagination: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1,
                    last_page: 0
                }
            },
            fast_customer: {
                data: [],
                pagination: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1,
                    last_page: 0
                }
            },
            logistics: {
                data: [],
                pagination: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1,
                    last_page: 0
                }
            },
            

        }

    },
    mounted() {
        this.getCategory();
        this.getStaff();
        this.getCustomer();
        this.getLogistics();
    },
    methods: {
        initAdmin() {
            
            get(BASE_URL + '/api/auth/admin/init').then((response) => {
                if (response.data.id) {
                    Auth.set(response.data.api_token, response.data.id);
                    this.admin = response.data;
                }else{
                    console.log('')
                }

            })
        },
        getCategory() {

            let $this = this;
            get(BASE_URL + "/api/categories").then(function (response) {
                if (response.data) {
                    $this.categories.data = response.data.data;
                    $this.categories.pagination.current_page = response.data.current_page;
                    $this.categories.pagination.total = response.data.total;
                    $this.categories.pagination.per_page = response.data.per_page;
                    $this.categories.pagination.last_page = response.data.last_page;
                    $this.categories.pagination.from = response.data.from;
                    $this.categories.pagination.to = response.data.to;
                }
            });
        },
        getStaff() {

            let $this = this;
            get(BASE_URL + "/api/all/staff").then(function (response) {
                if (response.data) {
                    $this.staff.data = response.data.data;
                    $this.staff.pagination.current_page = response.data.current_page;
                    $this.staff.pagination.total = response.data.total;
                    $this.staff.pagination.per_page = response.data.per_page;
                    $this.staff.pagination.last_page = response.data.last_page;
                    $this.staff.pagination.from = response.data.from;
                    $this.staff.pagination.to = response.data.to;
                }
            });
        },
        getCustomer() {

            let $this = this;
            get(BASE_URL + "/api/all/customer/").then(function (response) {
                if (response.data) {
                    $this.fast_customer.data = response.data.fast_track.data;
                    $this.fast_customer.pagination.current_page = response.data.fast_track.current_page;
                    $this.fast_customer.pagination.total = response.data.fast_track.total;
                    $this.fast_customer.pagination.per_page = response.data.fast_track.per_page;
                    $this.fast_customer.pagination.last_page = response.data.fast_track.last_page;
                    $this.fast_customer.pagination.from = response.data.fast_track.from;
                    $this.fast_customer.pagination.to = response.data.fast_track.to;

                    $this.customer.data = response.data.r_customer.data;
                    $this.customer.pagination.current_page = response.data.r_customer.current_page;
                    $this.customer.pagination.total = response.data.r_customer.total;
                    $this.customer.pagination.per_page = response.data.r_customer.per_page;
                    $this.customer.pagination.last_page = response.data.r_customer.last_page;
                    $this.customer.pagination.from = response.data.r_customer.from;
                    $this.customer.pagination.to = response.data.r_customer.to;
                }
            });
        },
        getLogistics() {

            let $this = this;
            get(BASE_URL + "/api/all/logistics").then(function (response) {
                if (response.data) {
                    $this.logistics.data = response.data.data;
                    $this.logistics.pagination.current_page = response.data.current_page;
                    $this.logistics.pagination.total = response.data.total;
                    $this.logistics.pagination.per_page = response.data.per_page;
                    $this.logistics.pagination.last_page = response.data.last_page;
                    $this.logistics.pagination.from = response.data.from;
                    $this.logistics.pagination.to = response.data.to;
                }
            });
        },
      
        
    }
}
</script>

<style >

</style>
