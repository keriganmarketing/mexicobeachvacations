<template>
    <form method="GET" action="/rentals">
        <input type="hidden" name="checkIn" :value="checkIn">
        <input type="hidden" name="checkOut" :value="checkOut">
        <input type="hidden" name="location" :value="location">
        <input type="hidden" name="type" :value="type">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
                <hotel-date-picker
                    class="input-rounded"
                    @checkInChanged="checkInChanged"
                    @checkOutChanged="checkOutChanged"
                    format="MM/DD/YY"
                    :showYear="true"
                >
                </hotel-date-picker> 
            </div>
            <div class="d-none d-sm-block col-12 col-sm-6 col-lg-3">
                <div class="form-group">
                <select class="custom-select input-rounded" v-model="location" @change="getMatches">
                    <option value="" >Location</option>
                    <option value="Beachfront" >Beachfront</option>
                    <option value="Between Hwy-Beach">Between highway and beach</option>
                    <option value="Across Hwy from Beach">Across highway from beach</option>
                </select>
                </div>
            </div>
            <div class="d-none d-sm-block col-12 col-sm-6 col-lg-3">
                <select class="custom-select input-rounded" v-model="type" @change="getMatches">
                    <option value="" >Type</option>
                    <option value="Vacation Rental">Vacation Rental</option>
                    <option value="Long Term Rental">Long Term Rental</option>
                </select>
            </div>
            <div class="col-12 col-md-6 col-lg-2">
                <button v-if="numAvailable == 0" class="btn btn-primary btn-rounded btn-block" disabled>Search</button>
                <button v-if="numAvailable > 0 || numAvailable == null" class="btn btn-primary btn-rounded btn-block">Search</button>
            </div>
            <div class="col-12 text-center text-white">
                <span v-if="numAvailable != null" >Properties matching your search: {{ numAvailable }}</span>
            </div>
        </div>
    </form>
</template>

<script>
import HotelDatePicker from 'vue-hotel-datepicker';
import moment from 'moment';
export default {
    components: {
        HotelDatePicker
    },
    data() {
        return {
            checkIn: '',
            checkOut: '',
            location: '',
            type: '',
            numAvailable: null,
        }
    },
    methods: {
        checkInChanged(date) {
            this.checkIn = moment(date).format("YYYY-MM-DD");
            this.getMatches();
        },
        checkOutChanged(date) {
            this.checkOut = moment(date).format("YYYY-MM-DD");
            this.getMatches();
        },
        getMatches() {
            let url = 'https://rns.mexicobeachvacations.com/matches?q=search&checkIn=' + this.checkIn + '&checkOut=' + this.checkOut + '&type=' + this.type + '&location=' + this.location;
            axios.get(url)
                .then(response => {
                    this.numAvailable = response.data;
                })
        }
    }
}

</script>
<style>
.input-rounded button {
    border: 0 !important;
    height: 44px !important;
}
.datepicker__wrapper,
.datepicker__dummy-wrapper {
    border: 0 !important;
    height: 44px !important;
}
.datepicker__clear-button {
    height: 40px !important;
    margin: 1px 0 0 0 !important;
}
.input-rounded {
    border-radius: 2em;
    border: 2px solid #46a5b5 !important;
    height: 44px;
}
.custom-select.input-rounded {
    padding: 0.425rem 1.75rem 0.375rem 1rem;
}
.btn-primary,
.btn-primary.disabled, 
.btn-primary:disabled {
    color: #FFF;
    opacity: 1 !important;
    border: 2px solid #46a5b5 !important;
}
.datepicker--open {
    z-index: 9999 !important;
}
.form-group {
    margin: 0 0 .5rem;
}

.datepicker__wrapper button.datepicker__input {
    width: 50% !important;
    padding: 0 20px !important;
    text-align: center;
    text-indent: 0 !important;
}

.datepicker__wrapper .datepicker__month-button {
    background: none !important;
    cursor: pointer;
    display: inline-block;
    height: 45px;
    width: 45px;
    border: 2px solid #ff6f74;
    border-radius: 50%;
    margin-bottom: 15px;
    padding: 14px 15px;
}

.datepicker__wrapper .datepicker__month-button::before {
    content: "\203A";
    color: #ff6f74;
    font-size: 30px;
}

.datepicker__wrapper {
    background: #fff url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2aWV3Qm94PSIwIDAgMTkuOTcgMjEuMzIiPjxkZWZzPjxzdHlsZT4uY2xzLTF7aXNvbGF0aW9uOmlzb2xhdGU7fS5jbHMtMntmaWxsOiNmZmY7fS5jbHMtM3tjbGlwLXBhdGg6dXJsKCNjbGlwLXBhdGgpO30uY2xzLTR7ZmlsbDpub25lO30uY2xzLTV7Y2xpcC1wYXRoOnVybCgjY2xpcC1wYXRoLTIpO30uY2xzLTZ7Y2xpcC1wYXRoOnVybCgjY2xpcC1wYXRoLTMpO30uY2xzLTd7Y2xpcC1wYXRoOnVybCgjY2xpcC1wYXRoLTQpO30uY2xzLTh7Y2xpcC1wYXRoOnVybCgjY2xpcC1wYXRoLTUpO30uY2xzLTl7Y2xpcC1wYXRoOnVybCgjY2xpcC1wYXRoLTYpO30uY2xzLTEwe2NsaXAtcGF0aDp1cmwoI2NsaXAtcGF0aC03KTt9LmNscy0xMXtjbGlwLXBhdGg6dXJsKCNjbGlwLXBhdGgtOCk7fS5jbHMtMTJ7Y2xpcC1wYXRoOnVybCgjY2xpcC1wYXRoLTkpO30uY2xzLTEze2NsaXAtcGF0aDp1cmwoI2NsaXAtcGF0aC0xMCk7fS5jbHMtMTR7ZmlsbDojOWI5YjliO30uY2xzLTE1e2NsaXAtcGF0aDp1cmwoI2NsaXAtcGF0aC0xMSk7fS5jbHMtMTZ7bWFzazp1cmwoI21hc2spO30uY2xzLTE3e2ZpbGw6I2ZmNmY3NDt9LmNscy0xOHttYXNrOnVybCgjbWFzay0yKTt9LmNscy0xOXtjbGlwLXBhdGg6dXJsKCNjbGlwLXBhdGgtMTQpO30uY2xzLTIwe21hc2s6dXJsKCNtYXNrLTMpO30uY2xzLTIxe2NsaXAtcGF0aDp1cmwoI2NsaXAtcGF0aC0xNSk7fS5jbHMtMjJ7bWFzazp1cmwoI21hc2stNCk7fS5jbHMtMjN7Y2xpcC1wYXRoOnVybCgjY2xpcC1wYXRoLTE2KTt9LmNscy0yNHttYXNrOnVybCgjbWFzay01KTt9LmNscy0yNXtjbGlwLXBhdGg6dXJsKCNjbGlwLXBhdGgtMTcpO30uY2xzLTI2e21hc2s6dXJsKCNtYXNrLTYpO30uY2xzLTI3e2NsaXAtcGF0aDp1cmwoI2NsaXAtcGF0aC0xOCk7fS5jbHMtMjh7bWFzazp1cmwoI21hc2stNyk7fS5jbHMtMjl7Y2xpcC1wYXRoOnVybCgjY2xpcC1wYXRoLTE5KTt9LmNscy0zMHttYXNrOnVybCgjbWFzay04KTt9LmNscy0zMXtjbGlwLXBhdGg6dXJsKCNjbGlwLXBhdGgtMjApO30uY2xzLTMye21hc2s6dXJsKCNtYXNrLTkpO30uY2xzLTMze2NsaXAtcGF0aDp1cmwoI2NsaXAtcGF0aC0yMSk7fS5jbHMtMzR7bWFzazp1cmwoI21hc2stMTApO30uY2xzLTM1e2NsaXAtcGF0aDp1cmwoI2NsaXAtcGF0aC0yMik7fS5jbHMtMzZ7bWFzazp1cmwoI21hc2stMTEpO30uY2xzLTM3e2NsaXAtcGF0aDp1cmwoI2NsaXAtcGF0aC0yMyk7fTwvc3R5bGU+PGNsaXBQYXRoIGlkPSJjbGlwLXBhdGgiPjxyZWN0IGNsYXNzPSJjbHMtNCIgeD0iMTAuNjciIHk9IjE2LjAyIiB3aWR0aD0iMi42NCIgaGVpZ2h0PSIyLjY1Ii8+PC9jbGlwUGF0aD48Y2xpcFBhdGggaWQ9ImNsaXAtcGF0aC0yIj48cmVjdCBjbGFzcz0iY2xzLTQiIHg9IjYuNjYiIHk9IjguMDIiIHdpZHRoPSIyLjY0IiBoZWlnaHQ9IjIuNjQiLz48L2NsaXBQYXRoPjxjbGlwUGF0aCBpZD0iY2xpcC1wYXRoLTMiPjxyZWN0IGNsYXNzPSJjbHMtNCIgeD0iNi42NiIgeT0iMTYuMDEiIHdpZHRoPSIyLjY1IiBoZWlnaHQ9IjIuNjQiLz48L2NsaXBQYXRoPjxjbGlwUGF0aCBpZD0iY2xpcC1wYXRoLTQiPjxyZWN0IGNsYXNzPSJjbHMtNCIgeD0iMi42NiIgeT0iMTYuMDEiIHdpZHRoPSIyLjY0IiBoZWlnaHQ9IjIuNjQiLz48L2NsaXBQYXRoPjxjbGlwUGF0aCBpZD0iY2xpcC1wYXRoLTUiPjxyZWN0IGNsYXNzPSJjbHMtNCIgeD0iMTQuNjYiIHk9IjEyLjAxIiB3aWR0aD0iMi42NCIgaGVpZ2h0PSIyLjY0Ii8+PC9jbGlwUGF0aD48Y2xpcFBhdGggaWQ9ImNsaXAtcGF0aC02Ij48cmVjdCBjbGFzcz0iY2xzLTQiIHg9IjEwLjY2IiB5PSIxMi4wMiIgd2lkdGg9IjIuNjQiIGhlaWdodD0iMi42NCIvPjwvY2xpcFBhdGg+PGNsaXBQYXRoIGlkPSJjbGlwLXBhdGgtNyI+PHJlY3QgY2xhc3M9ImNscy00IiB4PSI2LjY2IiB5PSIxMi4wMiIgd2lkdGg9IjIuNjQiIGhlaWdodD0iMi42NCIvPjwvY2xpcFBhdGg+PGNsaXBQYXRoIGlkPSJjbGlwLXBhdGgtOCI+PHJlY3QgY2xhc3M9ImNscy00IiB4PSIyLjY3IiB5PSIxMi4wMiIgd2lkdGg9IjIuNjQiIGhlaWdodD0iMi42NCIvPjwvY2xpcFBhdGg+PGNsaXBQYXRoIGlkPSJjbGlwLXBhdGgtOSI+PHJlY3QgY2xhc3M9ImNscy00IiB4PSIxNC42NiIgeT0iOC4wMSIgd2lkdGg9IjIuNjQiIGhlaWdodD0iMi42NCIvPjwvY2xpcFBhdGg+PGNsaXBQYXRoIGlkPSJjbGlwLXBhdGgtMTAiPjxyZWN0IGNsYXNzPSJjbHMtNCIgeD0iMTAuNjYiIHk9IjguMDEiIHdpZHRoPSIyLjY0IiBoZWlnaHQ9IjIuNjQiLz48L2NsaXBQYXRoPjxjbGlwUGF0aCBpZD0iY2xpcC1wYXRoLTExIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDApIj48cmVjdCBjbGFzcz0iY2xzLTQiIHdpZHRoPSIxOS45NyIgaGVpZ2h0PSIyMS4zMiIvPjwvY2xpcFBhdGg+PG1hc2sgaWQ9Im1hc2siIHg9IjAiIHk9IjAiIHdpZHRoPSIxOS45NyIgaGVpZ2h0PSIyMS4zMiIgbWFza1VuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwKSI+PHJlY3Qgd2lkdGg9IjE5Ljk3IiBoZWlnaHQ9IjIxLjMyIi8+PGcgY2xhc3M9ImNscy0xIj48cmVjdCBjbGFzcz0iY2xzLTIiIHdpZHRoPSIxOS45NyIgaGVpZ2h0PSIyMS4zMiIvPjwvZz48L2c+PC9tYXNrPjxtYXNrIGlkPSJtYXNrLTIiIHg9IjAiIHk9IjAiIHdpZHRoPSIxOS45NyIgaGVpZ2h0PSIyMS4zMiIgbWFza1VuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwKSI+PHJlY3QgeD0iMTAuNjciIHk9IjE2LjAyIiB3aWR0aD0iMi42NCIgaGVpZ2h0PSIyLjY1Ii8+PGcgY2xhc3M9ImNscy0xIj48ZyBjbGFzcz0iY2xzLTMiPjxyZWN0IGNsYXNzPSJjbHMtMiIgd2lkdGg9IjE5Ljk3IiBoZWlnaHQ9IjIxLjMyIi8+PC9nPjwvZz48L2c+PC9tYXNrPjxjbGlwUGF0aCBpZD0iY2xpcC1wYXRoLTE0IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDApIj48cmVjdCBjbGFzcz0iY2xzLTE0IiB4PSIxMC42NyIgeT0iMTYuMDEiIHdpZHRoPSIyLjY0IiBoZWlnaHQ9IjIuNjUiLz48L2NsaXBQYXRoPjxtYXNrIGlkPSJtYXNrLTMiIHg9IjAiIHk9IjAiIHdpZHRoPSIxOS45NyIgaGVpZ2h0PSIyMS4zMiIgbWFza1VuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwKSI+PHJlY3QgeD0iNi42NiIgeT0iMTYuMDEiIHdpZHRoPSIyLjY1IiBoZWlnaHQ9IjIuNjQiLz48ZyBjbGFzcz0iY2xzLTEiPjxnIGNsYXNzPSJjbHMtNiI+PHJlY3QgY2xhc3M9ImNscy0yIiB3aWR0aD0iMTkuOTciIGhlaWdodD0iMjEuMzIiLz48L2c+PC9nPjwvZz48L21hc2s+PGNsaXBQYXRoIGlkPSJjbGlwLXBhdGgtMTUiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgMCkiPjxyZWN0IGNsYXNzPSJjbHMtMTQiIHg9IjYuNjYiIHk9IjE2LjAxIiB3aWR0aD0iMi42NSIgaGVpZ2h0PSIyLjY0Ii8+PC9jbGlwUGF0aD48bWFzayBpZD0ibWFzay00IiB4PSIwIiB5PSIwIiB3aWR0aD0iMTkuOTciIGhlaWdodD0iMjEuMzIiIG1hc2tVbml0cz0idXNlclNwYWNlT25Vc2UiPjxnIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgMCkiPjxyZWN0IHg9IjIuNjYiIHk9IjE2LjAxIiB3aWR0aD0iMi42NCIgaGVpZ2h0PSIyLjY0Ii8+PGcgY2xhc3M9ImNscy0xIj48ZyBjbGFzcz0iY2xzLTciPjxyZWN0IGNsYXNzPSJjbHMtMiIgd2lkdGg9IjE5Ljk3IiBoZWlnaHQ9IjIxLjMyIi8+PC9nPjwvZz48L2c+PC9tYXNrPjxjbGlwUGF0aCBpZD0iY2xpcC1wYXRoLTE2IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDApIj48cmVjdCBjbGFzcz0iY2xzLTE0IiB4PSIyLjY2IiB5PSIxNi4wMSIgd2lkdGg9IjIuNjQiIGhlaWdodD0iMi42NCIvPjwvY2xpcFBhdGg+PG1hc2sgaWQ9Im1hc2stNSIgeD0iMCIgeT0iMCIgd2lkdGg9IjE5Ljk3IiBoZWlnaHQ9IjIxLjMyIiBtYXNrVW5pdHM9InVzZXJTcGFjZU9uVXNlIj48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDApIj48cmVjdCB4PSIxNC42NiIgeT0iMTIuMDEiIHdpZHRoPSIyLjY0IiBoZWlnaHQ9IjIuNjQiLz48ZyBjbGFzcz0iY2xzLTEiPjxnIGNsYXNzPSJjbHMtOCI+PHJlY3QgY2xhc3M9ImNscy0yIiB3aWR0aD0iMTkuOTciIGhlaWdodD0iMjEuMzIiLz48L2c+PC9nPjwvZz48L21hc2s+PGNsaXBQYXRoIGlkPSJjbGlwLXBhdGgtMTciIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgMCkiPjxyZWN0IGNsYXNzPSJjbHMtMTQiIHg9IjE0LjY2IiB5PSIxMi4wMSIgd2lkdGg9IjIuNjQiIGhlaWdodD0iMi42NCIvPjwvY2xpcFBhdGg+PG1hc2sgaWQ9Im1hc2stNiIgeD0iMCIgeT0iMCIgd2lkdGg9IjE5Ljk3IiBoZWlnaHQ9IjIxLjMyIiBtYXNrVW5pdHM9InVzZXJTcGFjZU9uVXNlIj48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDApIj48cmVjdCB4PSIxMC42NiIgeT0iMTIuMDIiIHdpZHRoPSIyLjY0IiBoZWlnaHQ9IjIuNjQiLz48ZyBjbGFzcz0iY2xzLTEiPjxnIGNsYXNzPSJjbHMtOSI+PHJlY3QgY2xhc3M9ImNscy0yIiB3aWR0aD0iMTkuOTciIGhlaWdodD0iMjEuMzIiLz48L2c+PC9nPjwvZz48L21hc2s+PGNsaXBQYXRoIGlkPSJjbGlwLXBhdGgtMTgiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgMCkiPjxyZWN0IGNsYXNzPSJjbHMtMTQiIHg9IjEwLjY2IiB5PSIxMi4wMiIgd2lkdGg9IjIuNjQiIGhlaWdodD0iMi42NCIvPjwvY2xpcFBhdGg+PG1hc2sgaWQ9Im1hc2stNyIgeD0iMCIgeT0iMCIgd2lkdGg9IjE5Ljk3IiBoZWlnaHQ9IjIxLjMyIiBtYXNrVW5pdHM9InVzZXJTcGFjZU9uVXNlIj48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDApIj48cmVjdCB4PSI2LjY2IiB5PSIxMi4wMiIgd2lkdGg9IjIuNjQiIGhlaWdodD0iMi42NCIvPjxnIGNsYXNzPSJjbHMtMSI+PGcgY2xhc3M9ImNscy0xMCI+PHJlY3QgY2xhc3M9ImNscy0yIiB3aWR0aD0iMTkuOTciIGhlaWdodD0iMjEuMzIiLz48L2c+PC9nPjwvZz48L21hc2s+PGNsaXBQYXRoIGlkPSJjbGlwLXBhdGgtMTkiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgMCkiPjxyZWN0IGNsYXNzPSJjbHMtMTQiIHg9IjYuNjYiIHk9IjEyLjAyIiB3aWR0aD0iMi42NCIgaGVpZ2h0PSIyLjY0Ii8+PC9jbGlwUGF0aD48bWFzayBpZD0ibWFzay04IiB4PSIwIiB5PSIwIiB3aWR0aD0iMTkuOTciIGhlaWdodD0iMjEuMzIiIG1hc2tVbml0cz0idXNlclNwYWNlT25Vc2UiPjxnIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgMCkiPjxyZWN0IHg9IjIuNjciIHk9IjEyLjAyIiB3aWR0aD0iMi42NCIgaGVpZ2h0PSIyLjY0Ii8+PGcgY2xhc3M9ImNscy0xIj48ZyBjbGFzcz0iY2xzLTExIj48cmVjdCBjbGFzcz0iY2xzLTIiIHdpZHRoPSIxOS45NyIgaGVpZ2h0PSIyMS4zMiIvPjwvZz48L2c+PC9nPjwvbWFzaz48Y2xpcFBhdGggaWQ9ImNsaXAtcGF0aC0yMCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwKSI+PHJlY3QgY2xhc3M9ImNscy0xNCIgeD0iMi42NyIgeT0iMTIuMDEiIHdpZHRoPSIyLjY0IiBoZWlnaHQ9IjIuNjQiLz48L2NsaXBQYXRoPjxtYXNrIGlkPSJtYXNrLTkiIHg9IjAiIHk9IjAiIHdpZHRoPSIxOS45NyIgaGVpZ2h0PSIyMS4zMiIgbWFza1VuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwKSI+PHJlY3QgeD0iMTQuNjYiIHk9IjguMDEiIHdpZHRoPSIyLjY0IiBoZWlnaHQ9IjIuNjQiLz48ZyBjbGFzcz0iY2xzLTEiPjxnIGNsYXNzPSJjbHMtMTIiPjxyZWN0IGNsYXNzPSJjbHMtMiIgd2lkdGg9IjE5Ljk3IiBoZWlnaHQ9IjIxLjMyIi8+PC9nPjwvZz48L2c+PC9tYXNrPjxjbGlwUGF0aCBpZD0iY2xpcC1wYXRoLTIxIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDApIj48cmVjdCBjbGFzcz0iY2xzLTE0IiB4PSIxNC42NiIgeT0iOC4wMSIgd2lkdGg9IjIuNjQiIGhlaWdodD0iMi42NCIvPjwvY2xpcFBhdGg+PG1hc2sgaWQ9Im1hc2stMTAiIHg9IjAiIHk9IjAiIHdpZHRoPSIxOS45NyIgaGVpZ2h0PSIyMS4zMiIgbWFza1VuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwKSI+PHJlY3QgeD0iMTAuNjYiIHk9IjguMDEiIHdpZHRoPSIyLjY0IiBoZWlnaHQ9IjIuNjQiLz48ZyBjbGFzcz0iY2xzLTEiPjxnIGNsYXNzPSJjbHMtMTMiPjxyZWN0IGNsYXNzPSJjbHMtMiIgd2lkdGg9IjE5Ljk3IiBoZWlnaHQ9IjIxLjMyIi8+PC9nPjwvZz48L2c+PC9tYXNrPjxjbGlwUGF0aCBpZD0iY2xpcC1wYXRoLTIyIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDApIj48cmVjdCBjbGFzcz0iY2xzLTE0IiB4PSIxMC42NiIgeT0iOC4wMSIgd2lkdGg9IjIuNjQiIGhlaWdodD0iMi42NCIvPjwvY2xpcFBhdGg+PG1hc2sgaWQ9Im1hc2stMTEiIHg9IjAiIHk9IjAiIHdpZHRoPSIxOS45NyIgaGVpZ2h0PSIyMS4zMiIgbWFza1VuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwKSI+PHJlY3QgeD0iNi42NiIgeT0iOC4wMiIgd2lkdGg9IjIuNjQiIGhlaWdodD0iMi42NCIvPjxnIGNsYXNzPSJjbHMtMSI+PGcgY2xhc3M9ImNscy01Ij48cmVjdCBjbGFzcz0iY2xzLTIiIHdpZHRoPSIxOS45NyIgaGVpZ2h0PSIyMS4zMiIvPjwvZz48L2c+PC9nPjwvbWFzaz48Y2xpcFBhdGggaWQ9ImNsaXAtcGF0aC0yMyIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAwKSI+PHJlY3QgY2xhc3M9ImNscy0xNCIgeD0iNi42NiIgeT0iOC4wMiIgd2lkdGg9IjIuNjQiIGhlaWdodD0iMi42NCIvPjwvY2xpcFBhdGg+PC9kZWZzPjx0aXRsZT5jYWxlbmRhcjwvdGl0bGU+PGcgaWQ9IkxheWVyXzIiIGRhdGEtbmFtZT0iTGF5ZXIgMiI+PGcgaWQ9IkxheWVyXzEtMiIgZGF0YS1uYW1lPSJMYXllciAxIj48ZyBjbGFzcz0iY2xzLTE1Ij48ZyBjbGFzcz0iY2xzLTE1Ij48ZyBjbGFzcz0iY2xzLTE2Ij48ZyBjbGFzcz0iY2xzLTE1Ij48cGF0aCBjbGFzcz0iY2xzLTE3IiBkPSJNNCw0SDUuM1YxLjM1SDRaTTE0LjY3LDRIMTZWMS4zNUgxNC42N1pNMS4zMywyMEgxOC42NFY2LjY4SDEuMzNaTTEzLjgyLDBoM2EuNzcuNzcsMCwwLDEsLjUxLjg0YzAsLjU0LDAsMS4wOCwwLDEuNjN2LjIxSDIwVjIxLjMySDBWMi42NkgyLjY1YzAtLjYyLDAtMS4yMiwwLTEuODJBLjc4Ljc4LDAsMCwxLDMuMTUsMGgzYS43OC43OCwwLDAsMSwuNS44NGMwLC41NSwwLDEuMSwwLDEuNjUsMCwuMDYsMCwuMTIsMCwuMTdoNi42NWMwLS42MSwwLTEuMjIsMC0xLjgyYS43OC43OCwwLDAsMSwuNS0uODQiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgMCkiLz48L2c+PC9nPjxnIGNsYXNzPSJjbHMtMTgiPjxyZWN0IGNsYXNzPSJjbHMtMTQiIHg9IjEwLjY3IiB5PSIxNi4wMSIgd2lkdGg9IjIuNjQiIGhlaWdodD0iMi42NSIvPjxnIGNsYXNzPSJjbHMtMTkiPjxyZWN0IGNsYXNzPSJjbHMtMTciIHg9IjEwLjY3IiB5PSIxNi4wMiIgd2lkdGg9IjIuNjQiIGhlaWdodD0iMi42NSIvPjwvZz48L2c+PGcgY2xhc3M9ImNscy0yMCI+PHJlY3QgY2xhc3M9ImNscy0xNCIgeD0iNi42NiIgeT0iMTYuMDEiIHdpZHRoPSIyLjY1IiBoZWlnaHQ9IjIuNjQiLz48ZyBjbGFzcz0iY2xzLTIxIj48cmVjdCBjbGFzcz0iY2xzLTE3IiB4PSI2LjY2IiB5PSIxNi4wMSIgd2lkdGg9IjIuNjUiIGhlaWdodD0iMi42NCIvPjwvZz48L2c+PGcgY2xhc3M9ImNscy0yMiI+PHJlY3QgY2xhc3M9ImNscy0xNCIgeD0iMi42NiIgeT0iMTYuMDEiIHdpZHRoPSIyLjY0IiBoZWlnaHQ9IjIuNjQiLz48ZyBjbGFzcz0iY2xzLTIzIj48cmVjdCBjbGFzcz0iY2xzLTE3IiB4PSIyLjY2IiB5PSIxNi4wMSIgd2lkdGg9IjIuNjQiIGhlaWdodD0iMi42NCIvPjwvZz48L2c+PGcgY2xhc3M9ImNscy0yNCI+PHJlY3QgY2xhc3M9ImNscy0xNCIgeD0iMTQuNjYiIHk9IjEyLjAxIiB3aWR0aD0iMi42NCIgaGVpZ2h0PSIyLjY0Ii8+PGcgY2xhc3M9ImNscy0yNSI+PHJlY3QgY2xhc3M9ImNscy0xNyIgeD0iMTQuNjYiIHk9IjEyLjAxIiB3aWR0aD0iMi42NCIgaGVpZ2h0PSIyLjY0Ii8+PC9nPjwvZz48ZyBjbGFzcz0iY2xzLTI2Ij48cmVjdCBjbGFzcz0iY2xzLTE0IiB4PSIxMC42NiIgeT0iMTIuMDIiIHdpZHRoPSIyLjY0IiBoZWlnaHQ9IjIuNjQiLz48ZyBjbGFzcz0iY2xzLTI3Ij48cmVjdCBjbGFzcz0iY2xzLTE3IiB4PSIxMC42NiIgeT0iMTIuMDIiIHdpZHRoPSIyLjY0IiBoZWlnaHQ9IjIuNjQiLz48L2c+PC9nPjxnIGNsYXNzPSJjbHMtMjgiPjxyZWN0IGNsYXNzPSJjbHMtMTQiIHg9IjYuNjYiIHk9IjEyLjAyIiB3aWR0aD0iMi42NCIgaGVpZ2h0PSIyLjY0Ii8+PGcgY2xhc3M9ImNscy0yOSI+PHJlY3QgY2xhc3M9ImNscy0xNyIgeD0iNi42NiIgeT0iMTIuMDIiIHdpZHRoPSIyLjY0IiBoZWlnaHQ9IjIuNjQiLz48L2c+PC9nPjxnIGNsYXNzPSJjbHMtMzAiPjxyZWN0IGNsYXNzPSJjbHMtMTQiIHg9IjIuNjciIHk9IjEyLjAxIiB3aWR0aD0iMi42NCIgaGVpZ2h0PSIyLjY0Ii8+PGcgY2xhc3M9ImNscy0zMSI+PHJlY3QgY2xhc3M9ImNscy0xNyIgeD0iMi42NyIgeT0iMTIuMDEiIHdpZHRoPSIyLjY0IiBoZWlnaHQ9IjIuNjQiLz48L2c+PC9nPjxnIGNsYXNzPSJjbHMtMzIiPjxyZWN0IGNsYXNzPSJjbHMtMTQiIHg9IjE0LjY2IiB5PSI4LjAxIiB3aWR0aD0iMi42NCIgaGVpZ2h0PSIyLjY0Ii8+PGcgY2xhc3M9ImNscy0zMyI+PHJlY3QgY2xhc3M9ImNscy0xNyIgeD0iMTQuNjYiIHk9IjguMDEiIHdpZHRoPSIyLjY0IiBoZWlnaHQ9IjIuNjQiLz48L2c+PC9nPjxnIGNsYXNzPSJjbHMtMzQiPjxyZWN0IGNsYXNzPSJjbHMtMTQiIHg9IjEwLjY2IiB5PSI4LjAxIiB3aWR0aD0iMi42NCIgaGVpZ2h0PSIyLjY0Ii8+PGcgY2xhc3M9ImNscy0zNSI+PHJlY3QgY2xhc3M9ImNscy0xNyIgeD0iMTAuNjYiIHk9IjguMDEiIHdpZHRoPSIyLjY0IiBoZWlnaHQ9IjIuNjQiLz48L2c+PC9nPjxnIGNsYXNzPSJjbHMtMzYiPjxyZWN0IGNsYXNzPSJjbHMtMTQiIHg9IjYuNjYiIHk9IjguMDIiIHdpZHRoPSIyLjY0IiBoZWlnaHQ9IjIuNjQiLz48ZyBjbGFzcz0iY2xzLTM3Ij48cmVjdCBjbGFzcz0iY2xzLTE3IiB4PSI2LjY2IiB5PSI4LjAyIiB3aWR0aD0iMi42NCIgaGVpZ2h0PSIyLjY0Ii8+PC9nPjwvZz48L2c+PC9nPjwvZz48L2c+PC9zdmc+) no-repeat 17px/16px !important;
}

.datepicker__wrapper.input-rounded .datepicker__dummy-input--is-active {
    color: #ff6f74;
}

.datepicker__wrapper .square:hover {
    border-radius: 50%;
    cursor: pointer;
    background-color: #ddd;
}

.datepicker__wrapper .datepicker__clear-button {
    color: #ff6f74;
    height: 41px !important;
}

.datepicker__wrapper .datepicker__month-day--selected {
    background-color: rgba(255,111,116,.6);
}

.datepicker__wrapper .datepicker__month-day--first-day-selected {
    border-radius: 2rem 0 0 2rem;
    background-color: #ff6f74;
}

.datepicker__wrapper .datepicker__month-day--last-day-selected {
    border-radius: 0 2rem 2rem 0;
    background-color: #ff6f74;
}

@media (min-width:768px){
    .datepicker__wrapper .datepicker {
        left: 50%;
        top: 50%;
        position: fixed;
        z-index: 2;
        margin: -190px 0 0 -345px;
    }
}
</style>
