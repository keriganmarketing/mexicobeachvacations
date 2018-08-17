export default class WeatherIcon {

    constructor (code) {
        this.code = code;
        this.icon = '';
    }
    
    get () {
        switch(this.code) {
            case '0': this.icon  = 'wi-tornado';
                break;
            case '1': this.icon = 'wi-storm-showers';
                break;
            case '2': this.icon = 'wi-tornado';
                break;
            case '3': this.icon = 'wi-thunderstorm';
                break;
            case '4': this.icon = 'wi-thunderstorm';
                break;
            case '5': this.icon = 'wi-snow';
                break;
            case '6': this.icon = 'wi-rain-mix';
                break;
            case '7': this.icon = 'wi-rain-mix';
                break;
            case '8': this.icon = 'wi-sprinkle';
                break;
            case '9': this.icon = 'wi-sprinkle';
                break;
            case '10': this.icon = 'wi-hail';
                break;
            case '11': this.icon = 'wi-showers';
                break;
            case '12': this.icon = 'wi-showers';
                break;
            case '13': this.icon = 'wi-snow';
                break;
            case '14': this.icon = 'wi-storm-showers';
                break;
            case '15': this.icon = 'wi-snow';
                break;
            case '16': this.icon = 'wi-snow';
                break;
            case '17': this.icon = 'wi-hail';
                break;
            case '18': this.icon = 'wi-hail';
                break;
            case '19': this.icon = 'wi-cloudy-gusts';
                break;
            case '20': this.icon = 'wi-fog';
                break;
            case '21': this.icon = 'wi-fog';
                break;
            case '22': this.icon = 'wi-fog';
                break;
            case '23': this.icon = 'wi-cloudy-gusts';
                break;
            case '24': this.icon = 'wi-cloudy-windy';
                break;
            case '25': this.icon = 'wi-thermometer';
                break;
            case '26': this.icon = 'wi-cloudy';
                break;
            case '27': this.icon = 'wi-night-cloudy';
                break;
            case '28': this.icon = 'wi-day-cloudy';
                break;
            case '29': this.icon = 'wi-night-cloudy';
                break;
            case '30': this.icon = 'wi-day-cloudy';
                break;
            case '31': this.icon = 'wi-night-clear';
                break;
            case '32': this.icon = 'wi-day-sunny';
                break;
            case '33': this.icon = 'wi-night-clear';
                break;
            case '34': this.icon = 'wi-day-sunny-overcast';
                break;
            case '35': this.icon = 'wi-hail';
                break;
            case '36': this.icon = 'wi-day-sunny';
                break;
            case '37': this.icon = 'wi-thunderstorm';
                break;
            case '38': this.icon = 'wi-thunderstorm';
                break;
            case '39': this.icon = 'wi-thunderstorm';
                break;
            case '40': this.icon = 'wi-storm-showers';
                break;
            case '41': this.icon = 'wi-snow';
                break;
            case '42': this.icon = 'wi-snow';
                break;
            case '43': this.icon = 'wi-snow';
                break;
            case '44': this.icon = 'wi-cloudy';
                break;
            case '45': this.icon = 'wi-lightning';
                break;
            case '46': this.icon = 'wi-snow';
                break;
            case '47': this.icon = 'wi-thunderstorm';
                break;
            case '3200': this.icon = 'wi-cloud';
                break;
            default: this.icon = 'wi-cloud';
                break;
        }     

        return this.icon;
    }

}
