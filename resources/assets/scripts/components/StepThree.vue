<template>
<div>
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
                            <option :value="year" v-for="year in expYears" :key="year">{{ year }}</option>
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
            <div class="form-group">
                <label for="duplicateMailingAddress">Same as mailing address?</label>
                <input id="duplicateMailingAddress" type="checkbox" v-model="duplicateAddress" :checked="duplicateAddress">
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="info.BillingAddress" placeholder="Street" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="info.BillingCity" placeholder="City" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="custom-select" v-model="info.BillingState" required>
                            <option value="">State</option>
                            <option v-for="(name, abbreviation) in states" :value="abbreviation">{{ name }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="info.BillingZip" placeholder="Zip" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="custom-select" v-model="info.Country" required>
                            <option value="">Country</option>
                            <option v-for="(country, abbreviation) in countries" :value="abbreviation">{{ country }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import stateslist from '../helpers/states.js'
import countryList from '../helpers/countries.js'
import moment from 'moment';
export default {
    props: ['data-info'],
    created () {
        this.buildExpYears();
    },
    data() {
        return {
            info: this.dataInfo,
            duplicateAddress: false,
            states: stateslist,
            countries: countryList,
            expYears: [ moment().format("YYYY") ]
        }
    },
    watch: {
        duplicateAddress: function (isTrue) {
            if (isTrue) {
                this.info.BillingZip     = this.info.Zip;
                this.info.BillingCity    = this.info.City;
                this.info.BillingState   = this.info.State;
                this.info.BillingAddress = this.info.Address;
                this.info.BillingCountry = this.info.Country;
            } else {
                this.info.BillingZip     = '';
                this.info.BillingCity    = '';
                this.info.BillingState   = '';
                this.info.BillingAddress = '';
                this.info.BillingCountry = '';
            }            
        }
    },
    methods: {
        buildExpYears() {
            let today = moment();
            for (let i = 0; i < 10; i++) {
                this.expYears.push(today.add(1, 'years').format("YYYY"));
            }

        }
    }
}

</script>
