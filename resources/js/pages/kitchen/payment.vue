<template>
    <div class="card-form">
        <div class="card-list">
            <div class="card-item" v-bind:class="{ '-active' : isCardFlipped }">
                <div class="card-item__side -front">
                    <div class="card-item__focus" v-bind:class="{'-active' : focusElementStyle }" v-bind:style="focusElementStyle" ref="focusElement"></div>
                    <div class="card-item__cover">
                        <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'" class="card-item__bg" />
                    </div>

                    <div class="card-item__wrapper">
                        <div class="card-item__top">
                            <img src="https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/chip.png" class="card-item__chip" />
                            <div class="card-item__type">
                                <transition name="slide-fade-up">
                                    <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'" v-if="getCardType" v-bind:key="getCardType" alt class="card-item__typeImg" />
                                </transition>
                            </div>
                        </div>
                        <label for="cardNumber" class="card-item__number" ref="cardNumber">
                            <template v-if="getCardType === 'amex'">
                                <span v-for="(n, $index) in amexCardMask" :key="$index">
                                    <transition name="slide-fade-up">
                                        <div class="card-item__numberItem" v-if="$index > 4 && $index < 14 && cardNumber.length > $index && n.trim() !== ''">*</div>
                                        <div class="card-item__numberItem" :class="{ '-active' : n.trim() === '' }" :key="$index" v-else-if="cardNumber.length > $index">{{cardNumber[$index]}}</div>
                                        <div class="card-item__numberItem" :class="{ '-active' : n.trim() === '' }" v-else :key="$index + 1">{{n}}</div>
                                    </transition>
                                </span>
                            </template>

                            <template v-else>
                                <span v-for="(n, $index) in otherCardMask" :key="$index">
                                    <transition name="slide-fade-up">
                                        <div class="card-item__numberItem" v-if="$index > 4 && $index < 15 && cardNumber.length > $index && n.trim() !== ''">*</div>
                                        <div class="card-item__numberItem" :class="{ '-active' : n.trim() === '' }" :key="$index" v-else-if="cardNumber.length > $index">{{cardNumber[$index]}}</div>
                                        <div class="card-item__numberItem" :class="{ '-active' : n.trim() === '' }" v-else :key="$index + 1">{{n}}</div>
                                    </transition>
                                </span>
                            </template>
                        </label>
                        <div class="card-item__content">
                            <label for="cardName" class="card-item__info" ref="cardName">
                                <div class="card-item__holder">Card Holder</div>
                                <transition name="slide-fade-up">
                                    <div class="card-item__name" v-if="cardName.length" key="1">
                                        <transition-group name="slide-fade-right">
                                            <span class="card-item__nameItem" v-for="(n, $index) in cardName.replace(/\s\s+/g, ' ')" v-if="$index === $index" v-bind:key="$index + 1">{{n}}</span>
                                        </transition-group>
                                    </div>
                                    <div class="card-item__name" v-else key="2">Full Name</div>
                                </transition>
                            </label>
                            <div class="card-item__date" ref="cardDate">
                                <label for="cardMonth" class="card-item__dateTitle">Expires</label>
                                <label for="cardMonth" class="card-item__dateItem">
                                    <transition name="slide-fade-up">
                                        <span v-if="cardMonth" v-bind:key="cardMonth">{{cardMonth}}</span>
                                        <span v-else key="2">MM</span>
                                    </transition>
                                </label>
                                /
                                <label for="cardYear" class="card-item__dateItem">
                                    <transition name="slide-fade-up">
                                        <span v-if="cardYear" v-bind:key="cardYear">{{String(cardYear).slice(2,4)}}</span>
                                        <span v-else key="2">YY</span>
                                    </transition>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-item__side -back">
                    <div class="card-item__cover">
                        <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'" class="card-item__bg" />
                    </div>
                    <div class="card-item__band"></div>
                    <div class="card-item__cvv">
                        <div class="card-item__cvvTitle">CVV</div>
                        <div class="card-item__cvvBand">
                            <span v-for="(n, $index) in cardCvv" :key="$index">*</span>
                        </div>
                        <div class="card-item__type">
                            <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'" v-if="getCardType" class="card-item__typeImg" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-form__inner">
            <div class="card-input">
                <label for="cardNumber" class="card-input__label">Card Number</label>
                <input type="text" id="cardNumber" class="card-input__input" v-mask="generateCardNumberMask" v-model="cardNumber" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardNumber" autocomplete="off" />
                <div class="mt-2 p-2 font-italic text-danger">{{errorCardNumber}}</div>
            </div>
            <div class="card-input">
                <label for="cardName" class="card-input__label">Card Holders</label>
                <input type="text" id="cardName" class="card-input__input" v-model="cardName" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardName" autocomplete="off" />
                <div class="mt-2 p-2 font-italic text-danger">{{errorCardName}}</div>
            </div>
            <div class="card-form__row">
                <div class="card-form__col">
                    <div class="card-form__group">
                        <label for="cardMonth" class="card-input__label">Expiration Date</label>
                        <select class="card-input__input -select" id="cardMonth" v-model="cardMonth" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate">
                            <option value disabled selected>Month</option>
                            <option v-bind:value="n < 10 ? '0' + n : n" v-for="n in 12" v-bind:disabled="n < minCardMonth" v-bind:key="n">{{n < 10 ? '0' + n : n}}</option>
                        </select>
                        <select class="card-input__input -select" id="cardYear" v-model="cardYear" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate">
                            <option value disabled selected>Year</option>
                            <option v-bind:value="$index + minCardYear" v-for="(n, $index) in 20" v-bind:key="n">{{$index + minCardYear}}</option>
                        </select>
                        <div class="mt-2 p-2 font-italic text-danger">{{errorCardMonth}}</div>
                        <div class="p-2 font-italic text-danger">{{errorCardYear}}</div>
                    </div>
                </div>
                <div class="card-form__col -cvv">
                    <div class="card-input">
                        <label for="cardCvv" class="card-input__label">CVV</label>
                        <input type="password" class="card-input__input" id="cardCvv" v-mask="'####'" maxlength="3" v-model="cardCvv" v-on:focus="flipCard(true)" v-on:blur="flipCard(false)" autocomplete="off" />
                        <div class="mt-2 p-2 font-italic text-danger">{{errorCardCvv}}</div>
                    </div>
                </div>
            </div>
            <div class="card-form__row">
                <div class="card-form__col -cvv">
                    <div class="card-input">
                        <label for="cardPin" class="card-input__label">Card Pin</label>
                        <input type="password" class="card-input__input" id="cardPin" v-mask="'####'" maxlength="4" v-model="cardPin" autocomplete="off" />
                        <div class="mt-2 p-2 font-italic text-danger">{{errorCardPin}}</div>
                    </div>
                </div>
            </div>
            <button class="card-form__button" @click="makeOrder">Pay <i class="fa fa-money fa-1x"></i></button>
            <router-link :to="{name:'checkout'}" class="btn btn-block github-btn mt-3">
                <i class="fa fa-arrow-left fa-1x"></i>
                &nbsp; Back
            </router-link>
        </div>

        <br />
        <br />
    </div>
</template>

<script>
import Flash from '../../util/flash';
import {
    post
} from "../../util/api";

export default {
    name: 'Payment',
    data() {
        return {
            currentCardBackground: Math.floor(Math.random() * 25 + 1), // just for fun :D
            cardName: "",
            cardNumber: "",
            cardMonth: "",
            cardYear: "",
            cardCvv: "",
            cardPin: "",
            errorCardName: "",
            errorCardNumber: "",
            errorCardMonth: "",
            errorCardYear: "",
            errorCardCvv: "",
            errorCardPin: "",
            errors: [],
            minCardYear: new Date().getFullYear(),
            amexCardMask: "#### ###### #####",
            otherCardMask: "#### #### #### ####",
            cardNumberTemp: "",
            isCardFlipped: false,
            focusElementStyle: null,
            isInputFocused: false
        };
    },
    mounted() {
        if (this.$store.getters.CART.length === 0) {
            this.$router.push({
                name: "mall"
            });
        }
        this.cardNumberTemp = this.otherCardMask;
        document.getElementById("cardNumber").focus();
    },
    computed: {
        getCardType() {
            let number = this.cardNumber;
            let re = new RegExp("^4");
            if (number.match(re) != null) return "visa";

            re = new RegExp("^(34|37)");
            if (number.match(re) != null) return "amex";

            re = new RegExp("^5[1-5]");
            if (number.match(re) != null) return "mastercard";

            re = new RegExp("^6011");
            if (number.match(re) != null) return "discover";

            re = new RegExp('^9792')
            if (number.match(re) != null) return 'troy'

            return "visa"; // default type
        },
        generateCardNumberMask() {
            return this.getCardType === "amex" ? this.amexCardMask : this.otherCardMask;
        },
        minCardMonth() {
            if (this.cardYear === this.minCardYear) return new Date().getMonth() + 1;
            return 1;
        }
    },
    watch: {
        cardYear() {
            if (this.cardMonth < this.minCardMonth) {
                this.cardMonth = "";
            }
        }
    },
    methods: {
        makeOrder() {
            let $this = this;
            if (this.cardName === null || this.cardName === '') {
                this.errorCardName = "Card Name is Required";
                this.errors.push(this.errorCardName);
            } else {
                this.errorCardName = null;
            }
            if (this.cardNumber < 16 || this.cardNumber === '') {
                this.errorCardNumber = "Valid Card Number is Required";
                this.errors.push(this.errorCardNumber);
            } else {
                this.errorCardNumber = null;
            }
            if (this.cardMonth === null || this.cardMonth === '') {
                this.errorCardMonth = "Card Expiration Month is Required";
                this.errors.push(this.errorCardMonth);
            } else {
                this.errorCardMonth = null;
            }
            if (this.cardYear === null || this.cardYear === '') {
                this.errorCardYear = "Card Expiration Year is Required";
                this.errors.push(this.errorCardYear);
            } else {
                this.errorCardYear = null;
            }
            if (this.cardCvv < 3 || this.cardCvv === '') {
                this.errorCardCvv = "Cvv is Required";
                this.errors.push(this.errorCardCvv);
            } else {
                this.errorCardCvv = null;
            }
            if (this.cardPin < 4 || this.cardPin === '') {
                this.errorCardPin = "Valid Card Pin is Required";
                this.errors.push(this.errorCardPin);
            } else {
                this.errorCardPin = null;
            }
            $this.$store.dispatch("spinner", true);

            if (!this.errors.length) {
                if (this.$store.getters.KITCHEN === "" ) {
                    this.$router.push({
                        name: "kitchen"
                    });
                }
                if (this.$store.getters.AUTH_STATUS === false) {
                    this.$store.dispatch('logOut').then(() => {
                        this.$router.push({
                            name: "auth.login"
                        });
                    })
                }
                    $this.$store
                        .dispatch("OrderKitchen")
                        .then(() => {
                            $this.$store.dispatch("spinner", false);
                            $this.$toast.success(`Your Booking was Successful`, {
                                position: 'bottom-center',
                                timeout: 10000,
                                closeOnClick: true,
                                pauseOnFocusLoss: true,
                                pauseOnHover: false,
                                draggable: true,
                                draggablePercent: 0.6,
                                hideCloseButton: false,
                                hideProgressBar: true,
                                icon: true,
                            })
                            this.$router.push({
                             name: "booking_success"
                          });
                          let message = `Your Booking Was Success And Your Ticket is ${this.$store.getters.BOOKING_TICKET}`;
                          $this.$store.dispatch("set_notification", message)
                          $this.$store.dispatch("get_notification")
                        })
                    

                
            }

        },
        flipCard(status) {
            this.isCardFlipped = status;
        },
        focusInput(e) {
            this.isInputFocused = true;
            let targetRef = e.target.dataset.ref;
            let target = this.$refs[targetRef];
            this.focusElementStyle = {
                width: `${target.offsetWidth}px`,
                height: `${target.offsetHeight}px`,
                transform: `translateX(${target.offsetLeft}px) translateY(${target.offsetTop}px)`
            }
        },
        blurInput() {
            let vm = this;
            setTimeout(() => {
                if (!vm.isInputFocused) {
                    vm.focusElementStyle = null;
                }
            }, 300);
            vm.isInputFocused = false;
        }
    }
}
</script>

<style>
</style>
