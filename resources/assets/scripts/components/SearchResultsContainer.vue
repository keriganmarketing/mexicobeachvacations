<template>
<div class="row">
    <div class="col-md-4 col-lg-3 mb-4">
        <side-search-bar 
            :data-type="type"
            :data-location="location"
            @apply-filters="applyFilters" 
        >
        </side-search-bar>
    </div>
    <div class="col-md-8 col-lg-9 rental-feed">
        <div class="icon-key mt-3">
            <div class="row justify-content-center">
                <div class="col-6 col-sm-4 col-lg-2 text-center">
                    <img src="/themes/wordplate/assets/images/pool.png" alt="Pool Available" style="width: 30px;" >
                    <p>Pool Available</p>
                </div>
                <div class="col-6 col-sm-4 col-lg-2 text-center">
                    <img src="/themes/wordplate/assets/images/anchor.png" alt="Dock Available" style="width: 30px;" >
                    <p>Dock Available</p>
                </div>
                <div class="col-6 col-sm-4 col-lg-2 text-center">
                    <img src="/themes/wordplate/assets/images/canal.png" alt="Canal Front" style="width: 30px;" >
                    <p>Canal Front</p>
                </div>
                <div class="col-6 col-sm-4 col-lg-2 text-center">
                    <img src="/themes/wordplate/assets/images/internet.png" alt="Internet Access" style="width: 30px;" >
                    <p>Internet Access</p>
                </div>
                <div class="col-6 col-sm-4 col-lg-2 text-center">
                    <img src="/themes/wordplate/assets/images/linens.png" alt="Linens Provided" style="width: 30px;" >
                    <p>Linens Provided</p>
                </div>
                <div class="col-6 col-sm-4 col-lg-2 text-center">
                    <img src="/themes/wordplate/assets/images/pet-friendly.png" alt="Pet Friendly" style="width: 30px;" >
                    <p>Pet Friendly</p>
                </div>
            </div>
            <hr>
        </div>
        <unit-list :units="units"></unit-list>
    </div>
    <div class="offset-lg-3 d-flex justify-content-center align-items-center mb-4">
        <button class="btn btn-info" :class="{ 'disabled': pagination.prevPageUrl === null }" @click="prevPage">Previous</button>
        <button class="btn btn-outline-info">Page {{ pagination.currentPage }} of {{ pagination.pages }}</button>
        <button class="btn btn-info" :class="{ 'disabled': pagination.nextPageUrl === null }" @click="nextPage">Next</button>
    </div>
</div>
</template>

<script>
import Pagination from '../models/pagination.js';
import Qs from 'qs';
import UnitList from  './UnitList.vue';
export default {
    components: {
        UnitList
    },
    props: [
        'data-results', 
        'data-check-in', 
        'data-check-out', 
        'data-location', 
        'data-type',
        'data-filters'
    ],
    data() {
        return {
            units: [],
            pagination: null,
            checkIn: '',
            checkOut: '',
            location: '',
            type: '',
            filters: {},
        }
    },
    created () {
        this.units      = this.dataResults.data;
        this.checkIn    = this.dataCheckIn;
        this.checkOut   = this.dataCheckOut;
        this.location   = this.dataLocation;
        this.type       = this.dataType;
        this.pagination = new Pagination(this.dataResults);
    },
    methods: {
        applyFilters(filters, type) {
            let url = 'https://rns.mexicobeachvacations.com/search';
            this.filters = filters
            this.type = type;

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

                },
                paramsSerializer: function (params) {
                    return Qs.stringify(params, {encode: false}).replace(/[""]+/g, '');
                }
            })
            .then(response => {
                this.units = response.data.data;
                this.pagination = new Pagination(response.data);
            })
            .catch(err => {
                console.log(err);
            })
        },
        prevPage () {
            if (this.pagination.prevPageUrl) {
                axios.get(this.pagination.prevPageUrl)
                    .then(response => {
                        this.units = response.data.data;
                        this.pagination = new Pagination(response.data);
                        window.scrollTo(0, 0);
                })
            }
        },
        nextPage () {
            if (this.pagination.nextPageUrl) {
                axios.get(this.pagination.nextPageUrl)
                    .then(response => {
                        this.units = response.data.data;
                        this.pagination = new Pagination(response.data);
                        window.scrollTo(0, 0);
                })
            }
        }
    }
}

</script>

