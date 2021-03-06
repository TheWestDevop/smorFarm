export default {

    state: {
        success: null,
        error: null
    },
    setSuccess(message) {

        this.state.success = message;
        setTimeout(() => {
            this.removeSuccess();
        }, 5000);

    },
    setError(message) {
        this.state.error = message;
        setTimeout(() => {
            this.removeError();
        }, 10000);
    },
    setSuccessOrder(message) {

        this.state.success = message;
        setTimeout(() => {
            this.removeSuccess();
        }, 30000);

    },
    removeSuccess() {
        this.state.success = null;
    },
    removeError() {
        this.state.error = null;
    }
}
