<template>
<div>
    <div class="mt-4">
        <h2>Step 1: Trip Details</h2>
    </div>
    <div class="row align-items-end">
        <div class="col-lg-6">
            <p class="mt-2 mt-md-0">Use the calendar to select the dates of your stay.</p>
        </div>
        <div class="col-6 col-md-4 col-lg-3 mb-2">
            <label for="ArrivalDate">Check-in:</label>
            <input type="text" id="ArrivalDate" class="border-0 bg-white" v-model="info.ArrivalDate" disabled style="width:100px">
        </div>
        <div class="col-6 col-md-4 col-lg-3 mb-2">
            <label for="DepartureDate">Check-out:</label>
            <input type="text" id="DepartureDate" class="border-0 bg-white" v-model="info.DepartureDate" disabled style="width:100px">
        </div>
        
        <div class="col-lg-12">
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
            return '<p><strong>Terms and Conditions</strong></p> <p>Check-in: time is 3:00pm central</p> <p>Check-out: time is 11:00am central</p> <p>Guest agrees to schedule arrival and departure at stated times. Keys are not available until check-in time.</p> <p>Check-in Check-out Location: All keys will be distributed from our office. Our hours are 8:00am – 4:00pm central, Monday-Friday, 8:00am – 4:00pm central on Saturday. Closed on Sunday.</p> <p>Payment Policy: Half of the rent, tax, and the $75 reservation fee is due within 10 days of making initial reservation. Balance due thirty (30) days prior to arrival by check or credit card. We can accept Visa, MasterCard, or Discover.</p> <p>Cancellations &amp; Refunds: NO REFUNDS WILL BE OFFERED, even in the event of a mandatory evacuation. If no insurance coverage is purchased, no refunds will be given.</p> <p>In the event of a cancellation or change of your reservation without the purchase of travel insurance, you are subject to lose your pre-payment and/or payment in full unless the home rebooks for the same time period. If the home re-books for the same time period you will be refunded your payment minus a $115 cancellation fee.</p> <p>Should the owner of any property elect to remove their property from our rental program, the guest shall not hold Parker Realty of Mexico Beach INC liable. In such an instance, the guest will be relocated to comparable accommodations determined by the rental agency If comparable accommodations are not available, the guest will receive a full refund.</p> <p>No refunds will be given for cancellation or interruption due to inclement weather.</p> <p>Security Deposit: All reservations require a $200 refundable security deposit to be held during your stay. Guest acknowledges agent’s authority to charge guest’s credit card for damages to unit rented that exceed $200.</p> <p>Indemnification: You agree to indemnify Owner for any damages to the premises, including damages to the furnishings and household items, which is a result of your occupancy in or on the property. Owner &amp; Agent my re-enter premises at a reasonable time for the purpose of making repairs. Owner &amp; Agent are not responsible for articles left on premises.</p> <p>Substitution of Accommodations: Circumstances may cause your confirmed unit to be unavailable. Therefore, Parker Realty of Mexico Beach, INC reserves the right to substitute comparable accommodations. We cannot guarantee the confirmed rate in these circumstances; however, accommodations and rates will be subject to your approval.</p> <p>Pets are not permitted unless otherwise noted and prior approval.</p> <p>Student Groups are not permitted: Students unaccompanied by a parent will not be permitted to register. Any reservation obtained under false pretense will be subject to forfeiture of all monies prepaid and the party will not be permitted to occupy any unit in Parker Realty of Mexico Beach, INC property management program. You must be at least 25 years of age or older to reserve, and must be present when checking in.</p> <p>Condominium Rules: Your unit is confirmed with the understanding that you will adhere to the rules and regulations set by individual condominiums or homeowner association.</p> <p>Telephone Usage: Most units are equipped with a telephone. Long distance calls must be charged to a long distance card calling service, credit card, or billed to your home number. Local calls are free.</p> <p>Cleaning: All condos and homes are cleaned prior to arrival and at departure.</p> <p>Supplies: All units are fully equipped for your enjoyment with Cable TV, microwave and kitchen supplies for “everyday cooking”, central air and a Starter Supply kit including bar soap, toilet paper, dish soap, and trash bags.</p> <p>Beach Towels and Beach Equipment: Bring your own!</p> <p>Maximum Occupancy: the unit can be occupied by no more than the maximum number of persons indicated on this confirmation. Occupancy is defined as any overnight stay. In the event occupancy is exceeded, guest agrees to let the owner, owners agent or condominium association remove them from the unit and retain all monies whether earned or unearned.</p> <p>Maintenance: Parker Realty reserves the right to allow maintenance personnel to perform mandatory monthly and emergency maintenance services in all occupied and non occupied units. We will attempt to contact and schedule all maintenance; however, if we are unable to reach you, we will allow our maintenance personnel to complete required maintenance.</p>';
        }
    }
}

</script>
<style lang="scss">

</style>

