<template>
    <div>
        <div v-if="unitLoaded">
            <h1>Booking <span style="text-transform: capitalize;">{{ unit.name.toLowerCase() }}</span></h1>
            <div class="row">
                <div class="col-auto">
                    <p class="proprty-address fira">{{ unit.details[0].address }}</p>
                </div>
                <div class="col-auto">
                    <p class="proprty-beds-baths fira">{{ unit.details[0].baths }} Beds | {{ unit.details[0].baths }} Baths | Sleeps {{ unit.details[0].sleeps }}</p>
                </div>
            </div>
        </div>
        <hr>
        <div class="row" v-if="unitLoaded" >
            <div class="col-md-6 col-lg-4 mb-4">
                <img :src="unit.images[0].url" :alt="unit.images[0].description" class="img-fluid" >
            </div>
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-sm table-striped rate-table">
                        <tbody>
                            <tr 
                                v-for="detail in rateDetails.GuestCharges" 
                                :key="detail.HeadingsListId" 
                                v-if="isAvailable" 
                                :class="{
                                    'text-primary': detail.HeadingName === 'Total Cost', 
                                    'font-weight-bold': detail.HeadingName === 'Total Cost' 
                                }"
                            >
                                <td class="data-label">{{ detail.HeadingName }}</td>
                                <td>{{ detail.ChgAmount.toLocaleString('en-US', { style: 'currency', currency: 'USD' }) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <form>
            <div class="row no-gutters">
                <div class="col-3 px-1">
                    <button class="btn btn-block" type="button" :class="{'btn-info text-white': step == 1, 'btn-outline-secondary': step !== 1}" @click="step = 1">Step 1</button>
                </div>
                <div class="col-3 px-1">
                    <button class="btn btn-block" type="button" :class="{'btn-info text-white': step == 2, 'btn-outline-secondary': step !== 2}" @click="step = 2">Step 2</button>
                </div>
                <div class="col-3 px-1">
                    <button class="btn btn-block" type="button" :class="{'btn-info text-white': step == 3, 'btn-outline-secondary': step !== 3}" @click="step = 3">Step 3</button>
                </div>
                <div class="col-3 px-1">
                    <button class="btn btn-block" type="button" :class="{'btn-info text-white': step == 4, 'btn-outline-secondary': step !== 4}" @click="step = 4">Step 4</button>
                </div>
            </div>
            <div class="mt-4 text-right text-sm">
                <p><span class="required">*</span> = required</p>
            </div>
            <div v-if="step == 1">
                <step-one
                    :data-info="info"
                    :is-available="isAvailable"
                    :num-nights="numNights"
                    :data-terms-accepted="termsAccepted"
                    :selected-dates="info.selectedDates"
                    :errorMessage="errorMessage"
                    :calendarOptions="calendarOptions"
                    @terms-accepted="acceptTerms"
                >
                </step-one>
            </div>
            <div v-if="step == 2">
                <step-two :data-info="info">
                </step-two>
                
            </div>
            <div v-if="step == 3">
                <step-three :data-info="info">
                </step-three>
            </div>
            <div v-if="step == 4">
                <step-four
                    :data-info="info"
                    :unit="unit"
                    :rate-details="rateDetails"
                    @booked="submit"
                    :submitting="submitting"
                >
                </step-four>
            </div>
        </form>
        <div class="my-4 text-center">
            <button class="btn btn-lg btn-rounded" @click="back" v-if="step > 1">Back</button>
            <button class="btn btn-lg btn-rounded btn-info text-white" @click="next" v-if="step < 4">Next</button>
        </div>
    </div>
</template>


<script>
import ReservationInfo from '../models/reservation-info.js';
import StepOne from './StepOne.vue';
import StepTwo from './StepTwo.vue';
import StepThree from './StepThree.vue';
import StepFour from './StepFour.vue';
import {setupCalendar, Calendar} from 'v-calendar'
import 'v-calendar/lib/v-calendar.min.css';
import moment from 'moment';

export default {
    components: {
        StepOne, StepTwo, StepThree, StepFour
    },
    props: ['unitId'],
    data() {
        return {
            info: new ReservationInfo(),
            step: 1,
            numNights: 7,
            isAvailable: false,
            unitLoaded: false,
            email: null,
            termsAccepted: false,
            calendarOptions: [{
                dates: [],
                highlight: {
                    backgroundColor: '#ff8080',
                },
                contentStyle: {
                    color: '#ffffff',
                }
            }],
            unit: {},
            rateDetails: {},
            rnsBaseUrl: 'https://core.rnshosted.com/api/v17/',
            token: '',
            errorMessage: '',
            bookings: [],
            submitting: false
        }
    },
    created () {
        setupCalendar({
            firstDayOfWeek: 1,
            paneWidth: 300,
            formats: {
                title: 'MMMM YYYY',
                weekdays: 'WWW',
                navMonths: 'MMM',
                input: ['L', 'YYYY-MM-DD', 'YYYY/MM/DD'],
                dayPopover: 'L',
            }
        });
        this.info.UnitId = this.unitId;
        this.getUnit();
        this.getToken();

    },
    computed: {
        CCCVCode() {
            return this.info.CCCVCode;
        },
        selectedDates() {
            return this.info.selectedDates;
        }
    },
    watch: {
        CCCVCode: function (newCode, oldCode) {
            if (newCode.length > 4) {
                this.info.CCCVCode = this.info.CCCVCode.slice(0, -1);
            }
        },
        selectedDates: function (newDates, oldDates) {
            let checkIn = moment(newDates.start);
            let checkOut = moment(newDates.end);
            this.info.ArrivalDate   = checkIn.format("MM/DD/YYYY");
            this.info.DepartureDate = checkOut.format("MM/DD/YYYY");
            this.numNights = checkOut.diff(checkIn, 'days');
            this.getRateDetails();
        }
    },
    methods: {
        acceptTerms(value) {
            this.termsAccepted = value;
        },
        submit() {
            this.submitting = true;
            this.info.submit();
            this.submitting = false;
        },
        clearDates() {
            this.info.ArrivalDate = null;
            this.info.DepartureDate = null;
        },
        back() {
            if (this.step > 1) this.step -= 1;
        },
        next() {
            if (this.step < 4) this.step += 1;
        },
        getUnit() {
            axios.get('https://rns.mexicobeachvacations.com/units/' + this.unitId)
                .then(response => {
                    this.unit = response.data;

                    this.unit.availability.forEach( booking => {
                        this.bookings.push({
                            start: booking.arrival_date,
                            end: booking.departure_date,
                            title: 'Booked',
                            id: booking.rns_id
                        });
                    });

                    this.calendarOptions[0].dates = this.bookings;
                    this.unitLoaded = true;
                })
                .catch(err => {
                    console.log(err)
                })
        },
        getRateDetails() {
            let config = {
                headers: { 'Authorization': 'Bearer ' + this.token }
            }

            axios.post('https://core.rnshosted.com/api/v17/Units/' + this.unitId + '/Rates?clientid=RNS.ParkerRealty.KeriganMarketing', {
                   "ArrivalDate": this.info.ArrivalDate,
                   "DepartureDate": this.info.DepartureDate,
                   "Persons": this.info.Persons,
                   "DeclineTravelInsurance": false,
                   "PromoCode": '',
                   "IncludeSDP": true,
                   "SDPStrict": true
            }, config)
                .then(response => {
                    this.rateDetails = response.data[0];
                    this.isAvailable = this.checkAvailability();
                })
                .catch(err => {
                    console.log(err);
                })
        },
        getToken() {
            axios.post(this.rnsBaseUrl + 'Account/AccessToken?clientid=RNS.ParkerRealty.KeriganMarketing', {
                ClientId: "RNS.ParkerRealty.KeriganMarketing",
                ClientSecret: "0f869127-9043-4c71-bc8d-2e391cb04822",
                Scope: "rns.v17.api"
            })
                .then(response => {
                    this.token = response.data.access_token
                    
                })
                .catch(err => {
                    console.log(err);
                })

        },
        checkAvailability() {
            let passesCheck = this.rateDetails.IsUnitAvailable;

            if(! passesCheck) {
                this.errorMessage = this.rateDetails.UserMessage !== "" ? this.rateDetails.UserMessage : "We're sorry, but the unit isn't available for the selected dates. Please select new dates and try again."
                return false;
            }

            return true

        },
        setBillingState(value){
            this.info.BillingState = value;
        },
        setState(value){
            this.info.State = value;
        },
        setBillingCountry(value){
            this.info.BillingCountry = value;
        },
        setCountry(value){
            this.info.Country = value;
        }
    }
}
</script>
<style lang="scss" >
.required {
    color: red;
}
.availability-cal .c-pane-container .c-pane {
    background: #FFF;
    width: 300px !important;

    @media (min-width: 576px){
        width: 250px !important;
    }
    @media (min-width: 768px){
        width: 345px !important;
    }
    @media (min-width: 993px){
        width: 465px !important;
        
        .c-day-content,
        .c-day-background {
            height: 2.8rem !important;

            &:hover {
                width: 2.8rem !important;
            }
        }
    }
    @media (min-width: 1200px){
        width: 550px !important;
    }

    .c-weekdays,
    .c-day-content {
        font-family: "ABeeZee", sans-serif;
    }
    .c-title {
        font-family: "Fira Sans Condensed", sans-serif;
    }
    .c-arrow-layout {
        padding: 6px 5px 4px;
        border: 2px solid #ff6f74;
        border-radius: 50%;
        color: #ff6f74;
    }

}
</style>
