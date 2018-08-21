<template>
    <form method="GET" action="/rentals">
        <input type="hidden" name="checkIn" :value="checkIn">
        <input type="hidden" name="checkOut" :value="checkOut">
        <input type="hidden" name="location" :value="location">
        <input type="hidden" name="type" :value="type">
        <div class="row">
            Properties matching your search: {{ numAvailable }}
        </div>
        <div class="row">
            <div class="col-4">
                <hotel-date-picker
                    @checkInChanged="checkInChanged"
                    @checkOutChanged="checkOutChanged"
                    format="MM/DD/YYYY"
                >
                </hotel-date-picker>    
            </div>
            <div class="col-3">
                <div class="form-group">
                    <select class="form-control" v-model="location" @change="getMatches">
                        <option>Beachfront</option>
                        <option value="Between Hwy-Beach">Between highway and beach</option>
                        <option value="Across Hwy from Beach">Across highway from beach</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <select class="form-control" v-model="type" @change="getMatches">
                        <option>Vacation Rental</option>
                        <option>Long Term Rental</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <button class="btn btn-primary">Search</button>
                </div>
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
            numAvailable: null,
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
