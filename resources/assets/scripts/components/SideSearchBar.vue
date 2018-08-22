<template>
<div>
    <div class="row d-md-none mb-4">
        <a @click="toggleSearch" class="btn btn-info col-6 col-md-12">
            Update Search
        </a>
        <a @click="toggleFilters" class="btn btn-info col-6 col-md-12">
            Apply Filters
        </a>
    </div>
    <div 
        class="sidebar-search-box d-md-block mb-4" 
        :class="{
            'd-none': !searchIsOpen,
            'd-block': searchIsOpen
        }">
        <h3>Update Search Criteria</h3>
        <form method="GET" action="/rentals">
            <input type="hidden" name="checkIn" :value="checkIn">
            <input type="hidden" name="checkOut" :value="checkOut">
            <input type="hidden" name="location" :value="location">
            <input type="hidden" name="type" :value="type">

            <hotel-date-picker
                class="input-rounded"
                @checkInChanged="checkInChanged"
                @checkOutChanged="checkOutChanged"
                format="MM/DD/YYYY"
            >
            </hotel-date-picker> 

            <div class="form-group">
                <select class="custom-select input-rounded" v-model="location" @change="getMatches">
                    <option value="" >Location</option>
                    <option value="Beachfront" >Beachfront</option>
                    <option value="Between Hwy-Beach">Between highway and beach</option>
                    <option value="Across Hwy from Beach">Across highway from beach</option>
                </select>
            </div>

            <div class="form-group">
                <select class="custom-select input-rounded" v-model="type" @change="getMatches">
                    <option value="" >Type</option>
                    <option value="Vacation Rental">Vacation Rental</option>
                    <option value="Long Term Rental">Long Term Rental</option>
                </select>
            </div>

            <button v-if="numAvailable == 0" class="btn btn-primary btn-rounded btn-block" disabled>Search</button>
            <button v-if="numAvailable > 0 || numAvailable == null" class="btn btn-primary btn-rounded btn-block">Search</button>

            <p v-if="numAvailable != null" >Properties matching your search: {{ numAvailable }}</p>

        </form>
    </div>
    <div 
        class="sidebar-filter-box d-md-block" 
        :class="{
            'd-none': !filterIsOpen,
            'd-block': filterIsOpen
        }">
        <h3>Filter Results</h3>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" v-model="filters.pool" :checked="filters.pool" id="pool" @change="applyFilters">
            <label class="form-check-label" for="pool">
                Pool Available
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" v-model="filters.dock" :checked="filters.dock" id="dock" @change="applyFilters">
            <label class="form-check-label" for="dock">
                Dock Available - (Doesn't work right now)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" v-model="filters.canal" :checked="filters.canal" id="canal" @change="applyFilters">
            <label class="form-check-label" for="canal">
                Canal Front - (Doesn't work right now)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" v-model="filters.internet" :checked="filters.internet" id="internet" @change="applyFilters">
            <label class="form-check-label" for="internet">
                Internet Access
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" v-model="filters.linens" :checked="filters.linens" id="linens" @change="applyFilters">
            <label class="form-check-label" for="linens">
                Linens Provided - (Doesn't work right now)
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" v-model="filters.pets" :checked="filters.pets" id="pets" @change="applyFilters">
            <label class="form-check-label" for="pets">
                Pet Friendly
            </label>
        </div>
        <p><img src="/themes/wordplate/assets/images/dock.gif" alt="Dock Available" > Dock Available</p>
        <p><img src="/themes/wordplate/assets/images/pool.gif" alt="Pool Available"> Pool Available</p>
        <p><img src="/themes/wordplate/assets/images/canal.gif" alt="Canal Front" > Canal Front</p>
        <p><img src="/themes/wordplate/assets/images/internet.gif" alt="Internet Available" > Internet Available</p>
        <p><img src="/themes/wordplate/assets/images/linens.gif" alt="Linens Provided" > Linens Provided</p>
        <p><img src="/themes/wordplate/assets/images/virt-tour.gif" alt="Pet Friendly" > Pet Friendly</p>
    </div>
</div>
</template>

<script>
import HotelDatePicker from 'vue-hotel-datepicker';
import moment from 'moment';
export default {
    components: {
        HotelDatePicker
    },
    props: ['searchData'],
    data() {
        return {
            checkIn: '',
            checkOut: '',
            location: '',
            type: '',
            numAvailable: null,
            searchIsOpen: false,
            filterIsOpen: false,
            filters:  {
                dock: false,                
                pool: false,
                canal: false,
                internet: false,
                linens: false,
                pets: false
            }
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
            let url = 'https://rns.mexicobeachvacations.com/matches';

            axios.get(url, {
                params: {
                    type: this.type,
                    checkIn: this.checkIn,
                    checkOut: this.checkOut,
                    dock: this.filters.dock,
                    location: this.location,
                    pets: this.filters.pets,
                    pool: this.filters.pool,
                    canal: this.filters.canal,
                    linens: this.filters.linens,
                    internet: this.filters.internet,

                }
            })
            .then(response => {
                this.numAvailable = response.data;
            })
                .catch(err => {
                    console.log(err);
                })

        },
        applyFilters() {
            this.$emit('apply-filters', this.filters)
        },
        toggleSearch() {
            this.searchIsOpen = !this.searchIsOpen;
        },
        toggleFilters() {
            this.filterIsOpen = !this.filterIsOpen;
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
.datepicker--open {
    z-index: 9999 !important;
}
.form-group {
    margin: 0 0 .5rem;
}
</style>
