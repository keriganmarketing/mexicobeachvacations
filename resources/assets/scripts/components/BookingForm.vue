<template>
    <div>
        <form>
            <div class="row">
                <button class="btn col-md mx-3 my-1" type="button" :class="{'btn-primary text-white': step == 1, 'btn-outline-secondary': step !== 1}" @click="step = 1">Step 1 - Trip Details</button>
                <button class="btn col-md mx-3 my-1" type="button" :class="{'btn-primary text-white': step == 2, 'btn-outline-secondary': step !== 2}" @click="step = 2">Step 2 - Contact Info</button>
                <button class="btn col-md mx-3 my-1" type="button" :class="{'btn-primary text-white': step == 3, 'btn-outline-secondary': step !== 3}" @click="step = 3">Step 3 - Payment</button>
                <button class="btn col-md mx-3 my-1" type="button" :class="{'btn-primary text-white': step == 4, 'btn-outline-secondary': step !== 4}" @click="step = 4">Step 4 - Confirmation</button>
            </div>
            <div v-if="step == 1">
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label>Trip Schedule</label>
                        <div class="form-group">
                            <HotelDatePicker 
                                :startingDateValue="checkIn" 
                                :endingDateValue="checkOut" 
                                format="MM/DD/YY" 
                                :minNights=7
                                @checkInChanged="checkInChanged"
                                @checkOutChanged="checkOutChanged"
                            >
                            </HotelDatePicker>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="numNights">Number of Nights</label>
                        <div class="form-group">
                            <input type="number" id="numNights" class="form-control" v-model="numNights" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="numPersons">Number of people</label>
                        <div class="form-group">
                            <input type="number" id="numPersons" class="form-control" v-model="info.Persons">
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-4">
                        <label for="email">Email</label>
                        <div class="form-group">
                            <input id="email" class="form-control" type="email" name="email" v-model="info.Email">
                        </div>
                        <label for="email_confirmation">Confirm your Email</label>
                        <div class="form-group">
                            <input id="email_confirmation" class="form-control" type="email" name="email_confirmation" v-model="email">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="comments">Comments</label>
                        <div class="form-group">
                            <textarea id="comments" class="form-control" v-model="info.Notes" style="height:145px;"></textarea>
                        </div>
                    </div>
                </div>

                <input type="hidden" v-model="info.UnitId">
                <input type="hidden" v-model="info.LocationId">
                
                <label>Read our Rental Terms</label>
                <div class="form-group">
                    <div id="termstext" class="p-4 border" style="max-height:145px; overflow-y: scroll" v-html="getTerms()"></div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input id="termsAccepted" class="custom-control-input" type="checkbox" name="termsAccepted" v-model="termsAccepted" :checked="termsAccepted">
                        <label class="custom-control-label" for="termsAccetped">Do you accept the terms?</label>
                    </div>
                </div>

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
        <button class="btn" @click="back">Back</button>
        <button class="btn btn-primary text-white" @click="next">Next</button>
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
            termsAccepted: false
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
        },
        getTerms() {
            return '<p>terms will go here...</p><p>terms will go here...</p><p>terms will go here...</p><p>terms will go here...</p>';
        }
    }
}
</script>
