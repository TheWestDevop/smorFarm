<template>
  <!-- Begin Login Content Area -->
  <div class="page-section mb-60">
    <div class="container">
      <div class="row justify-content-center mt-150 mb-150">
        <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
          <!-- Login Form -->
         
            <div class="login-form">
                <i class="fa fa-times-circle fa-5x mb-5 text-danger row justify-content-center"></i>
                                <br>
              <h5 class="m-3 font-weight-600 text-danger">Your Payment Wasn't Successful, kindly refresh and try again</h5>

              <router-link :to="{name:'checkout'}" class="btn btn-block github-btn mt-3">

                <i class="fa fa-arrow-left fa-1x"></i>&nbsp; Back

            </router-link>
            </div>
          
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content Area End Here -->
</template>
<script>
export default {
    name:'payment_success',
}
</script>