<template>
<div>
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
        <div class="col-6">
            <div v-if="selectedDates">
                <div class="alert alert-success" v-if="isAvailable">This unit is available for the selected dates</div>
                <div class="alert alert-danger" v-else>{{ errorMessage }}</div>
            </div>
        </div>
        <div class="col-12 availability-cal mb-2">
            <div class="form-group">
                <v-date-picker
                    mode="range"
                    :attributes="calendarOptions"
                    is-double-paned
                    v-model="info.selectedDates"
                    :disabled-dates="calendarOptions[0].dates"
                    :popover-expanded="true"
                    :is-inline="true"
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
    
</template>

<script>
export default {
    props: ['data-info', 'is-available', 'num-nights', 'data-terms-accepted', 'selected-dates', 'errorMessage', 'calendarOptions'],
    data() {
        return {
            info: this.dataInfo,
            termsAccepted: this.dataTermsAccepted
        }
    },
    watch: {
        termsAccepted: function (newValue) {
            this.$emit('terms-accepted', this.termsAccepted);
        }
    },
    methods: {
        getTerms() {
            return '<p>terms will go here...</p><p>terms will go here...</p><p>terms will go here...</p><p>terms will go here...</p>';
        }
    }
}

</script>
