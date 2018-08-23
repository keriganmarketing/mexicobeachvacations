<template>
    <div v-if="propertyLoaded" class="full-property" >
        <header class="text-primary">
            <h1 style="text-transform: capitalize;">{{ property.name.toLowerCase() }} <span class="unitid fira d-inline-block">Unit ID: {{ property.details[0].prop_number }}</span></h1>
            <h2 class="proprty-address">{{ property.details[0].address }}</h2>
        </header>

        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">                    
                <img :src="property.images[0].url" :alt="property.images[0].description" class="img-fluid" >
            </div>
            <div class="col-md-8 property-info mb-4">
                
                <div class="row no-gutters tiles align-items-center full-width text-center text-md-left">
                    <div class="col-md-auto">
                        <h2 class="subhead"><span class="type">{{ property.type }}</span> &bull;
                        <span class="location">{{ property.location }}</span></h2>
                    </div>
                    <div class="col-12 col-md-auto flex-grow-1 text-md-right" >
                        <a href="#" class="btn btn-lg btn-primary btn-rounded btn-outline-primary">Book Now</a>
                    </div>
                </div>

                <hr>

                <div class="row no-gutters tiles align-items-center full-width text-center justify-content-center justify-content-start-md">
                    <div class="col-auto my-1">
                        <span class="data">{{ property.details[0].beds }}</span>
                        <span class="label">BEDS</span>
                    </div>
                    <div class="col-auto my-1">
                        <span class="data">{{ property.details[0].baths }}</span>
                        <span class="label">BATHS</span>
                    </div>
                    <div class="col-auto my-1">
                        <span class="data">{{ property.details[0].sleeps }}</span>
                        <span class="label">SLEEPS</span>
                    </div>
                    <div class="col-12 col-md-auto action-buttons flex-grow-1 text-xl-right" >
                        <a class="btn btn-info btn-rounded my-1" href="#rates" >Rates</a>
                        <a class="btn btn-info btn-rounded my-1" href="#availability" >Availability</a>
                        <a class="btn btn-info btn-rounded my-1" href="#photos" >Photos</a>
                        <a class="btn btn-info btn-rounded my-1" href="#location" >Location</a>
                    </div>
                </div>

                <hr>

                <p v-html="property.details[0].description"></p>

            </div>

        </div>

        <div class="row mb-4">

            <div class="col-md-6">
                <a name="amenities"></a>
                <h2>Amenties</h2>
                <div class="table-responsive">
                <table class="table table-sm table-striped amenity-table">
                    <tbody>
                        <tr v-for="amenity in property.amenities" :key="amenity.id">
                            <td class="data-label">{{ amenity.name }}</td><td>{{ amenity.description }}</td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="col-md-6">
                <a name="rates"></a>
                <h2>Rates</h2>
                <div class="table-responsive">
                    <table class="table table-sm table-striped rate-table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Date Range</th><th>Monthly</th><th>Weekly</th><th>Daily</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="rate in property.rates" :key="rate.id">
                                <td class="data-label">{{ formatDateRange(rate.start_date, rate.end_date) }}</td>
                                <td>{{ formatRate(rate.monthly) }}</td>
                                <td>{{ formatRate(rate.weekly) }}</td>
                                <td>{{ formatRate(rate.daily) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <hr>
                <a name="photos"></a>
                <h2>Photos</h2>
                <photo-gallery :data-photos="property.images" ></photo-gallery>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <hr>
                <a name="availability"></a>
                <h2>Availability</h2>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <hr>
                <a name="location"></a>
                <h2>Location</h2>
                <div class="listing-map-frame">
                    <div class="embed-responsive embed-responsive-16by9" style="border:1px solid #ddd;">
                        <iframe 
                            class="embed-responsive-item"
                            frameborder="0" 
                            scrolling="no" 
                            marginheight="0" 
                            marginwidth="0" 
                            :src="'https://maps.google.com/maps?q=' + property.details[0].address + ', FL&hl=es;z=14&amp;output=embed'"
                        ></iframe>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import moment from 'moment';
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
    },
    methods: {
        formatDate(date){
            return moment(date).format("MM/DD/YYYY");
        },
        formatDateRange(startDate, endDate){
            return moment(startDate).format("MM/DD") + ' - ' + moment(endDate).format("MM/DD/YYYY");
        },
        formatRate(num){
            return (num !== 0 ? '$' + num.toLocaleString() : 'N/A');
        }

    }

}
</script>
<style>
.action-buttons {
    padding: 0 1rem;
}
.action-buttons a {
    margin: 0 .5rem;
}
.unitid {
    color: #ff6f74;
    font-size: .5em;
}
</style>
