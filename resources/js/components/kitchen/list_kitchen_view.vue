<template>
    <div class="row product-layout-list">
        <div class="col-lg-3 col-md-5">
            <div class="product-image">
                <a href="#">
                    <img :src="`/images/kitchens/${kitchen.image}`" alt="Li's Product Image" />
                </a>
            </div>
        </div>
        <div class="col-lg-5 col-md-7">
            <div class="product_desc">
                <div class="product_desc_info">
                    <div class="product-review">
                        <h4>
                        <a href="#" class="product_name">{{kitchen.title}}</a>
                    </h4>
                        <div class="rating-box">
                            <ul class="rating">
                                <li>
                                    <i class="fa fa-star-o"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star-o"></i>
                                </li>
                                <li>
                                    <i class="fa fa-star-o"></i>
                                </li>
                                <li class="no-star">
                                    <i class="fa fa-star-o"></i>
                                </li>
                                <li class="no-star">
                                    <i class="fa fa-star-o"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="price-box">
                        <div class="product-select-box">
                            <div class="product-short">
                                <select v-model="time_booked" class="booking-price">
                                    <option value="30">30min - &#8358;500</option>
                                    <option value="60">1hour - &#8358;900</option>
                                    <option value="90">1hour 30min - &#8358;1300</option>
                                    <option value="120">2hour - &#8358;1600</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-3 pt-3 font-weight-400">
                           <p v-if="kitchen.status == 0">Status :- <span class="font-weight-bold text-success">Available</span></p> 
                           <p v-if="kitchen.status == 1">Status :- <span class="font-weight-bold text-danger">Booked</span></p> 
                           <p v-if="kitchen.status == 2">Status :- <span class="font-weight-bold text-info">Under Maintenance</span></p> 
                           


                        </div>
                        <div class="mt-2 pt-2 font-weight-400">
                            <p>Location :- {{kitchen.location}}</p>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="shop-add-action mb-xs-30" style="color:white!important;background:transparent!important;border:none!important;">
                <ul class="add-actions-link">
                    <li class="book github-btn">
                        <a href="#" @click.prevent="book(kitchen)" style="color:white!important;border:none!important;">Book Now</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "list_grid_view",
    props: ["kitchen"],
    data(){
      return{
          time_booked: 30,
      }
    },
    methods: {
         book(kitchen) {
            if (this.$store.getters.AUTH_STATUS === false) {
                this.$store.dispatch('logOut').then(()=>{
                      this.$router.push({
                            name: "auth.login"
                        });
                  })  
            }
         
                let payload = {
                    time_booked : this.time_booked,
                    user:this.$store.state.UserModule.user.user.name,
                    kitchen_id:kitchen.id,
                    kitchen_name:kitchen.title,

                }
                this.$store.dispatch('set_kitchen', kitchen);
                this.$store.dispatch('set_booking', payload);
                this.$router.push({
                    name: "kitchen_checkout"
                });
                
                this.$toast.success(`${kitchen.title} selected`, {
                    closeOnClick: true,
                    pauseOnFocusLoss: true,
                    pauseOnHover: false,
                    draggable: true,
                    draggablePercent: 0.6,
                    hideCloseButton: false,
                    hideProgressBar: true,
                    icon: true,
                })
            }

        },
};
</script>

<style>
</style>
