<template>
<div class="row">
    <div class="col-md-4 col-lg-3 mb-4">
        <side-search-bar @apply-filters="applyFilters" ></side-search-bar>
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
        <div class="row no-gutters unit" v-for="unit in units" :key="unit.id">
            <div class="col-lg-4">
                <a class="property-image" :href="'/property/' + unit.rns_id + '/'" >
                    <img :src="unit.images[0].url" style="width:100%;" >
                </a>
                <div class="row no-gutters justify-content-center">
                    <div v-show="hasAmenity(unit, 45)" class="col-auto py-2 px-1">
                        <img src="/themes/wordplate/assets/images/pool.png" alt="Pool Available" style="width: 30px;" title="Pool Available" >
                    </div>
                    <div v-show="false" class="col-auto py-2 px-1">
                        <img src="/themes/wordplate/assets/images/anchor.png" alt="Dock Available" style="width: 30px;" title="Dock Available" >
                    </div>
                    <div v-show="hasSearchCriteria(unit, 'Canal Front')" class="col-auto py-2 px-1">
                        <img src="/themes/wordplate/assets/images/canal.png" alt="Canal Front" style="width: 30px;" title="Canal Front" >
                    </div>
                    <div v-show="hasAmenity(unit, 22)" class="col-auto py-2 px-1">
                        <img src="/themes/wordplate/assets/images/internet.png" alt="Internet Access" style="width: 30px;" title="Internet Access" >
                    </div>
                    <div v-show="hasAmenity(unit, 48)" class="col-auto py-2 px-1">
                        <img src="/themes/wordplate/assets/images/linens.png" alt="Linens Provided" style="width: 30px;" title="Linens Provided" >
                    </div>
                    <div v-show="hasAmenity(unit, 50)" class="col-auto py-2 px-1">
                        <img src="/themes/wordplate/assets/images/pet-friendly.png" alt="Pet Friendly" style="width: 30px;" title="Pet Friendly" >
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="rental-feed-info mt-3">
                <h2 class="text-primary"><a  :href="'/property/' + unit.rns_id + '/'" >{{ unit.name }}</a></h2>
                <p class="subhead d-flex flex-column">
                    <span v-for="sc in unit.search_criteria" :key="sc.id">&bull; {{ sc.name }}</span>
                </p>
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
                <a class="btn btn-lg btn-outline-info btn-rounded" :href="'/property/' + unit.rns_id + '/'" >View Property &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
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
            filters: {}
        }
    },
    mounted() {
        this.units      = this.dataResults.data;
        console.log(this.units);
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
        },
        hasAmenity(unit, rnsId){
            let hasAmenity = false;
            unit.amenities.map(amenity => {
                if (amenity.rns_id == rnsId && amenity.description !== 'No') hasAmenity = true;
            })
            return hasAmenity;
        },
        hasSearchCriteria(unit, name){
            let hasSearchCriteria = false;
            unit.search_criteria.map(search_criteria => {
                if (search_criteria.rns_id === name) hasSearchCriteria = true;
            })
            return hasSearchCriteria;
        }
    }
}

</script>
