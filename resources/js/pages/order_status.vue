<template>
 <div class="page-section mb-60">
     <br>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                    <form v-on:submit.prevent="verify">
                        <div class="login-form">
                            <h4 class="login-title">Kindly Enter Order Ticket ID</h4>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <input class="mb-0" type="text" v-model="id" placeholder="Order Ticket ID" :class="{'is-invalid':errorId}" />
                                    <div  class="mt-2 p-2 font-italic text-danger">{{errorId}}</div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-block mt-0">Check Status</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <br>
                 <div class="row justify-content-center">
                     <table class="table table-striped table-bordered">
                         <thead>
                             <th>Product Order</th>
                             <th>Total</th>
                             <th>Ordered Date</th>
                             <th>Status</th>
                         </thead>
                         <tbody>
                             <tr>
                                 <td>

                                    <p v-for="product in product_order" :key="product.id">{{product.name}}</p>

                                 </td>
                                 <td>&#8358;{{total}}</td>
                                 <td>{{created_time }}</td>

                                 <td >
                                                <span v-if="status_0(status)" class="btn btn-warning text-white">Pending ...</span>
                                                <span v-if="status_1(status)" class="btn btn-success"> <i class="fa fa-check text-white"></i> Completed</span>

                                            </td>

                             </tr>
                         </tbody>

                     </table>
                 </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Flash  from  '../util/flash';
import { get } from "../util/api";

export default {
    name:'order_status',
    data(){
        return{
            id:'',
            product_order:[],
            total:'',
            created_time:'',
            status:2,
            temp:'',
            errorId:'',
            error:[]
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
    verify() {
            this.error = [];
            if (this.id.length <= 12 && this.id === '') {
                this.errorId = "Order ID is required and Order ID is 12 digit ";
                this.error.push(this.errorId);
            } else {
                this.errorId = null;
            }

            if (!this.error.length ) {
                 let $this = this;
                get(BASE_URL+'/api/order/verify/'+ $this.id).then(function (response) {
                    if (response.data.id) {

                        $this.product_order = JSON.parse(response.data.Orders)
                        $this.total   = response.data.total
                        $this.created_time = response.data.created_at
                        $this.status = response.data.status
                    } else {
                        Flash.setError('Invalid Order ID, Check your Input and Try again later !  ');
                    }

                })
            }
        }
    }

}

</script>
