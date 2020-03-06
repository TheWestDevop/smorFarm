import {
    get,
    post
} from '../../util/api';
import uuid from 'uuid/v5';
import date from 'date-and-time';

export default {

    state: {
        user_kitchen:{
            data:{},
            pagination: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1,
            last_page: 0
          }
        },
        available_kitchen:{
            data:{},
            pagination: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1,
            last_page: 0
         }
        },
        unavailable_kitchen:{
            data:{},
            pagination: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1,
            last_page: 0
          }
        },
        kitchen:{},
        booking:{
            user:'',
            kitchen_id:'',
            kitchen_name:'',
            time_booked:'',
        },
        booking_ticket:'',
    },
    getters: {
        USER_KITCHEN : state => state.user_kitchen,
        AVAILABLE_KITCHEN: state => state.available_kitchen,
        UNAVAILABLE_KITCHEN: state => state.unavailable_kitchen,
        KITCHEN: state => state.kitchen,
        BOOKING: state => state.booking,
        BOOKING_TICKET : state => state.booking_ticket,

    },
    mutations: {
        SET_USER_KITCHEN_DATA: (state, kitchen) => {
            state.user_kitchen.data = kitchen.data;
            state.user_kitchen.pagination.total = kitchen.total;
            state.user_kitchen.pagination.per_page = kitchen.per_page;
            state.user_kitchen.pagination.last_page = kitchen.last_page;
            state.user_kitchen.pagination.from = kitchen.from;
            state.user_kitchen.pagination.to = kitchen.to;
        },
        SET_AVAILABLE_KITCHEN_DATA: (state, kitchen) => {
            state.available_kitchen.data = kitchen.data;
            state.available_kitchen.pagination.total = kitchen.total;
            state.available_kitchen.pagination.per_page = kitchen.per_page;
            state.available_kitchen.pagination.last_page = kitchen.last_page;
            state.available_kitchen.pagination.from = kitchen.from;
            state.available_kitchen.pagination.to = kitchen.to;
        },
        SET_UNAVAILABLE_KITCHEN_DATA: (state, kitchen) => {
            state.unavailable_kitchen.data = kitchen.data;
            state.unavailable_kitchen.pagination.total = kitchen.total;
            state.unavailable_kitchen.pagination.per_page = kitchen.per_page;
            state.unavailable_kitchen.pagination.last_page = kitchen.last_page;
            state.unavailable_kitchen.pagination.from = kitchen.from;
            state.unavailable_kitchen.pagination.to = kitchen.to;
        },
        SET_KITCHEN_DATA: (state, kitchen) => {
            state.kitchen = kitchen;
        },
        REMOVE_USER_KITCHEN : (state) => {
            state.user_kitchen.data = {};
            state.user_kitchen.pagination.total = 0;
            state.user_kitchen.pagination.per_page =2;
            state.user_kitchen.pagination.last_page = 0;
            state.user_kitchen.pagination.from = 1;
            state.user_kitchen.pagination.to = 0;
        },
        REMOVE_KITCHEN : (state) => {
            state.available_kitchen.data = {};
            state.available_kitchen.pagination.total = 0;
            state.available_kitchen.pagination.per_page =2;
            state.available_kitchen.pagination.last_page = 0;
            state.available_kitchen.pagination.from = 1;
            state.available_kitchen.pagination.to = 0;

            /////////

            state.unavailable_kitchen.data = {};
            state.unavailable_kitchen.pagination.total = 0;
            state.unavailable_kitchen.pagination.per_page =2;
            state.unavailable_kitchen.pagination.last_page = 0;
            state.unavailable_kitchen.pagination.from = 1;
            state.unavailable_kitchen.pagination.to = 0;

            ////////
            state.kitchen = {}
        },
        SET_BOOKING : (state,user) =>{
           state.booking.user = user.user;
           state.booking.kitchen_id = user.kitchen_id;
           state.booking.kitchen_name = user.kitchen_name;
           state.booking.time_booked = user.time_booked;
        },
        CANCEL_BOOKING : (state) =>{
            state.booking.user_token = '';
            state.booking.kitchen_id = '';
            state.booking.time_booked = '';
            state.booking.time_out = '';
         },
        SET_BOOKING_TICKET : (state,ticket) =>{
            state.booking_ticket = ticket;

         },
        EMPTY_BOOKING : (state) =>{
            state.booking.user = '';
            state.booking.kitchen_id = '';
            state.booking.kitchen_name = '';
            state.booking.time_booked = '';
            state.kitchen = {}
         },

    },
    actions: {

        get_available_kitchen : ({commit}) =>{
            get(BASE_URL + `/api/kitchen/available`)
                .then(response => {
                    commit('SET_AVAILABLE_KITCHEN_DATA', response.data);
                })
                .catch(err => {
                    console.error(err);
                    commit('REMOVE_KITCHEN');
                    console.log({error: "Something Went Wrong at fetching all available kitchen,try again."});


                });
        },
        get_unavailable_kitchen : ({commit}) =>{
            get(BASE_URL + `/api/kitchen/unavailable`)
                .then(response => {
                    commit('SET_UNAVAILABLE_KITCHEN_DATA', response.data);
                })
                .catch(err => {
                    console.error(err);
                    commit('REMOVE_KITCHEN');
                    console.log({error: "Something Went Wrong at fetching all unavailable kitchen,try again."});


                });
        },
        get_kitchen : ({commit},id) =>{
            get(BASE_URL + `/api/kitchen/${id}`)
                .then(response => {
                    commit('SET_KITCHEN_DATA', response.data);
                })
                .catch(err => {
                    console.error(err);
                    commit('REMOVE_KITCHEN');
                    console.log({error: "Something Went Wrong at fetching kitchen,try again."});


                });
        },
        set_kitchen : (context,data) =>{
            context.commit('SET_KITCHEN_DATA', data);
        },
        set_booking : (context,data) =>{
            context.commit('SET_BOOKING', data);
        },
        cancel_booking : (context) =>{
            context.commit('CANCEL_BOOKING');
        },
        book : ({commit,state}) =>{
            let id = state.user.id;


            post(BASE_URL + '/api/book/kitchen/',state.booking)
                .then(response => {
                    commit('SET_KITCHEN_DATA', response.data);
                })
                .catch(err => {
                    console.error(err);
                    commit('REMOVE_KITCHEN');
                    console.log({error: "Something Went Wrong at booking kitchen,try again."});


                });
        },
        OrderKitchen : ({commit,state}) => {
            let ticket_cost,time_out,time;
            let now = new Date();
            
             if(state.booking.time_booked == 30){
                ticket_cost = 500;
                time = date.addMinutes(now,40);
                 time_out =  date.format(time,'YYYY/MM/DD h:mm A');
                 

             }else if(state.booking.time_booked == 60){
                ticket_cost = 900;
                time = date.addMinutes(now,70);
                 time_out =  date.format(time,'YYYY/MM/DD h:mm A');
             }else if(state.booking.time_booked == 90){
                ticket_cost = 1300;
                time = date.addMinutes(now,100);
                 time_out =  date.format(time,'YYYY/MM/DD h:mm A');
             }else{
                ticket_cost = 1600;
                time = date.addHours(now,2);
                 time_out =  date.format(time,'YYYY/MM/DD h:mm A');
             }
            const NAMESPACE = '1b671a64-40d5-491e-99b0-da01ff1f3341';

            let ticket_id = 'SMOR-'+ uuid( time_out + state.booking.kitchen_name,NAMESPACE);
            console.log(time_out);
            let form = new FormData();
            form.append('user', state.booking.user);
            form.append('time_booked', state.booking.time_booked);
            form.append('time_out', time_out);
            form.append('ticket_id', ticket_id);
            form.append('ticket_cost', ticket_cost);
            form.append('kitchen_id', state.booking.kitchen_id);
            commit('SET_BOOKING_TICKET', ticket_id);
            post(BASE_URL + '/api/book/kitchen/', form)
                .then(response => {

                    commit('EMPTY_BOOKING');

                })
                .catch(err => {
                    console.error(err);


                })
        },
        updateBooking : (context) => {
            let now = new Date();
            let time_out =  date.format(now ,'YYYY/MM/DD h:mm A');
            console.log(time_out)
            let form = new FormData();
            form.append('time_out', time_out);
            post(BASE_URL + '/api/kitchen/timeout', form)
                .then(response => {
                    context.commit('SET_AVAILABLE_KITCHEN_DATA', response.data);
                })
                .catch(err => {
                    console.error(err);


                })
        },
        fetchallUserkitchen : ({commit,state},name) =>{
            let page = state.user_kitchen.pagination.current_page;
            get(BASE_URL + `/api/user/kitchen/${name}?page=${page}`)
                .then(response => {
                    commit('SET_USER_KITCHEN_DATA', response.data);
                })
                .catch(err => {
                    commit('REMOVE_USER_KITCHEN');
                    console.log({error: "Something Went Wrong at fetching all available kitchen,try again."});


                });
        }

    }

}
