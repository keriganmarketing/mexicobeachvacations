<template>
    <div>
        <form>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input
                            type="text"
                            class="form-control bg-white text-dark"
                            placeholder="First Name"
                            v-model="form.first_name"
                            required
                        >
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input
                            type="text"
                            class="form-control bg-white text-dark"
                            placeholder="Last Name"
                            v-model="form.last_name"
                            required
                        >
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input
                            type="email"
                            class="form-control bg-white text-dark"
                            placeholder="Email"
                            v-model="form.email"
                            required
                        >
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input
                            type="text"
                            class="form-control bg-white text-dark"
                            placeholder="Phone"
                            v-model="form.phone"
                            required
                        >
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <textarea
                            class="form-control bg-white text-dark"
                            placeholder="Address"
                            v-model="form.address"
                            rows="5"
                            required
                        >
                        </textarea>

                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <textarea
                            class="form-control bg-white text-dark"
                            placeholder="Property description and comments"
                            v-model="form.comments"
                            rows="6"
                            required
                        >
                        </textarea>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-outline-primary" @click.prevent="formSubmitted">Send Message &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import PropertyForm from '../models/property-form';
    export default {
        data () {
            return {
                form: new PropertyForm({
                    first_name: '',
                    last_name: '',
                    email: '',
                    address: '',
                    phone: '',
                    comments: '',
                    url: '/wp-json/kerigansolutions/v1/submit-property-form'
                })
            }
        },
        computed: {
            hasError: function() {
                return this.form.hasError;
            },
            errorCode: function () {
                return this.form.errorCode;
            },
            success: function () {
                return this.form.success;
            }
        },
        methods: {
            formSubmitted () {
                this.form.submit();
            }
        }
    }
</script>
