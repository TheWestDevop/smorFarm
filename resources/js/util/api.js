import axios from 'axios';



export function post(url, data) {

    return axios({
        method: 'POST',
        url: url,
        data: data,
        headers: {
            'Authorization': `Bearer ` + localStorage.getItem('token') || '' ,
            'X-CSRF-TOKEN' : myToken
        }
    });
}
export function get(url, data) {

    return axios({
        method: 'GET',
        url: url,
        data: data,
        headers: {
            'Authorization': `Bearer ` + localStorage.getItem('token') || '',
        }
    });
}
