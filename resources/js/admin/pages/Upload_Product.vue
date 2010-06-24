<template>
  <div class="main-content">
    <!-- Navbar -->
       <Navbar/>

  <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="alert alert-success text-center w-50 mx-auto" v-if="flash.success">
            {{flash.success}}
            </div>
            <div class="alert alert-danger text-center  w-50 mx-auto" v-if="flash.error">
            {{flash.error}}
           </div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
          <form v-on:submit.prevent="onUpload">
            <div class="login-form">
              <h4 class="login-title text-center">Adding New Product </h4>
              <div class="row">
                <div class="col-md-6 mb-20"></div>
                <div class="col-md-6 mb-20">
                  <label>Product Image</label>
                  <input
                    type="file"
                    name="product_image"
                    accept="image/*"

                    @change="getImage"
                  />
                  <div class="mt-2 p-2 font-italic text-danger">{{errorImage}}</div>
                  <div v-if="img" class="mr-5">
                    <img :src="avatar" alt="product image"   class="product_img" srcset />
                  </div>
                </div>
                <div class="col-md-6 col-12 mb-20">
                  <label>Title</label>
                  <input class="mb-0" type="text" v-model="title" placeholder="Product Title" />
                  <div class="mt-2 p-2 font-italic text-danger">{{errorTitle}}</div>
                </div>
                <div class="col-md-6 col-12 mb-20">
                  <label>Price</label>
                  <input class="mb-0" type="text" v-model="price" placeholder="Product Price" />
                  <div class="mt-2 p-2 font-italic text-danger">{{errorPrice}}</div>
                </div>
                <div class="col-md-6 mb-20">
                  <label>Price Per Unit</label>
                  <input
                    class="mb-0"
                    type="text"
                    v-model="price_per_unit"
                    placeholder="Price Per Unit"
                  />

                </div>
                <div class="col-md-6 mb-20">
                  <label>Discount</label>
                  <input class="mb-0" type="text" v-model="discount" placeholder="Product Discount" />
                  <div class="mt-2 p-2 font-italic text-danger">{{errorDiscount}}</div>
                </div>
                <div class="col-md-6 mb-20">
                  <label>Quantity</label>
                  <input
                    class="mb-0"
                    type="text"
                    v-model="quantity"
                    placeholder="Product Quantity"

                  />
                  <div class="mt-2 p-2 font-italic text-danger">{{errorQuantity}}</div>
                </div>
                <div class="col-md-6 mb-20">
                  <label>Product Category</label>
                  <select
                    v-model="category_id"
                  >
                    <option v-for="category in admin.categories"
                    :key="category.id"  >{{category.title}}</option>
                  </select>
                  <div class="mt-2 p-2 font-italic text-danger">{{errorCategory}}</div>
                </div>
                <div class="col-md-6 mb-20"></div>
                <div class="col-md-6 mb-20">
                  <label>Is Product Made in Nigeria ?</label>
                  <select
                    v-model="made_in_nigeria"
                  >
                  <option value="">--------------------</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
                  <div class="mt-2 p-2 font-italic text-danger">{{errorMadeInNigeria}}</div>
                </div>
                <div class="col-md-12 mb-20">
                    <label>Product Description</label>
                  <textarea name="description" v-model="description" class=" form-control w-100"></textarea>
                </div>
                <div class="mt-2 p-2 font-italic text-danger">{{errorDescription}}</div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block mt-0">
                    <i class="fa fa-upload"></i> Upload
                  </button>
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
import Flash from "../../util/flash";
import Auth from "../util/Auth";
import { post, get } from "../util/api";
import Navbar from '../components/navbar'

export default {
  name: "Upload_Product",
  props: ["admin"],
   components:{
        Navbar
    },
  data() {
    return {
      title: "",
      price: "",
      price_per_unit: "",
      discount: "",
      quantity: "",
      flash:Flash.state,
      category_id: "",
      description: "",
      product_image: "",
      made_in_nigeria:"",
      avatar: "",
      img: false,
      errorTitle: "",
      errorPrice: "",
      errorQuantity: "",
      errorCategory: "",
      errorDiscount:"",
      errorDescription:"",
      errorImage: "",
      errorMadeInNigeria:"",
      errors: []
    };
  },
  created(){
     /* let $this = this;
      if(Auth.state.api_token === ''|| Auth.state.api_token === null
       && Auth.state.admin_id === '' || Auth.state.admin_id === null) {

       }*/
  },
  methods: {
    onUpload() {
      this.errors = [];

      if (this.title.length < 1 && this.title === "") {
        this.errorTitle = "Title is Required";
        this.errors.push(this.errorTitle);
      } else {
        this.errorTitle = null;
      }
      if (this.price.length < 2 && this.price === 0 || this.price === "" ) {
        this.errorPrice = "Price is Required";
        this.errors.push(this.errorPrice);
      } else {
        this.errorPrice = null;
      }
      if (this.quantity.length < 2 && this.quantity < 10) {
        this.errorQuantity =
          "Product Quantity is required and can't be less than 10";
        this.errors.push(this.errorQuantity);
      } else {
        this.errorQuantity = null;
      }
      if (this.discount == "") {
        this.errorDiscount =
          "Product Discount is required ";
        this.errors.push(this.errorDiscount);
      } else {
        this.errorDiscount = null;
      }
      if (this.made_in_nigeria == "") {
        this.errorMadeInNigeria =
          "Is Product Made In Nigeria?";
        this.errors.push(this.errorMadeInNigeria);
      } else {
        this.errorMadeInNigeria = null;
      }

      if (this.description == "") {
        this.errorDescription =
          "Product Description is required ";
        this.errors.push(this.errorDescription);
      } else {
        this.errorDescription = null;
      }

      if (this.category_id == 0) {
        this.errorCategory = "Product Category is required";
        this.errors.push(this.errorCategory);
      } else {
        this.errorCategory = null;
      }
      if (!this.img) {
        this.errorImage = "Product Image is required";

        this.errors.push(this.errorImage);
      } else {
        this.errorImage = null;
      }

      if (!this.errors.length) {

        let $this = this;

       let form = new FormData();
       form.append('title',$this.title)
       form.append('price',$this.price)
       form.append('price_per_unit',$this.price_per_unit)
       form.append('discount',$this.discount)
       form.append('quantity',$this.quantity)
       form.append('category_id',$this.category_id)
       form.append('description',$this.description)
       form.append('image',$this.product_image)
       form.append('made_in_nigeria',$this.made_in_nigeria)
       let data = form
        post(BASE_URL + "/api/new/product", data).then(function(response) {
          console.log(response.data);
          if (response.data.message) {
          Flash.setSuccess("You have successfully upload new product to SmorFarm!");

          $this.title = '';
          $this.price =  '';
          $this.price_per_unit='';
          $this.discount='';
          $this.quantity='';
          $this.category_id='';
          $this.discription='';
          $this.avatar= '';
          $this.product_image = '';
          $this.img = false;
          $this.description = '';

          } else{
            Flash.setError("You are Unauthorized!!!");

          }
        });
      }
    },
    getImage(e) {
      let image = e.target.files[0];
      this.product_image = e.target.files[0];
      this.read(image);
    },
    read(image) {
      let reader = new FileReader();
      reader.readAsDataURL(image);
      this.img = true;
      reader.onload = e => {
        this.avatar = e.target.result;
      };
    },


  },

};
</script>

<style>
</style>
