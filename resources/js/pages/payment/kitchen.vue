<template>
  <!-- Begin Login Content Area -->
  <div class="page-section mb-60">
    <div class="container">
      <div class="row justify-content-center mt-150 mb-150">
        <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
          <!-- Login Form -->
         
            <div class="login-form">
                <i class="fa fa-check-circle fa-5x mb-5 text-success row justify-content-center"></i>
                                <br>
              <h5 class="m-3 font-weight-600 text-success">Your Payment Was Successful, And Your Booking  ID  <br><i class="row justify-content-center mt-2">{{ this.$store.getters.BOOKING_TICKET}}</i></h5>
               
                
                    
               <button @click.prevent="home" class="card-form__button github-btn mt-3 text-white"  ><i class="fa fa-arrow-left fa-1x text-white"></i> Back Home</button>
                                   
                
            
            </div>
          
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content Area End Here -->
</template>
<script>
export default {
    name:'kitchen_payment',
    methods:{
      home(){
        this.$router.push({name:'kitchen'});
      }
    }
}
</script>