<template>
  <!-- Begin Slider With Category Menu Area -->
  <div class="slider-with-banner">
    <div class="container">
      <div class="row">
        <!-- Begin Category Menu Area -->
        <div class="col-lg-3">
          <!--Category Menu Start-->
          <div class="category-menu">
            <div class="category-heading">
              <h2 class="categories-toggle">
                <span>categories</span>
              </h2>
            </div>
            <div id="cate-toggle" class="category-menu-list">
              <ul>
                <li>
                  <a href="#">Grains-Beans</a>
                </li>
                <li>
                  <a href="#">Nuts</a>
                </li>
                <li>
                  <a href="#">Tubers</a>
                </li>
                <li>
                  <a href="#">Vegetables</a>
                </li>
                <li>
                  <a href="#">Poultry</a>
                </li>
                <li>
                  <a href="#">Meat</a>
                </li>
                <li>
                  <a href="#">Fish</a>
                </li>
                <li>
                  <a href="#">Seafood</a>
                </li>
                <li class="rx-child">
                  <a href="#">Dairy</a>
                </li>
                <li class="rx-child">
                  <a href="#">Eggs</a>
                </li>
                <li class="rx-child">
                  <a href="#">Oils</a>
                </li>
                <li class="rx-child">
                  <a href="#">Fruits</a>
                </li>
                <li class="rx-child">
                  <a href="#">Spices</a>
                </li>
                <li class="rx-child">
                  <a href="#">Others</a>
                </li>
                <li class="rx-parent">
                  <a class="rx-default">More Categories</a>
                  <a class="rx-show">Less Categories</a>
                </li>
              </ul>
            </div>
          </div>
          <!--Category Menu End-->
        </div>
        <!-- Category Menu Area End Here -->
        <!-- Begin Slider Area -->
        <div class="col-lg-9">
            <Carousel :autoplay="true" :per-page="1" class="pt-sm-30 pt-xs-30">
            <Slide
             data-index="0"
             data-name="MySlideName"
             @slideclick="handleSlideClick">
              <div class="">
                  <h5>
                    Sale Offer
                    <span>-20% Off</span> This Week
                  </h5>
                  <h2>Chicken</h2>
                  <h3>
                    Starting at
                    <span>&#8358;1600.00</span>
                  </h3>
                  <div class="default-btn slide-btn text-white">
                    <a class="links" href="#">Shopping Now</a>
                  </div>
                </div>
            </Slide>
            <Slide>
             <div class="align-center-left animation-style-01 bg-5">
              
                <div class="">
                  <h5>
                    Sale Offer
                    <span>Pot Must Full</span> This Week
                  </h5>
                  <h2>Vegetables and Peppers</h2>
                  <h3>
                    Starting at
                    <span>&#8358;150.00</span>
                  </h3>
                  <div class="default-btn slide-btn text-white">
                    <a class="links" href="#">Shopping Now</a>
                  </div>
                </div>
              </div>
            </Slide>
            <Slide>
              <div class="single-slide align-center-left animation-style-02 bg-6">
                
                <div class="">
                  <h5>
                    Sale Offer
                    <span>-50% Off</span> This Week
                  </h5>
                  <h2>Fruits</h2>
                  <h3>
                    Starting at
                    <span>&#8358;100.00</span>
                  </h3>
                  <div class="default-btn slide-btn text-white">
                    <a class="links" href="#">Shopping Now</a>
                  </div>
                </div>
              
            </Slide>
          </Carousel>
          
         
        </div>
        <!-- Slider Area End Here -->
      </div>
    </div>
  </div>
  <!-- Slider With Category Menu Area End Here -->
</template>

<script>
import { Carousel, Slide } from 'vue-carousel';

export default {
  name: "carousel",
  components: {
  	Carousel,
    Slide
  },
  methods:{
    handleSlideClick(dataset){
    this.app.$route.push('/market');
  }
  }
};
</script>

<style>
</style>
