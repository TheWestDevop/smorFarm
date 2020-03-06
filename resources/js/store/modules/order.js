import {
    get,
    post
} from '../../util/api';

export default {

    state: {
        all_user_order:{
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
        all_user_pre_order: {
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
        pre_order: {},
        order_status: [],
        cart: [],
        service_charge: {
            delivery: 500,
            service_charge: 25,
            service_tax: 25,
            vat: 10.00,
        },
        deliverTo: {
            name: '',
            address: '',
            apartment: '',
            email: '',
            phone: '',
            note: '',
        },
        temp_user: {
            name: '',
            address: '',
            apartment: '',
            email: '',
            phone: '',
        },
        total: 0,
        sub_total: 0,
        order_ticket: '',
        token: localStorage.getItem('token') || '',
        isPreOrder:false,
        wishlist:[],
    },
    getters: {
        IS_PREORDER: state => state.isPreOrder,
        FAST_USER: state => state.temp_user,
        TICKET: state => state.order_ticket,
        ALL_USER_ORDER: state => {
            return state.all_user_order;
        },
        ALL_USER_PRE_ORDER: state => {
            return state.all_user_pre_order;
        },
        ORDER_STATUS: state => {
            return state.order_status;
        },
        CART: state => {
            return state.cart;
        },
        CART_TOTAL: state => {
            return state.sub_total;
        },
        CART_BADGE: state => {
            return state.cart.length;
        },
        WISHLIST: state => {
            return state.wishlist;
        },
        ALL_SERVICE_CHARGE: state => {
            return state.service_charge;
        },
        TOTAL: state => {
            return state.sub_total + state.service_charge.delivery + state.service_charge.service_charge + state.service_charge.service_tax + state.service_charge.vat;
        },


    },
    mutations: {
        SET_All_USER_ORDER: (state, order) => {
            state.all_user_order.data = order.data;
            state.all_user_order.pagination.total = order.total;
            state.all_user_order.pagination.per_page = order.per_page;
            state.all_user_order.pagination.last_page = order.last_page;
            state.all_user_order.pagination.from = order.from;
            state.all_user_order.pagination.to = order.to;
        },
        ADD_USER_ORDER: (state, order) => {
            state.all_user_order.push(order);
        },
        SET_All_USER_PRE_ORDER: (state, order) => {
            state.all_user_pre_order.data = order.data;
            state.all_user_pre_order.pagination.total = order.total;
            state.all_user_pre_order.pagination.per_page = order.per_page;
            state.all_user_pre_order.pagination.last_page = order.last_page;
            state.all_user_pre_order.pagination.from = order.from;
            state.all_user_pre_order.pagination.to = order.to;
        },
        ADD_USER_PRE_ORDER: (state, order) => {
            state.all_user_pre_order.push(order);
        },
        SET_ORDER_STATUS: (state, order) => {
            state.order_status = order;
        },
        GET_CART_ITEM: (state) => {
            if (localStorage.getItem('cart')) {
                state.cart = JSON.parse(localStorage.getItem('cart'));
                state.sub_total = state.cart.reduce((total, item) => {
                    return total + item.quantity * item.price;
                }, 0);
            }
        },
        EMPTY_CART: (state) => {
            localStorage.removeItem('cart');
            state.cart = [];
            state.sub_total = 0;
            state.total = 0;
        },
        SET_CART_ITEM: (state, product) => {
            let cartItem = {
                id: '',
                name: '',
                price: '',
                image: '',
                quantity: '',
            };
            cartItem.id = product.id;
            cartItem.name = product.title;
            cartItem.price = product.price;
            cartItem.image = product.product_image;
            cartItem.quantity = 1;
            state.cart.push(cartItem);
            state.sub_total = state.cart.reduce((total, item) => {
                return total + item.quantity * item.price;
            }, 0);
            let parsed = JSON.stringify(state.cart);
            localStorage.setItem('cart', parsed);
        },
        REMOVE_CART_ITEM: (state, product) => {
            state.cart.splice(product, 1);
            state.sub_total = state.cart.reduce((total, item) => {
                return total + item.quantity * item.price;
            }, 0);
            let parsed = JSON.stringify(state.cart);
            localStorage.setItem('cart', parsed);

        },
        DECREASE_CART_ITEM_QUANTITY: (state, product) => {
            if (state.cart[product].quantity === 1) {
                return;
            }
            state.cart[product].quantity -= 1;
            state.sub_total = state.cart.reduce((total, item) => {
                return total + item.quantity * item.price;
            }, 0);
            let parsed = JSON.stringify(state.cart);
            localStorage.setItem('cart', parsed);
        },
        INCREASE_CART_ITEM_QUANTITY: (state, product) => {
            state.cart[product].quantity += 1;
            state.sub_total = state.cart.reduce((total, item) => {
                return total + item.quantity * item.price;
            }, 0);
            let parsed = JSON.stringify(state.cart);
            localStorage.setItem('cart', parsed);
        },
        PRE_ORDER_INFO: (state, info) => {
            state.pre_order.date = info.date;
            state.pre_order.time = info.time;
            state.isPreOrder = true;

        },
        ORDER_OWNER: (state, data) => {
            state.deliverTo = data;

        },
        FAST_USER: (state, data) => {
            state.temp_user = data;
        },
        ORDER_TICKET: (state, data) => {
            state.order_ticket = data;
        },
        GET_WISHLIST_ITEM : (state) => {
            if (localStorage.getItem('wishlist')) {
                state.wishlist = JSON.parse(localStorage.getItem('wishlist'));
            }
        },
        EMPTY_WISHLIST: (state) => {
            localStorage.removeItem('wishlist');
            state.wishlist = [];
        },
        SET_WISHLIST_ITEM: (state, product) => {
            
            state.wishlist.push(product);

            let parsed = JSON.stringify(state.wishlist);
            localStorage.setItem('wishlist', parsed);
        },
        REMOVE_WISHLIST_ITEM: (state, product) => {
            state.wishlist.splice(product, 1);
            let parsed = JSON.stringify(state.wishlist);
            localStorage.setItem('wishlist', parsed);

        },

    },
    actions: {
        fastUser: (context, data) => {
            context.commit('FAST_USER', data);
        },
        fetchAllUserOrder: ({commit,state}, id) => {
            let page = state.all_user_order.pagination.current_page;
            get(BASE_URL + `/api/user/${id}/order?page=${page}`)
                .then(response => {
                    commit('SET_All_USER_ORDER', response.data);

                })
                .catch(err => {
                    console.error(err);
                    return {
                        error: "Something Went Wrong at fetching all user order,try again."
                    };

                })
        },
        fetchAllUserPreOrder: ({commit,state}, id) => {
            let page = state.all_user_pre_order.pagination.current_page;
            get(BASE_URL + `/api/user/${id}/pre/order?page=${page}`)
                .then(response => {
                    commit('SET_All_USER_PRE_ORDER', response.data);

                })
                .catch(err => {
                    console.error(err);
                    return {
                        error: "Something Went Wrong at fetching all user pre order,try again."
                    };

                })
        },
        fetchOrderStatus: (context, id) => {
            get(BASE_URL + `/api/order/verify/${id}/`)
                .then(response => {
                    context.commit('SET_ORDER_STATUS', response.data);

                })
                .catch(err => {
                    console.error(err);
                    return {
                        error: "Something Went Wrong at fetching all user order,try again."
                    };

                })
        },
        userOrder: ({commit,state,getters}) => {

            let form = new FormData();
            form.append('token', state.token);
            form.append('cart', JSON.stringify(getters.CART));
            form.append('total', getters.TOTAL);
            form.append('name', state.deliverTo.name);
            form.append('address', state.deliverTo.address);
            form.append('apartment', state.deliverTo.apartment);
            form.append('email', state.deliverTo.email);
            form.append('phone', state.deliverTo.phone);
            form.append('note', state.deliverTo.note);



            post(BASE_URL + '/api/user/order/', form)
                .then(response => {
                    commit('ORDER_TICKET', response.data);
                    commit('EMPTY_CART');

                })
                .catch(err => {
                    console.error(err);


                })


        },
        userPreOrder: ({commit,state,getters}) => {

            let form = new FormData();
            form.append('token', state.token);
            form.append('cart', JSON.stringify(getters.CART));
            form.append('total', getters.TOTAL);
            form.append('delivery_date', state.pre_order.date);
            form.append('delivery_time', state.pre_order.time);
            form.append('name', state.deliverTo.name);
            form.append('address', state.deliverTo.address);
            form.append('apartment', state.deliverTo.apartment);
            form.append('email', state.deliverTo.email);
            form.append('phone', state.deliverTo.phone);
            form.append('note', state.deliverTo.note);

            return new Promise((resolve, reject) => {
                post(BASE_URL + '/api/user/pre/order/', form)
                    .then(response => {
                        commit('ORDER_TICKET', response.data);
                        commit('EMPTY_CART');
                        resolve(response);
                    })
                    .catch(err => {
                        console.error(err);
                        reject(err);

                    })
            });

        },
        fastOrder: ({commit,state,getters}) => {
            let data = {
                token: state.user_token,
                cart: JSON.stringify(getters.CART),
                total: getters.TOTAL,
                name_2: state.deliverTo.name,
                address_2: state.deliverTo.address,
                apartment_2: state.deliverTo.apartment,
                email_2: state.deliverTo.email,
                phone_2: state.deliverTo.phone,
                note_2: state.deliverTo.note,
                name: state.temp_user.name,
                gender: state.temp_user.gender,
                address: state.temp_user.address,
                apartment: state.temp_user.apartment,
                email: state.temp_user.email,
                phone: state.temp_user.phone,
            };
            return new Promise((resolve, reject) => {
                post(BASE_URL + '/api/order/', data)
                    .then(response => {
                        commit('ORDER_TICKET', response.data);
                        commit('EMPTY_CART');
                        resolve(response);
                    })
                    .catch(err => {
                        console.error(err);
                        commit('REMOVE_FAST_USER_DATA');
                        reject(err);

                    })
            });
        },
        deliverTo: (context, data) => {
            context.commit('ORDER_OWNER', data);
        },
        GetCartItem: (context) => {
            context.commit('GET_CART_ITEM');
        },
        AddCartItem: (context, item) => {
            context.commit('SET_CART_ITEM', item);
            item = "";
        },
        RemoveCartItem: (context, item) => {
            context.commit('REMOVE_CART_ITEM', item);
        },
        GetWishListItem: (context) => {
            context.commit('GET_WISHLIST_ITEM');
        },
        EmptyWishListItem: (context) => {
            context.commit('EMPTY_WISHLIST');
        },
        AddWishListItem: (context, item) => {
            context.commit('SET_WISHLIST_ITEM', item);
            item = "";
        },
        RemoveWishListItem: (context, item) => {
            context.commit('REMOVE_WISHLIST_ITEM', item);
        },
        DecreaseCartItemQuantity: (context, item) => {
            context.commit('DECREASE_CART_ITEM_QUANTITY', item);
        },
        IncreaseCartItemQuantity: (context, item) => {
            context.commit('INCREASE_CART_ITEM_QUANTITY', item);
        },
        preOrderDeliveryInfo: (context, item) => {
            context.commit('PRE_ORDER_INFO', item);
            
        },


    }

}
