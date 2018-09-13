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
            <div class="submitting text-center" v-if="submitting">
                <div class="lds-ellipsis">
                    <div></div><div></div><div></div><div></div>
                </div>
                <p>Hang on while we send your reservation.</p>
            </div>
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
                <div class="py-2 text-center" >
                    <button class="btn btn-lg btn-outline-primary btn-rounded" @click.prevent="booked">Book Now &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Validator from '../helpers/validate.js';
export default {
    props: ['data-info', 'unit', 'rate-details','submitting'],
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
<style lang="scss" scoped>
.submitting {
    position: fixed;
    background: rgba(255,255,255,.85);
    width: 100%;
    height: 100%;
    top: 0;
    z-index: 5000;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;

    .lds-ellipsis {
        display: inline-block;
        position: relative;
        width: 64px;
        height: 64px;
    }
    .lds-ellipsis div {
        position: absolute;
        top: 27px;
        width: 11px;
        height: 11px;
        border-radius: 50%;
        background: #4ebacb;
        animation-timing-function: cubic-bezier(0, 1, 1, 0);
    }
    .lds-ellipsis div:nth-child(1) {
        left: 6px;
        animation: lds-ellipsis1 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(2) {
        left: 6px;
        animation: lds-ellipsis2 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(3) {
        left: 26px;
        animation: lds-ellipsis2 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(4) {
        left: 45px;
        animation: lds-ellipsis3 0.6s infinite;
    }
    @keyframes lds-ellipsis1 {
        0% {
            transform: scale(0);
        }
        100% {
            transform: scale(1);
        }
    }
    @keyframes lds-ellipsis3 {
        0% {
            transform: scale(1);
        }
        100% {
            transform: scale(0);
        }
    }
    @keyframes lds-ellipsis2 {
        0% {
            transform: translate(0, 0);
        }
        100% {
            transform: translate(19px, 0);
        }
    }
}

</style>

