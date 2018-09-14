<template>
<transition-group name="unit-list" appear>
    <div class="py-5 text-center unit-list-item" :key="'no-results'" v-if="units.length === 0" >
        <p>There are currently no properties matching your search criteria.</p>
    </div>
    <div class="row unit unit-list-item" v-for="unit in units" :key="unit.id">
        <div class="col-12 mb-2">
            <div class="d-flex justify-content-between align-items-center p-1 bg-dark px-4">
                <h2 class="p-0 m-0"><a class="text-white" :href="'/property/' + unit.rns_id + '/'" >{{ unit.name }}</a></h2>
                <div class="unit-icons row no-gutters justify-content-center">
                    <div v-show="hasAmenity(unit, 45)" class="col-auto p-1">
                        <div class="svg-icon active" >
                        <img src="/themes/wordplate/assets/images/pool.svg" alt="Pool Available" title="Pool Available" >
                        </div>
                    </div>
                    <div v-show="hasAmenity(unit, 47)" class="col-auto p-1">
                        <div class="svg-icon active" >
                        <img src="/themes/wordplate/assets/images/anchor.svg" alt="Dock Available" title="Dock Available" >
                        </div>
                    </div>
                    <div v-show="hasSearchCriteria(unit, 39)" class="col-auto p-1">
                        <div class="svg-icon active" >
                        <img src="/themes/wordplate/assets/images/canal.svg" alt="Canal Front" title="Canal Front" >
                        </div>
                    </div>
                    <div v-show="hasAmenity(unit, 22)" class="col-auto p-1">
                        <div class="svg-icon active" >
                        <img src="/themes/wordplate/assets/images/internet.svg" alt="Internet Access" title="Internet Access" >
                        </div>
                    </div>
                    <div v-show="hasAmenity(unit, 48)" class="col-auto p-1">
                        <div class="svg-icon active" >
                        <img src="/themes/wordplate/assets/images/linens.svg" alt="Linens Provided" title="Linens Provided" >
                        </div>
                    </div>
                    <div v-show="hasAmenity(unit, 50)" class="col-auto p-1">
                        <div class="svg-icon active" >
                        <img src="/themes/wordplate/assets/images/pet-friendly.svg" alt="Pet Friendly" title="Pet Friendly" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xl-3">
            <a class="property-image" :href="'/property/' + unit.rns_id + '/'" >
                <img :src="unit.images[0].url" style="width:100%;" >
            </a>
            
        </div>
        <div class="col-lg-8 col-xl-9">
            <div class="rental-feed-info">
                
                <div class="row no-gutters tiles justify-content-center align-items-center">
                    <div class="col-auto text-center p-2 px-3">
                        <span class="data fira text-orange">{{ unit.details[0].beds }}</span>
                        <span class="label fira text-info d-block">BEDS</span>
                    </div>
                    <div class="col-auto text-center p-2 px-3">
                        <span class="data fira text-orange">{{ unit.details[0].baths }}</span>
                        <span class="label fira text-info d-block">BATHS</span>
                    </div>
                    <div class="col-auto text-center p-2 px-3">
                        <span class="data fira text-orange">{{ unit.details[0].sleeps }}</span>
                        <span class="label fira text-info d-block">SLEEPS</span>
                    </div>
                    <div class="col-md-auto p-2 flex-grow-1">
                        <p class="subhead text-center">
                            <span class="px-3 py-1 m-1 fira text-uppercase d-inline-block bg-info text-white" v-for="sc in unit.search_criteria" :key="sc.id">{{ sc.name }}</span>
                        </p>
                    </div>
                </div>
                
                <p class="m-0">{{ unit.details[0].description }}</p>
            </div>
        </div>
        <div class="col-12 d-flex mb-5 py-4 justify-content-between">
            <a class="btn btn-lg btn-outline-info btn-rounded" :href="'/property/' + unit.rns_id + '/'" >View Property &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a v-if="hasSearchCriteria(unit, 41)" class="btn btn-lg btn-outline-primary btn-rounded" :href="'/book-now/?unit_id=' + unit.rns_id + '/'" >Book Now &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <p v-else class="fira text-primary">Call for </p>
        </div>
    </div>
</transition-group>
    
</template>

<script>
export default {
    props: ['units'],
    data() {
        return {
            
        }
    },
    methods: {
        hasAmenity(unit, rnsId){
            let hasAmenity = false;
            unit.amenities.map(amenity => {
                if (amenity.rns_id == rnsId && amenity.description !== 'No') hasAmenity = true;
            })
            return hasAmenity;
        },
        hasSearchCriteria(unit, rnsId){
            let hasSearchCriteria = false;
            unit.search_criteria.map(search_criteria => {
                if (search_criteria.rns_id === rnsId) hasSearchCriteria = true;
            })
            return hasSearchCriteria;
        },
    }
}

</script>
<style scoped lang="scss">
.unit-list-item {
    transition: all 0.3s;

}
.unit-list-enter, .unit-list-leave-to {
    opacity: 0;
    transform: translateX(30px);

}
.unit-list-leave-active {
    position: absolute;

}

.tiles .data {
    font-size: 1.5em;
    @media (min-width:768px){
        font-size: 2em;
    }
}

.svg-icon {
    height: 34px;
    width: 34px;
    padding: 8px;
    border-radius:50%;
    background-color: gray;
    display: flex;
    justify-content: center;
    align-items: center;

    &.active {
        background-color: #fa7a22;
    }

    img {
        display: block;
        width: 100%;
    }
}
</style>
