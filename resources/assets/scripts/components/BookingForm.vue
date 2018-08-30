<template>
    <div>
        <h1>Book Now</h1>
        <div class="row" v-if="unit" >
            <div class="col-md-6 col-lg-4 mb-4">
                <h2 style="text-transform: capitalize;">{{ unit.name.toLowerCase() }}</h2>           
                <img :src="unit.images[0].url" :alt="unit.images[0].description" class="img-fluid" >
            </div>
            <div class="col-md-6">
                <h2>Cost Breakdown</h2>
                <div class="table-responsive">
                    <table class="table table-sm table-striped rate-table">
                        <tbody>
                            <tr>
                                <td class="data-label"></td>
                                <td></td>
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
                <div class="mt-4">
                    <h2>Step 1: Trip Details</h2>
                </div>
                <div class="row align-items-end">
                    <div class="col-6 col-md-4 col-lg-3">
                        <label for="ArrivalDate">Check-in</label>
                        <div class="form-group">
                            <input type="text" id="ArrivalDate" class="form-control" v-model="info.ArrivalDate" disabled>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <label for="DepartureDate">Check-out</label>
                        <div class="form-group">
                            <input type="text" id="DepartureDate" class="form-control" v-model="info.DepartureDate" disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group text-lg-right">
                        <p>Use the calendar to select the dates of your stay.</p>
                        </div>
                    </div>
                    <div class="col-12 availability-cal mb-2">
                        <div class="form-group">
                            <v-date-picker
                                mode="range"
                                :attributes="calendarOptions"
                                is-double-paned
                                v-model="info.selectedDate"
                                :disabled-dates="calendarOptions[0].dates"
                                :popover-expanded="true"
                                :is-inline="true"
                                @dayclick="changeDate"
                            >
                            </v-date-picker>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="numNights">Number of Nights</label>
                        <div class="form-group">
                            <input type="number" id="numNights" class="form-control" v-model="numNights" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="numPersons">Number of people <span class="required">*</span></label>
                        <div class="form-group">
                            <input type="number" id="numPersons" class="form-control" v-model="info.Persons">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="promoCode">Promo Code</label>
                        <div class="form-group">
                            <input id="promoCode" class="form-control" type="text" name="promoCode" v-model="info.PromoCode">
                        </div>

                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="comments">Additional details you'd like us to know</label>
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
                    <div class="custom-control custom-checkbox" @click="termsAccepted = ! termsAccepted">
                        <input id="termsAccepted" class="custom-control-input" type="checkbox" name="termsAccepted" v-model="termsAccepted" :checked="termsAccepted">
                        <label class="custom-control-label" for="termsAccetped">Do you accept the terms? <span class="required">*</span></label>
                    </div>
                </div>
            </div>
            <div v-if="step == 2">
                <div class="mt-4">
                    <h2>Step 2: Contact Info</h2>
                </div>
                <div class="row">
                    <div class="col-md-4" >
                        <label for="FirstName">First Name <span class="required">*</span></label>
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="info.FirstName" id="FirstName" required />
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <label for="LastName">Last Name <span class="required">*</span></label>
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="info.LastName" id="LastName" />
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <label for="MiddleInitial">Middle Initial</label>
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="info.MiddleInitial" id="MiddleInitial" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <div class="form-group">
                            <input id="email" class="form-control" type="email" name="email" v-model="info.Email" required>
                        </div>
                        <label for="email_confirmation" class="sr-only">Confirm your Email</label>
                        <div class="form-group">
                            <input id="email_confirmation" class="form-control" type="email" name="email_confirmation" v-model="email" placeholder="Confirm Email" required>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="comments">Mailing Address <span class="required">*</span></label>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text" class="form-control" v-model="info.Address" placeholder="Street" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" v-model="info.Address2" placeholder="Apt/Ste" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" v-model="info.City" placeholder="City" required />
                                </div>
                            </div>
                            <div class="col-md">
                                <state-options @selectOption="setState" ></state-options>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <input type="text" class="form-control" v-model="info.Zip" placeholder="Zip" required />
                                </div>
                            </div>
                            <div class="col-md">
                                <country-options @selectOption="setCountry" ></country-options>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4" >
                        <label for="HomePhone">Home Phone <span class="required">*</span></label>
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="info.HomePhone" id="HomePhone" required/>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <label for="WorkPhone">Work Phone</label>
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="info.WorkPhone" id="WorkPhone"/>
                        </div>
                    </div> 
                    <div class="col-md-4" >
                        <label for="OtherPhone">Cell Phone</label>
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="info.OtherPhone" id="OtherPhone"/>
                        </div>
                    </div>
                </div>
                
                <input type="hidden" v-model="info.Title" placeholder="Title" />
                
            </div>

            <div v-if="step == 3">
                <div class="mt-4">
                    <h2>Step 3: Payment</h2>
                </div>
                <div class="row">
                    <div class="col-sm-6" >
                        <label for="CreditCardNumber">Credit Card Number <span class="required">*</span></label>
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="info.CreditCardNumber" id="CreditCardNumber" required />
                        </div>
                    </div>
                    <div class="col-6 col-sm-auto" >
                        <label for="ExpMonth">Expiration <span class="required">*</span></label>
                        <div class="row">
                            <div class="col-auto">
                                <div class="form-group">
                                    <select class="custom-select" v-model="info.ExpMonth" id="ExpMonth" required >
                                        <option value="">MM</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-group">
                                    <select class="custom-select" v-model="info.ExpYear" id="ExpYear" required >
                                        <option value="">YYYY</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="NameOnCard">Name on Card<span class="required">*</span></label>
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="info.NameOnCard" id="NameOnCard" required />
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="CCCVCode">CCCV Code <span class="required">*</span></label>
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="info.CCCVCode" id="CCCVCode" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <label for="comments">Billing Address <span class="required">*</span></label>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text" class="form-control" v-model="info.BillingAddress" placeholder="Street" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" v-model="info.BillingAddress2" placeholder="Apt/Ste" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" v-model="info.BillingCity" placeholder="City" required />
                                </div>
                            </div>
                            <div class="col-md">
                                <state-options @selectOption="setBillingState" ></state-options>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <input type="text" class="form-control" v-model="info.BillingZip" placeholder="Zip" required />
                                </div>
                            </div>
                            <div class="col-md">
                                <country-options @selectOption="setBillingCountry" ></country-options>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="step == 4">
                <div class="mt-4">
                    <h2>Step 4: Confirmation</h2>
                </div>
            </div>
        </form>
        <div class="my-4">
            <button class="btn" @click="back">Back</button>
            <button class="btn btn-primary text-white" @click="next">Next</button>
        </div>
    </div>
</template>


<script>
import ReservationInfo from '../models/reservation-info.js';
import { setupCalendar, Calendar} from 'v-calendar'
import 'v-calendar/lib/v-calendar.min.css';
import moment from 'moment';
import CCValidator from '../models/ccvalidator.js';

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


export default {
    props: ['unitId'],
    data() {
        return {
            info: new ReservationInfo(),
            step: 1,
            checkIn: null,
            checkOut: null,
            numNights: 7,
            email: null,
            termsAccepted: false,
            unit: {},
            rateDetails: {},
            rnsBaseUrl: 'https://core.rnshosted.com/api/v17/',
            token: '',
            calendarOptions: [{
                dates: [],
                highlight: {
                    backgroundColor: '#ff8080',
                },
                contentStyle: {
                    color: '#ffffff',
                }
            }],
            bookings: []
        }
    },
    mounted () {
        this.info.UnitId = this.unitId;
        this.getUnit();
        this.getToken();

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
            this.info.DepartureDate = out.format("MM/DD/YYYY");
            this.numNights = out.diff(this.checkIn, 'days');
            this.getRateDetails();
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
                   "ArrivalDate": moment(this.checkIn).format("MM/DD/YYYY"),
                   "DepartureDate": moment(this.checkOut).format("MM/DD/YYYY"),
                   "Persons": this.info.Persons,
                   "DeclineTravelInsurance": false,
                   "PromoCode": '',
                   "IncludeSDP": true,
                   "SDPStrict": true
            }, config)
                .then(response => {
                    this.rateDetails = response.data;
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
        getTerms() {
            return '<p>terms will go here...</p><p>terms will go here...</p><p>terms will go here...</p><p>terms will go here...</p>';
        },
        changeDate(value){
            if(value.attributes.length === 0){
                this.checkIn = new Date(moment(value.dateTime));
                this.info.ArrivalDate = moment(value.dateTime).format("MM/DD/YYYY");
            }
            if(value.attributes.length === 1){
                let out = moment(value.dateTime);
                this.checkOut = new Date(out);
                this.info.DepartureDate = out.format("MM/DD/YYYY");
                this.numNights = out.diff(this.checkIn, 'days');
            }
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
