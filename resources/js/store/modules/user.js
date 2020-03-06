import {
    get,
    post
} from '../../util/api';
import axios from 'axios';

export default {

    state: {
        user: JSON.parse(localStorage.getItem('user')) || [],
        user_token: localStorage.getItem('token') || '',
        status: JSON.parse(localStorage.getItem('status')) || false,
        notification:[],
        
    },
    getters: {
        USER: state => state.user,
        IS_AUTHENTICATED: state => !!state.token,
        AUTH_STATUS: state => state.status,
        TOKEN:state =>state.token,
        NOTIFICATION: state => state.notification,
        NOTIFICATION_BADGE: state => state.notification.length,
        

    },
    mutations: {
        SET_USER_DATA: (state, user) => {
            state.user = user;
            localStorage.setItem('user', JSON.stringify(user));
        },
        REMOVE_USER_DATA: (state) => {
            state.user = [];
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            localStorage.removeItem('status');
            state.user_token = '';
            state.status = false;
        },
        REMOVE_FAST_USER_DATA: (state) => {
            state.temp_user = [];
        },
        AUTH_SUCCESS: (state, token) => {
            localStorage.setItem('token', token);
            localStorage.setItem('status', true);
            state.user_token = token;
            state.status = true;
        },  
        USER_NOTIFICATION : (state, message) => {
          state.notification = message ;
        },

        REMOVE_NOTIFICATION : (state) => {
            state.notification = [];
        },
        

    },
    actions: {
        auth: (context) => {
            return new Promise((resolve, reject) => {
                get(BASE_URL + `/api/auth/init/`)
                    .then(response => {
                        if (response.data.user.id) {
                            context.commit('SET_USER_DATA', response.data);
                            context.commit('AUTH_SUCCESS', response.data.user.api_token);
                            resolve(response);
                        } 

                    })
                    .catch(err => {
                        console.error(err);
                        context.commit('REMOVE_USER_DATA');
                        reject(err);

                    })
            });
        },
        login: (context, data) => {
            context.commit('SET_USER_DATA',data);
            context.commit('AUTH_SUCCESS', data.user.api_token);         
        },
        register: (context, user) => {
                            context.commit('SET_USER_DATA', user);
                            context.commit('AUTH_SUCCESS', user.user.api_token);

        },
        logOut: (context) => {
            return new Promise((resolve, reject) => {
                get(BASE_URL + `/api/auth/logout`)
                    .then(() => {
                        context.commit('REMOVE_USER_DATA');
                        delete axios.defaults.headers.common['Authorization'];
                        resolve();
                    });
                }); 
        },
        get_notification : ({commit,state}) =>{
            let id = state.user.id;
            get(BASE_URL + `/api/user/${id}/notification`)
                .then(response => {
                    commit('USER_NOTIFICATION', response.data);     
                })
                .catch(err => {
                    console.error(err);
                    commit('REMOVE_NOTIFICATION', response.data);
                    console.log({error: "Something Went Wrong at fetching all user notification,try again."});
                    

                });
        },
        set_notification : ({commit,state},message) =>{
            let id = state.user.id;
            let form = new FormData();
                form.append('message', message);
                form.append('user_id', id);
            post(BASE_URL + `/api/create/notification/`, form)
                .then(response => {
                         
                })
                .catch(err => {
                    console.error(err);

                    console.log({error: "Something Went Wrong at fetching all user notification,try again."});
                    

                });
        },
        notificationSeen : ({commit,state}) =>{
            let id = state.user.id;
            get(BASE_URL + `/api/update/notification/${id}`)
                .then(response => {   
                   
                })
                .catch(err => {
                    console.error(err);
                    commit('REMOVE_NOTIFICATION', response.data);
                    console.log({error: "Something Went Wrong at fetching all user notification,try again."});
                    

                });
        },
        update_user : ({commit,state}, user) => {
            let id = state.user.user.id;
            return new Promise((resolve, reject) => {
                post(BASE_URL + `/api/user/update/${id}`, user)
                    .then(response => {
                        resolve(response)
                    })
                    .catch(err => {
                        console.error(err);
                        context.commit('REMOVE_USER_DATA');
                        reject(err);

                    })
            });

},

    }

}
