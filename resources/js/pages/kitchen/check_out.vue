<template>
    <div class="checkout-area pt-60 pb-30">
        <div class="container">

            <div class="row">
                <div class="col-lg-2 col-12">

                </div>
                <div class="col-lg-8 col-12">
                    <div class="your-order">
                        <h3>Your Booking</h3>
                        <div class="your-order-table table-responsive">
                            <div class="row">
                             <div class="col-lg-5 col-12">
                                 <div class="product-image">
                               <a href="#">
                           <img :src="`/images/kitchens/${this.$store.getters.KITCHEN.image}`" alt="Li's Product Image" />
                             </a>
                            </div>
                             </div>
                             <div class="col-lg-7 col-12">
                                 <div class="your-order-table table-responsive">
                            <table class="table">
                                <thead>
<th><strong class="h5"> Kitchen Information</strong></th>
                                </thead>
                                <tbody>
                                    <tr class="cart_item" >
                                        <td class="cart-product-name">
                                            {{this.$store.getters.KITCHEN.title}}

                                        </td>
                                    </tr>
                                    <tr class="cart_item" >
                                        <td class="cart-product-name" v-if="this.$store.getters.KITCHEN.status == 0">
                                           
                                              <p>Status - <span class="font-weight-bold text-success">Available</span></p>  
                                        </td>
                                        <td class="cart-product-name" v-if="this.$store.getters.KITCHEN.status == 1">
                                            
                                            <p>Status - <span class="font-weight-bold text-success">Booked</span> </p>
                                        </td>
                                        <td class="cart-product-name" v-if="this.$store.getters.KITCHEN.status == 2">
                                            
                                            <p>Status - <span class="font-weight-bold text-success">Under Maintenance</span> </p>
                                        </td>
                                    </tr>
                                    <tr class="cart_item" >
                                        <td class="cart-product-name">
                                        <p>Location - {{this.$store.getters.KITCHEN.location}} </p>

                                        </td>
                                    </tr>

                                </tbody>
                                <tfoot>

                                    <tr class="order-total">
                                        <th>Booking Cost</th>
                                        <td>
                                            <strong>
                                                <span class="amount" v-if="this.$store.state.KitchenModule.booking.time_booked == 30 ">&#8358;500</span>
                                                <span class="amount" v-if="this.$store.state.KitchenModule.booking.time_booked == 60 ">&#8358;900</span>
                                                <span class="amount" v-if="this.$store.state.KitchenModule.booking.time_booked == 90 ">&#8358;1300</span>
                                                <span class="amount" v-if="this.$store.state.KitchenModule.booking.time_booked == 120 ">&#8358;1600</span>
                                            </strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                             </div>
                            </div>
                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion">

                                <div class="order-button-payment">

                                    <button @click.prevent="Booking" class="btn-2 github-btn"  >Place Booking <i class="fa fa-money"></i></button>
                                    <button @click.prevent="back" class="btn-3 github-btn mt-3"  ><i class="fa fa-arrow-left fa-1x text-white"></i> Back</button>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-12">

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Checkout",
    data() {
        return {
            
        };
    },
    methods: {
        Booking() {
            if (this.$store.getters.AUTH_STATUS === false) {
                    this.$store.dispatch('logOut').then(()=>{
                      this.$router.push({
                            name: "auth.login"
                        });
                  })  
                }
                if (this.$store.getters.KITCHEN === "") {
                    this.$router.push({
                            name: "kitchen"
                        }); 
                }
                

                this.$router.push({
                    name: "kitchen_payment"
                });
        },
        back(){
          this.$router.back()
        }
        
    }
};
</script>

<style>
</style>
