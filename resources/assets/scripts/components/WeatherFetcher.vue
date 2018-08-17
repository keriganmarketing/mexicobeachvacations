<script>
import WeatherIcon from '../models/weather-icon.js';
export default {
    props: ['location'],
    data() {
        return {
            baseUrl: 'https://query.yahooapis.com/v1/public/yql?q=',
            query: '',
            weatherInfo: null,
            weatherIcon: null,
            loading: true
        }
    },
    mounted () {
        this.query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="' + this.location + '")'
        axios.get(this.baseUrl + encodeURIComponent(this.query) + '&format=json')
            .then(response => {
                this.weatherInfo = response.data.query.results.channel;
                this.weatherIcon = new WeatherIcon(this.weatherInfo.item.condition.code).get();
                this.loading = false;
            })
    },
    render () {
        return this.$scopedSlots.default({
            weatherInfo: this.weatherInfo,
            weatherIcon: this.weatherIcon,
            loading: this.loading
        })
    }
}

</script>
