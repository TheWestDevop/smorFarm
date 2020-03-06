import { get } from '../../util/api';

export default {

    state:{
      products:{
          data:[],
          pagination: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1,
            last_page: 0
        }
      },
      latest_products:[],
      discount_products:[],
      trending_products:[],
      category_products:[],
      single_product:[],
      data_loading:false
    },
    getters:{
        ALL_PRODUCT: state => {
            return state.products;
          },
        LATEST_PRODUCT: state => {
          return state.latest_products;
        },
        DISCOUNT_PRODUCT: state => {
            return state.discount_products;
        },
        TRENDING_PRODUCT:state => {
            return state.trending_products;
        },
        CATEGORY_PRODUCT: state => {
            return state.category_products;
          },
        SINGLE_PRODUCT: state => {
            return state.single_product;
          },
        DATA_LOADING:state =>{
            return state.data_loading;
        }

    },
    mutations:{
      Set_All_Products : (state,products) => {
        state.products.data = products.data;
        state.products.pagination.total = products.total;
        state.products.pagination.per_page = products.per_page;
        state.products.pagination.last_page = products.last_page;
        state.products.pagination.from = products.from;
        state.products.pagination.to = products.to;
      },
      Set_Latest_Products :(state,products) => {
        state.latest_products = products;
      },
      Set_Discount_Products :(state,products) => {
        state.discount_products = products;
      },
      Set_Trending_Products :(state,products) => {
        state.trending_products = products;
      },
      Set_Category_Products :(state,products) => {
         state.category_products = products;
      },
      Set_Single_Product :(state,product) => {
        state.single_product = product;
      },
      Set_Data_Loading :(state,option) => {
        state.data_loading = option;
      },

    },
    actions:{
        fetchAllProduct : ({commit,state}) => {
         let page = state.products.pagination.current_page;
        get(BASE_URL + `/api/all/products/?page=${page}`)
         .then(response => {
              commit('Set_All_Products',response.data);

          })
          .catch(err => {
           console.error(err);
           return {error:"Something Went Wrong at fetching all products,try again."};

          })
        },
        fetchLatestProduct : ( context ) => {
            get(BASE_URL + '/api/latest/products')
            .then(response => {
                 context.commit('Set_Latest_Products',response.data);
             })
             .catch(err => {
              console.error(err);
              return {error:"Something Went Wrong while fetching latest products,try again."};
             });
        },
        fetchDiscountProduct : ( context ) => {
            get(BASE_URL + '/api/all/products/low/discount')
            .then(response => {
                 context.commit('Set_Discount_Products',response.data);
             })
             .catch(err => {
              console.error(err);
              return {error:"Something Went Wrong while fetching discount products,try again."};
             });
        },
        fetchTrendingProduct : ( context ) => {

            get(BASE_URL + '/api/all/trending/products')
            .then(response => {
                 context.commit('Set_Trending_Products',response.data);
                 context.commit('Set_Data_Loading',false);
             })
             .catch(err => {
              console.error(err);
              return {error:"Something Went Wrong while fetching trending products,try again."};
             });
        },
        fetchCategoryProduct : ( context,id ) => {
            get(BASE_URL + `/api/all/products/category/${id}`)
            .then(response => {
                 context.commit('Set_Category_Products',response.data);
             })
             .catch(err => {
              console.error(err);
              return {error:"Something Went Wrong while fetching product from this category ,try again."};
             });
        },
        fetchSingleProduct : ( context,id) => {
            get(BASE_URL + `/api/product/${id}`)
            .then(response => {
                 context.commit('Set_Single_Product',response.data);
             })
             .catch(err => {
              console.error(err);
              return {error:"Something Went Wrong while fetching this product ,try again."};
             });
        },
        spinner : ( context,option) => {
            
                 context.commit('Set_Data_Loading',option);
            
        },

    }

}