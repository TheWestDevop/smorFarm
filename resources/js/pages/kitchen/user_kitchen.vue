<template>
<div class="page-section mb-60">
     <br>
        <div class="container">
<div class="ct-page-title h2">All User Booked Kitchens</div>
 <div class="table-responsive">
                     <table class="table table-striped  table-darker">
                         <thead>
                             <th>Kitchen Name</th>
                             <th>Kitchen Location</th>
                             <th>Ticket</th>
                             <th>Cost</th>
                             <th>Booked Date</th>
                         </thead>
                         <tbody>
                             <tr v-for="kitchen in this.$store.getters.USER_KITCHEN.data" :key="kitchen.id">
                                 <td>
                                    <div class=" d-flex ">
                                       {{kitchen.kitchen_name}}
                                    </div>

                                 </td>
                                 <td>{{kitchen.kitchen_location}}</td>
                                 <td>{{kitchen.ticket }}</td>
                                 <td>&#8358;{{kitchen.ticket_cost}}</td>
                                 <td>{{kitchen.created_at | ago}}</td>



                             </tr>
                         </tbody>

                     </table>
                     <pagination :paginations="this.$store.getters.USER_KITCHEN.pagination" @paginate="navigate" :offset="4">
                            </pagination>
 </div>
            </div>

    </div>

</template>

<script>
import pagination from '../../components/pagination.vue'

export default {
    name:"user-kitchens",
    components:{
     pagination
    },
    methods:{
        navigate(){
         this.$store.dispatch(
        "fetchallUserkitchen",
        this.$store.state.UserModule.user.user.name
      );
        }

    },
    mounted(){
        this.$store
          .dispatch("spinner", true)
       this.$store.dispatch(
        "fetchallUserkitchen",
        this.$store.state.UserModule.user.user.name
      );
        this.$store
          .dispatch("spinner", false)
    }

}
</script>

<style>

</style>
