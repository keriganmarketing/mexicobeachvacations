<template>
<div>
    <div>
        <side-search-bar 
            :data-type="type"
            :data-location="location"
            :data-checkin="checkIn"
            :data-checkout="checkOut"
            @apply-filters="applyFilters" 
        >
        </side-search-bar>
    </div>
    <div>
        <unit-list :units="units"></unit-list>
    </div>
    <div class="d-flex justify-content-center align-items-center mb-4">
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
        'data-pool',
        'data-name'
    ],
    data() {
        return {
            units: [],
            pagination: null,
            checkIn: '',
            checkOut: '',
            location: '',
            type: '',
            propName: '',
            filters: {},
        }
    },
    created () {
        this.units      = this.dataResults.data;
        this.checkIn    = this.dataCheckIn;
        this.checkOut   = this.dataCheckOut;
        this.location   = this.dataLocation;
        this.type       = this.dataType;
        this.propName   = this.dataName;
        this.pagination = new Pagination(this.dataResults);
    },
    methods: {
        applyFilters(filters, type, propName) {
            let url = 'https://rns.mexicobeachvacations.com/search';
            this.filters = filters
            this.type = type;
            this.propName = propName;

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
                    name: this.propName
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

