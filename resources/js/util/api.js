import axios from 'axios';
import Auth from './store';

export function post(url, data) {

    return axios({
        method: 'POST',
        url: url,
        data: data,
        headers: {
            'Authorization': `Bearer ${Auth.state.api_token}`
        }
    });
}
export function get(url, data) {

    return axios({
        method: 'GET',
        url: url,
        data: data,
        headers: {
            'Authorization': `Bearer ${Auth.state.api_token}`,
            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });
}
