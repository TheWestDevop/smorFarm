<template>
<div class="page-section mb-60">
     <br>
        <div class="container">

 <div class="table-responsive">
                     <table class="table table-striped  table-darker tabl ">
                         <thead>
                             <th>Product Order</th>
                             <th>Total</th>
                             <th>Payment ID</th>
                             <th>Driver Name</th>
                             <th>Ticket ID</th>
                             <th>Ordered Date</th>
                             <th>Status</th>
                         </thead>
                         <tbody>
                             <tr v-for="order in app.orders.data" :key="order.id">
                                 <td>

                                    <p v-for="product in JSON.parse(order.Orders)" :key="product.id">{{product.name}} {{product.quantity}}, </p>

                                 </td>
                                 <td>&#8358;{{order.total}}</td>
                                 <td>{{order.payment_id }}</td>
                                 <td>{{order.driver_name }}</td>
                                 <td>{{order.ticket_id }}</td>
                                 <td>{{order.created_at }}</td>


                                 <td >
                                                <span v-if="status_0(order.status)" class="btn btn-warning text-white"> Pending ...</span>
                                                <span v-if="status_1(order.status)" class="btn btn-success"> <i class="fa fa-check text-white"></i> Completed</span>

                                            </td>

                             </tr>
                         </tbody>
                           <tfoot>
                           <pagination :paginations="app.orders.paginations" @paginate="getOrders()" :offset="4">
                            </pagination>
                           </tfoot>
                     </table>
 </div>
            </div>

    </div>

</template>

<script>
import { get } from "../util/api";
import pagination from '../components/pagination.vue'

export default {
    name:"orders",
    props:['app'],
    components:{
     pagination
    },

    data(){
    return{


    }
    },
    methods:{
          status_1(status){
         if (status==1) {
             return true;
         }
         return false
        },
        status_0(status){
         if (status==0) {
             return true;
         }
         return false
        },
        getOrders(){
            let $this = this;
           let id = localStorage.getItem('user_id');
          get(BASE_URL+`/api/user/${id}/order?page=${$this.app.orders.paginations.current_page}`).then(function (response) {
                    if (response.data) {

                        $this.app.orders.data = response.data.data

                    }

                })
       }
    }

}
</script>

<style>

</style>
