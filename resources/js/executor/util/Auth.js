export default {

    state: {

        executor_api_token: null,
        executor_id: null
    },
    init() {
        this.state.api_token = localStorage.getItem('executor_api_token');
        this.state.executor_id = parseInt(localStorage.getItem('executor_id'));
    },
    set(api_token, executor_id) {

        localStorage.setItem('executor_api_token', api_token);
        localStorage.setItem('executor_id', executor_id);
        this.init();
    },
    remove() {
        localStorage.removeItem('executor_api_token');
        localStorage.removeItem('executor_id');
        this.init();
    }

}
