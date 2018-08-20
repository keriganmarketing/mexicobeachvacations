<template>
    <i class="wi" :class="weatherIcon"></i>
</template>

<script>
import WeatherIcon from '../models/weather-icon.js';
export default {
    props: ['code'],
    data() {
        return {
            weatherIcon: null,
            cssClass: ''
        }
    },
    mounted(){
        this.weatherIcon = new WeatherIcon(this.code).get();
    }
}
</script>
