<template>
    <div>
        <form>
            <nav class="navbar navbar-light">
                <button class="btn btn-outline-secondary" type="button" :class="{'btn-outline-success': step == 1, 'btn-sm': step !== 1}" @click="step = 1">Step 1 - Trip Details</button>
                <button class="btn btn-outline-secondary" type="button" :class="{'btn-outline-success': step == 2, 'btn-sm': step !== 2}" @click="step = 2">Step 2 - Contact Info</button>
                <button class="btn btn-outline-secondary" type="button" :class="{'btn-outline-success': step == 3, 'btn-sm': step !== 3}" @click="step = 3">Step 3 - Payment</button>
                <button class="btn btn-outline-secondary" type="button" :class="{'btn-outline-success': step == 4, 'btn-sm': step !== 4}" @click="step = 4">Step 4 - Billing</button>
                <button class="btn btn-outline-secondary" type="button" :class="{'btn-outline-success': step == 5, 'btn-sm': step !== 5}" @click="step = 5">Step 5 - Confirmation</button>
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
                <label for="comments">Comments</label>
                <textarea id="comments" v-model="info.Notes"></textarea>

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
            checkOut: null
        }
    },
    mounted () {
        this.info.UnitId = this.unit.rns_id !== undefined ? this.unit.rns_id : 0;
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
            this.checkOut = new Date(moment(date));
            this.info.DepartureDate = moment(date).format("MM/DD/YYYY");
        },
        back() {
            if (this.step > 1) this.step -= 1;
        },
        next() {
            if (this.step < 5) this.step += 1;
        }
    }
}
</script>
