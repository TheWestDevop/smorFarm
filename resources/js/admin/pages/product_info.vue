<template>
  <div class="main-content">
    <!-- Navbar -->
       <Navbar/>

  <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
          <form >
            <div class="login-form">
              <h4 class="login-title text-center">Product Information</h4>
              <div class="row">
                <div class="col-md-6 mb-20 p-2">
                    <label>Product Image</label>
                    <img :src="`/storage/images/product/${this.product.product_image}`"  alt="product image"   class="product_img" srcset />

                </div>
                <div class="col-md-6 mb-20 p-2">

                </div>
                <br>
                <div class="col-md-6 col-12 mb-20 p-2">
                  <label><b>Product Name :</b> {{product.title}}</label>


                </div>
                <div class="col-md-6 col-12 mb-20 p-2">
                  <label><b>Price : </b>&#8358;{{product.price}}</label>
                </div>
                <div class="col-md-6 mb-20 p-2">
                  <label><b>Price Per Unit :</b>  {{product.price_per_unit}}</label>


                </div>
                <div class="col-md-6 mb-20 p-2">
                  <label><b>Discount :</b>  {{product.discount}}</label>



                </div>
                <div class="col-md-6 mb-20 p-2">
                  <label><b>Quantity :</b>  {{product.quantity}}</label>

                </div>
                <div class="col-md-6 mb-20 p-2">
                  <label><b>Product Category :</b>  {{product.category_id}}</label>


                </div>
                <div class="col-md-6 mb-20 p-2">
                    <label><b>Product Ordered Quantity :</b>  {{product.ordered_quantities}}</label>

                </div>
                <div class="col-md-6 mb-20 p-2">
                  <label><b> Is Product Made in Nigeria ? :</b>
                  <div v-if="product.made_in_nigeria == 1">
                     Yes
                  </div>
                  <div v-else>
                     No
                  </div>
                  </label>
                </div>
                <div class="col-md-6 mb-20 p-2">
                    <label ><b> Date Added :</b>   </label>
                    <div>
                        {{product.created_at}}
                    </div>
                </div>
                <div class="col-md-6 mb-20 p-2">
                    <label><b>Last Updated Date :</b>  </label>
                    <div>
                        {{product.updated_at}}
                    </div>
                </div>
                <div class="col-md-12 mb-20 p-2">
                    <label><b>Product Description</b> </label>
                  <p>
                      {{product.description}}
                  </p>
                </div>

                <div class="col-12">
                <router-link  :to="{name:'admin.product'}" class="float-left">
                  <button type="submit" class="btn btn-secondary mt-0">
                    <i class="fa fa-arrow-left"></i> Back
                  </button>
                </router-link>
                <router-link  :to="{name:'admin.edit_product', params:{id:this.id}}" class="float-right">
                  <button type="submit" class="btn btn-primary mt-0">
                    <i class="fa fa-eraser"></i> Edit Product
                  </button>
                </router-link>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
</template>

<script>
import Auth from "../util/adminAuth";
import { post, get } from "../util/api";
import Navbar from '../components/navbar'

export default {
  name: "Edit_Product",
  props: ["admin"],
   components:{
        Navbar
    },
    created(){
      this.id = this.$route.params.id;
      this.getProduct(this.id)
    },
  data() {
    return {
      id:'',
      product:{

            title: "",
            price: "",
            price_per_unit: "",
            discount: "",
            quantity: "",
            category_id: "",
            description: "",
            product_image: "",
            made_in_nigeria:"",
            updated_at:'',
            created_at:'',
            ordered_quantities:''

      }
    };
  },
  methods: {

    getProduct(id){
        let $this = this;
        get(BASE_URL + `/api/product/${id}`).then(function(response) {
          
          if (response.data) {

          $this.product.title = response.data.title;
          $this.product.price =  response.data.price;
          $this.product.price_per_unit=response.data.price_per_unit;
          $this.product.discount=response.data.discount;
          $this.product.quantity=response.data.quantity;
          $this.product.category_id=response.data.category_id;
          $this.product.product_image = response.data.product_image;
          $this.product.description = response.data.description;
          $this.product.made_in_nigeria = response.data.made_in_nigeria
          $this.product.created_at = response.data.created_at;
          $this.product.updated_at = response.data.updated_at;
          $this.product.ordered_quantities = response.data.ordered_quantities;
          }
        });
    },


  },

};
</script>

<style>
</style>

