<template>
    <div>
        <form>
            <nav class="navbar navbar-light">
                <button class="btn btn-outline-secondary" type="button" :class="{'btn-outline-success': step == 1, 'btn-sm': step !== 1}" @click="step = 1">Step 1 - Trip Details</button>
                <button class="btn btn-outline-secondary" type="button" :class="{'btn-outline-success': step == 2, 'btn-sm': step !== 2}" @click="step = 2">Step 2 - Contact Info</button>
                <button class="btn btn-outline-secondary" type="button" :class="{'btn-outline-success': step == 3, 'btn-sm': step !== 3}" @click="step = 3">Step 3 - Payment</button>
                <button class="btn btn-outline-secondary" type="button" :class="{'btn-outline-success': step == 4, 'btn-sm': step !== 4}" @click="step = 4">Step 4 - Confirmation</button>
            </nav>
            <div v-if="step == 1">
                <HotelDatePicker 
                    :startingDateValue="checkIn" 
                    :endingDateValue="checkOut" 
                    format="MM/DD/YYYY" 
                    :minNights=7
                    @checkInChanged="checkInChanged"
                    @checkOutChanged="checkOutChanged"
                >
                </HotelDatePicker>
                <input type="hidden" v-model="info.UnitId">
                <input type="hidden" v-model="info.LocationId">
                <label for="numPersons">Number of people</label>
                <input type="number" id="numPersons" v-model="info.Persons">
                <label for="numNights">Number of Nights</label>
                <input type="number" id="numNights" v-model="numNights" disabled>
                <label for="comments">Comments</label>
                <textarea id="comments" v-model="info.Notes"></textarea>
                <label for="email">
                    Email
                </label>
                <input id="email" type="email" name="email" v-model="info.Email">
                <label for="email_confirmation">
                    Confirm your Email
                </label>
                <input id="email_confirmation" type="email" name="email_confirmation" v-model="email">
                <label for="termsAccetped">
                    Do you accept the terms?
                </label>
                <input id="termsAccepted" type="checkbox" name="termsAccepted" v-model="termsAccepted" :checked="termsAccepted">

            </div>
            <div v-if="step == 2">
                <input type="text" v-model="info.FirstName" placeholder="FirstName"/>
                <input type="text" v-model="info.LastName" placeholder="LastName"/>
                <input type="text" v-model="info.MiddleInitial" placeholder="MiddleInitial"/>
                <input type="text" v-model="info.Title" placeholder="Title"/>
                <input type="text" v-model="info.Email" placeholder="Email"/>
                <input type="text" v-model="info.Address" placeholder="Address"/>
                <input type="text" v-model="info.Address2" placeholder="Address2"/>
                <input type="text" v-model="info.City" placeholder="City"/>
                <input type="text" v-model="info.State" placeholder="State"/>
                <input type="text" v-model="info.Zip" placeholder="Zip"/>
                <input type="text" v-model="info.Country" placeholder="Country"/>
                <input type="text" v-model="info.WorkPhone" placeholder="WorkPhone"/>
                <input type="text" v-model="info.OtherPhone" placeholder="OtherPhone"/>
                <input type="text" v-model="info.HomePhone" placeholder="HomePhone"/>
            </div>
            <div v-if="step == 3">
                <input type="number" v-model="info.CreditCardNumber" placeholder="CreditCardNumber" />
                <input type="number" v-model="info.ExpMonth" placeholder="ExpMonth" />
                <input type="number" v-model="info.ExpYear" placeholder="ExpYear" />
                <input type="text" v-model="info.NameOnCard" placeholder="NameOnCard" />
                <input type="number" v-model="info.CCCVCode" placeholder="CCCVCode" />
                <input type="text" v-model="info.BillingAddress" placeholder="BillingAddress"/>
                <input type="text" v-model="info.BillingCity" placeholder="BillingCity"/>
                <input type="text" v-model="info.BillingState" placeholder="BillingState"/>
                <input type="number" v-model="info.BillingZip" placeholder="BillingZip"/>
                <input type="text" v-model="info.BillingCountry" placeholder="BillingCountry"/>
            </div>
        </form>
        <button @click="back">Back</button>
        <button @click="next">Next</button>
    </div>
</template>


<script>
import ReservationInfo from '../models/reservation-info.js';
import HotelDatePicker from 'vue-hotel-datepicker';
import moment from 'moment';
import CCValidator from '../models/ccvalidator.js';

export default {
    props: ['unit'],
    components: {
        HotelDatePicker
    },
    data() {
        return {
            info: new ReservationInfo(),
            step: 1,
            checkIn: null,
            checkOut: null,
            numNights: 7,
            email: null,
            termsAccepted: false,
        }
    },
    mounted () {
        this.info.UnitId = this.unit.rns_id !== undefined ? this.unit.rns_id : 0;
    },
    computed: {
        CCCVCode() {
            return this.info.CCCVCode;
        }
    },
    watch: {
        CCCVCode: function (newCode, oldCode) {
            var vm = this;
            if (newCode.length > 4) {
                this.info.CCCVCode = this.info.CCCVCode.slice(0, -1);
            }
        }
    },
    methods: {
        submit() {
            this.info.submit();
        },
        checkInChanged (date) {
            this.checkIn = new Date(moment(date));
            this.info.ArrivalDate = moment(date).format("MM/DD/YYYY");
        },
        checkOutChanged (date) {
            let out = moment(date);
            this.checkOut = new Date(out);
            this.info.DepartureDate = moment(date).format("MM/DD/YYYY");
            this.numNights = out.diff(this.checkIn, 'days');
        },
        back() {
            if (this.step > 1) this.step -= 1;
        },
        next() {
            if (this.step < 4) this.step += 1;
        }
    }
}
</script>
