<template>
    <div v-if="propertyLoaded" >
        <header class="text-primary">
            <h1>{{ property.name }} <span class="label">Unit ID: {{ property.details[0].prop_number }}</span></h1>
            <p class="proprty-address text-dark">{{ property.details[0].address }}</p>
        </header>

        <div class="row">
            <div class="col-md-6 col-lg-4">                    
                <img :src="property.images[0].url" :alt="property.images[0].description" class="img-fluid" >
                <photo-gallery :data-photos="property.images" ></photo-gallery>
            </div>
            <div class="col-8">
                <p class="subhead"><span class="type">{{ property.type }}</span> &bull;
                <span class="location">{{ property.location }}</span></p>
                <div class="row no-gutters tiles">
                    <div class="col-auto">
                        <span class="data">{{ property.details[0].beds }}</span>
                        <span class="label">BEDS</span>
                    </div>
                    <div class="col-auto">
                        <span class="data">{{ property.details[0].baths }}</span>
                        <span class="label">BATHS</span>
                    </div>
                    <div class="col-auto">
                        <span class="data">{{ property.details[0].sleeps }}</span>
                        <span class="label">SLEEPS</span>
                    </div>
                </div>

                <table class="table table-striped amenity-table">
                    <tr v-for="amenity in property.amenities" :key="amenity.id">
                        <td class="label">{{ amenity.name }}</td><td>{{ amenity.description }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['rnsId'],
    data(){
        return {
            property: {},
            propertyLoaded: false
        }
    },
    mounted(){
        axios.get('https://rns.mexicobeachvacations.com/units/' + this.rnsId)
        .then(response => {
            this.property = response.data;
            this.propertyLoaded = true;
        })
        .catch(err => {
            console.log(err);
        })
    }
}
</script>