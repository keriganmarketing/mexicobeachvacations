<template>
<div class="row">
    <div class="col-md-4 col-lg-3 mb-4">
        <side-search-bar @apply-filters="applyFilters"></side-search-bar>
    </div>
    <div class="col-md-8 col-lg-9 rental-feed">
        <div class="row no-gutters unit" v-for="unit in units" :key="unit.id">
            <div class="col-lg-4">
                <a class="property-image" :href="'/property?id=' + unit.rns_id" >
                <img :src="unit.images[0].url" style="width:100%;" >
                </a>
            </div>
            <div class="col-lg-8">
                <div class="rental-feed-info mt-3">
                <h2 class="text-primary"><a  :href="'/property?id=' + unit.rns_id" >{{ unit.name }}</a></h2>
                <p class="subhead"><span class="type">{{ unit.type }}</span> &bull;
                <span class="location">{{ unit.location }}</span></p>
                <div class="row no-gutters tiles">
                    <div class="col-auto">
                        <span class="data">{{ unit.details[0].beds }}</span>
                        <span class="label">BEDS</span>
                    </div>
                    <div class="col-auto">
                        <span class="data">{{ unit.details[0].baths }}</span>
                        <span class="label">BATHS</span>
                    </div>
                    <div class="col-auto">
                        <span class="data">{{ unit.details[0].sleeps }}</span>
                        <span class="label">SLEEPS</span>
                    </div>
                </div>
                <p>{{ unit.details[0].description }}</p>
                <a class="btn btn-lg btn-outline-info btn-rounded" :href="'/property?id=' + unit.rns_id" >View Property &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Pagination from '../models/pagination.js';
import Qs from 'qs';
export default {
    props: [
        'data-results', 
        'data-check-in', 
        'data-check-out', 
        'data-location', 
        'data-type'
    ],
    data() {
        return {
            units: [],
            pagination: null,
            checkIn: '',
            checkOut: '',
            location: '',
            type: '',
            filters: {}
        }
    },
    mounted() {
        this.units      = this.dataResults.data;
        this.pagination = new Pagination(this.dataResults);
        this.checkIn    = this.dataCheckIn;
        this.checkOut   = this.dataCheckOut;
        this.location   = this.dataLocation;
        this.type       = this.dataType;
    },
    methods: {
        applyFilters(filters) {
            let url = 'https://rns.mexicobeachvacations.com/search';
            this.filters = filters

            axios.get(url, {
                params: {
                    type: this.type.replace,
                    checkIn: this.checkIn,
                    checkOut: this.checkOut,
                    dock: this.filters.dock,
                    location: this.location,
                    pets: this.filters.pets,
                    pool: this.filters.pool,
                    canal: this.filters.canal,
                    linens: this.filters.linens,
                    internet: this.filters.internet,

                },
                paramsSerializer: function (params) {
                    return Qs.stringify(params, {encode: false}).replace(/[""]+/g, '');
                }
            })
            .then(response => {
                this.units = response.data.data;
            })
            .catch(err => {
                console.log(err);
            })
        }
    }
}

</script>
