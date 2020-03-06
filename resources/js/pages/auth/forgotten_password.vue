<template>
    <!-- Begin Login Content Area -->
    <div class="page-section mb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                    <!-- Login Form -->
                    <form v-on:submit.prevent="reset">
                        <div class="login-form">
                            <h4 class="login-title">Password Reset</h4>
                            <div class="mt-2 p-2 font-italic text-danger">{{errorMsg}}</div>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email Address</label>
                                    <input class="mb-0" type="email" v-model="email" placeholder="Email Address" v-bind:class="{'is-invalid':errorEmail}" />
                                    <div  class="mt-2 p-2 font-italic text-danger">{{errorEmail}}</div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button type="submit" class="register-button mt-0">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content Area End Here -->
</template>

<script>
import Flash  from  '../../util/flash';
import Auth from '../../util/store';
import { post } from "../../util/api";
export default {
    name: 'Reset',
    props: ['app'],
    data() {
        return {
            email: '',
            errorEmail: '',
            errorMsg: '',
            errors: [],
        }
    },
    methods: {
        reset() {
            this.errors = [];
            if (this.email.length < 5 && this.email === '') {
                this.errorEmail = "Invalid Email";
                this.errors.push(this.errorEmail);
            } else {
                this.errorEmail = null;
            }

            if (!this.errors.length) {
                 let $this = this;

                let data = {
                    email: this.email,
                }

                $this.app.spin =true;
                $this.$toast.info('Password reset link have been sent to your registered email!',{
                                position:'bottom-center',
                                timeout:10000,
                                closeOnClick:true,
                                pauseOnFocusLoss:true,
                                pauseOnHover:false,
                                draggable:true,
                                draggablePercent:0.6,
                                hideCloseButton:false,
                                hideProgressBar:true,
                                icon:true,})
                $this.app.$router.push({
                            name: "auth.login"
                        });
                $this.app.spin = false;

            }
        }
    },


};
</script>

<style scoped>



</style>
