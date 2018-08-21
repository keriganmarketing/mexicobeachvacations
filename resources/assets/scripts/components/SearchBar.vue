<template>
    <form action="/rentals/" method="get">
        <div class="row justify-content-center">
            <div class="col-4">
                <hotel-date-picker
                    class="input-rounded"
                    @checkInChanged="checkInChanged"
                    @checkOutChanged="checkOutChanged"
                >
                </hotel-date-picker>    
            </div>
            <div class="col-auto">
                <div class="form-group">
                    <select class="custom-select input-rounded" v-model="location" @change="getMatches">
                        <option value="" >Location</option>
                        <option value="Beachfront" >Beachfront</option>
                        <option value="Between Hwy-Beach">Between highway and beach</option>
                        <option value="Across Hwy from Beach">Across highway from beach</option>
                    </select>
                </div>
            </div>
            <div class="col-auto">
                <div class="form-group">
                    <select class="custom-select input-rounded" v-model="type" @change="getMatches">
                        <option value="" >Type</option>
                        <option value="Vacation Rental">Vacation Rental</option>
                        <option value="Long Term Rental">Long Term Rental</option>
                    </select>
                </div>
            </div>
            <div class="col-auto">
                <button v-if="numAvailable == 0" class="btn btn-primary btn-rounded" disabled>Search</button>
                <button v-if="numAvailable > 0 || numAvailable == null" class="btn btn-primary btn-rounded">Search</button>
            </div>
            <div class="col-12 text-center text-white">
                <span v-if="numAvailable > 0" >Properties matching your search: {{ numAvailable }}</span>
            </div>
        </div>
    </form>
</template>

<script>
import HotelDatePicker from 'vue-hotel-datepicker';
import moment from 'moment';
export default {
    components: {
        HotelDatePicker
    },
    data() {
        return {
            checkIn: '',
            checkOut: '',
            location: '',
            type: '',
            numAvailable: null
        }
    },
    methods: {
        checkInChanged(date) {
            this.checkIn = moment(date).format("YYYY-MM-DD");
            this.getMatches();
        },
        checkOutChanged(date) {
            this.checkOut = moment(date).format("YYYY-MM-DD");
            this.getMatches();
        },
        getMatches() {
            let url = 'https://rns.mexicobeachvacations.com/matches?q=search&checkIn=' + this.checkIn + '&checkOut=' + this.checkOut + '&type=' + this.type + '&location=' + this.location;
            axios.get(url)
                .then(response => {
                    this.numAvailable = response.data;
                })
        }
    }
}

</script>
<style>
.input-rounded button {
    border: 0 !important;
    height: 44px !important;
}
.datepicker__wrapper,
.datepicker__dummy-wrapper {
    border: 0 !important;
    height: 44px !important;
}
.datepicker__clear-button {
    height: 40px !important;
    margin: 1px 0 0 0 !important;
}
.input-rounded {
    border-radius: 2em;
    border: 2px solid #46a5b5 !important;
    height: 44px;
}
.custom-select.input-rounded {
    padding: 0.425rem 1.75rem 0.375rem 1rem;
}
.btn-primary,
.btn-primary.disabled, 
.btn-primary:disabled {
    color: #FFF;
    opacity: 1 !important;
    border: 2px solid #46a5b5 !important;
}
</style>
