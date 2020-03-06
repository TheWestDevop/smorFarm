<template>
<div class="page-section mb-60">
     <br>
        <div class="container">
<div class="ct-page-title h2">All User Orders</div>
 <div class="table-responsive">
                     <table class="table table-striped  table-darker">
                         <thead>
                             <th>Product Order</th>
                             <th>Total</th>
                             <th>Ticket ID</th>
                             <th>Ordered Date</th>
                             <th>Status</th>
                         </thead>
                         <tbody>
                             <tr v-for="order in this.$store.getters.ALL_USER_ORDER.data" :key="order.id">
                                 <td>
                                    <div class=" d-flex ">
                                        <div v-for="product in JSON.parse(order.orders)" :key="product.id" class="m-2">{{product.name}}, </div>

                                    </div>

                                 </td>
                                 <td>&#8358;{{order.total}}</td>
                                 <td>{{order.ticket_id }}</td>
                                 <td>{{order.created_at | ago}}</td>


                                 <td >
                                                <span v-if="status_0(order.status)" class="btn btn-warning text-white"> Pending ...</span>
                                                <span v-if="status_1(order.status)" class="btn btn-success"> <i class="fa fa-check text-white"></i> Completed</span>

                                            </td>

                             </tr>
                         </tbody>

                     </table>
                     <pagination :paginations="this.$store.getters.ALL_USER_ORDER.pagination" @paginate="navigate" :offset="4">
                            </pagination>
 </div>
            </div>

    </div>

</template>

<script>
import pagination from '../../components/pagination.vue'

export default {
    name:"orders",
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
        navigate(){
            this.$store.dispatch('fetchAllUserOrder',this.$store.state.UserModule.user.user.id);
        }

    },
    mounted(){
        this.$store
          .dispatch("spinner", true)
        this.$store.dispatch('fetchAllUserOrder',this.$store.state.UserModule.user.user.id);
        this.$store
          .dispatch("spinner", false)
    }

}
</script>

<style>

</style>
