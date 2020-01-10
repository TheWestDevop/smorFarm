export default {

    state: {
        
        admin_api_token: null,
        admin_id: null
    },
    init() {
        this.state.api_token = localStorage.getItem('admin_api_token');
        this.state.admin_id = parseInt(localStorage.getItem('admin_id'));
    },
    set(api_token, admin_id) {

        localStorage.setItem('admin_api_token', api_token);
        localStorage.setItem('admin_id', admin_id);
        this.init();
    },
    remove() {
        localStorage.removeItem('admin_api_token');
        localStorage.removeItem('admin_id');
        this.init();
    }

}
