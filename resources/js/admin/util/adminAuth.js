export default {

    state: {
        api_token: null,
        admin_id: null
    },
    init() {
        this.state.api_token = localStorage.getItem('api_token');
        this.state.admin_id = parseInt(localStorage.getItem('admin_id'));
    },
    set(api_token, admin_id) {
        localStorage.setItem('api_token', api_token);
        localStorage.setItem('admin_id', admin_id);
        this.init();
    },
    remove() {
        localStorage.removeItem('api_token');
        localStorage.removeItem('admin_id');
        this.init();
    }

}
