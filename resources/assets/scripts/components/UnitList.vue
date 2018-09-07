<template>
<transition-group name="unit-list" appear>
    <div class="row no-gutters unit unit-list-item" v-for="unit in units" :key="unit.id">
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
        hasSearchCriteria(unit, name){
            let hasSearchCriteria = false;
            unit.search_criteria.map(search_criteria => {
                if (search_criteria.rns_id === name) hasSearchCriteria = true;
            })
            return hasSearchCriteria;
        },
    }
}

</script>
<style scoped>
.unit-list-item {
    transition: all 0.5s;

}
.unit-list-enter, .unit-list-leave-to {
    opacity: 0;
    transform: translateY(30px);

}
.unit-list-leave-active {
    position: absolute;

}
</style>
