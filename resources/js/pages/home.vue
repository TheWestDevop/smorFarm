<template>
    <div class="pt-20">
     <Carousel/>
     <Hot_Deals />
     <Banner_Product />
     <Two_Banner />
     <Banner />
     <Trending /> 
    </div>
</template>

<script>
import Carousel from '../components/carousel'
import Trending from '../components/product/trending_product'
import Hot_Deals from '../components/product/hot_deals'
import Banner from "../components/banner/banner";
import Banner_Product from "../components/banner/banner_product";



export default {
    name: 'home',
    components:{
      Carousel,
      Banner,
      Banner_Product,
      Trending,
      Hot_Deals
    }
    

}
</script>

<style>

</style>
