<template>
<div class="card" style="width:15rem">
 <img :src="`/storage/images/product/${product.product_image}`" alt="product image"  class="card-img-top  image">
 <div class="card-body">
    <strong class="card-title h5">{{product.title}}</strong>
    <p class="new-price m-2">&#8358; {{product.price}}</p>
    <div class="add-action mt-5 ">
        <ul class="add-actions-link">
        <li class="add-cart "><div class="text-center "   @click="addCart(product)">Add to cart <i class="fa fa-cart-plus"></i></div></li>
        </ul>
    </div>
 </div>
</div>
</template>

<script>
export default {
 name:"Product",
 props:{
 product:Object,
 app:Object
 },
 data() {
        return {
            quantity:1
        };
    },
     created(){
     this.viewCart();
    },
  methods: {

        addCart(product){
          let $this =  this;
          if ($this.app.cart.some(item => item.id === product.id)) {

            return $this.$toast.warning('Product added already',{
              position:'bottom-center',
              timeout:1000,
              closeOnClick:true,
              pauseOnFocusLoss:true,
              pauseOnHover:false,
              draggable:true,
              draggablePercent:0.6,
              hideCloseButton:false,
              hideProgressBar:true,
              icon:true,
              })


          }else{

          $this.app.cartadd.id = product.id;
          $this.app.cartadd.name = product.title;
          $this.app.cartadd.price = product.price;
          $this.app.cartadd.image = product.product_image;
          $this.app.cartadd.quantity = this.quantity;
          $this.app.cart.push($this.app.cartadd);
          $this.app.cartadd = {}
          this.quantity=1;

          this.storeCart();
              $this.$toast.success('Product was successfully added to cart' ,{
              position:'bottom-center',
              timeout:1000,
              closeOnClick:true,
              pauseOnFocusLoss:true,
              pauseOnHover:false,
              draggable:true,
              draggablePercent:0.6,
              hideCloseButton:false,
              hideProgressBar:true,
              icon:true,
              })

          }
        },
        storeCart(){
            let $this =  this;
           let parsed =  JSON.stringify($this.app.cart);
           localStorage.setItem('cart',parsed);
           this.viewCart();
        },
        viewCart(){
            let $this =  this;
          if(localStorage.getItem('cart')){
              $this.app.cart = JSON.parse(localStorage.getItem('cart'));
              $this.app.badge = $this.app.cart.length;
              $this.app.totalprice = $this.app.cart.reduce((total,item)=>{
                      return total + item.quantity * item.price;
              },0);
          }

        },


    }
}
</script>

<style>

</style>
