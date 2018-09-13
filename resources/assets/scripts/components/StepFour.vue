<template>
<div>
    <div class="mt-4">
        <h2>Step 4: Confirmation</h2>
        <div class="col alert alert-danger" v-if="errorMessages.length > 0">
            <ul>
                <li v-for="message in errorMessages" :key="message">{{ message }}</li>
            </ul>
        </div>
        <div v-else>
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-sm table-striped rate-table">
                        <tbody>
                            <tr>
                                <td class="data-label">Unit</td>
                                <td>{{ unit.name }}</td>
                            </tr>
                            <tr>
                                <td class="data-label">Check In </td>
                                <td>{{ info.ArrivalDate }}</td>
                            </tr>
                            <tr>
                                <td class="data-label">Check Out </td>
                                <td>{{ info.DepartureDate }}</td>
                            </tr>
                            <tr>
                                <td class="data-label">Persons</td>
                                <td>{{ info.Persons }}</td>
                            </tr>
                            <tr>
                                <td class="data-label">Persons</td>
                                <td>{{ info.Persons }}</td>
                            </tr>
                            <tr 
                                v-for="detail in rateDetails.GuestCharges" 
                                :key="detail.HeadingsListId" 
                                :class="{
                                    'text-primary': detail.HeadingName === 'Total Cost', 
                                    'font-weight-bold': detail.HeadingName === 'Total Cost' 
                                }"
                            >
                                <td class="data-label">{{ detail.HeadingName }}</td>
                                <td>{{ detail.ChgAmount.toLocaleString('en-US', { style: 'currency', currency: 'USD' }) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary" @click.prevent="booked">Book Now</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Validator from '../helpers/validate.js';
export default {
    props: ['data-info', 'unit', 'rate-details'],
    data() {
        return {
            validator: new Validator(this.dataInfo),
            errorMessages: [],
            info: this.dataInfo

        }
    },
    mounted() {
        if (! this.validator.passes()) {
            this.errorMessages = this.validator.errorMessages;
        }
    },
    methods: {
        booked() {
            this.$emit('booked');
        }
    }
}
</script>
