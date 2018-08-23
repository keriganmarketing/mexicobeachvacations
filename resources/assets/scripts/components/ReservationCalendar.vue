<template>
    <calendar-view
        :show-date="showDate"
        class="theme-default holiday-us-traditional holiday-us-official"
    >
    </calendar-view>
    
</template>

<script>
import CalendarView from "vue-simple-calendar"
require("vue-simple-calendar/dist/static/css/default.css");
require("vue-simple-calendar/dist/static/css/holidays-us.css");
export default {
    components: {
        CalendarView
    },
    data() {
        return {
            showDate: new Date(),
        }
    }
}

</script>
