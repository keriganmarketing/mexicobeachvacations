<template>
<div>
    <div class="mt-4">
        <h2>Step 2: Contact Info</h2>
    </div>
    <div class="row">
        <div class="col-md-4" >
            <label for="FirstName">First Name <span class="required">*</span></label>
            <div class="form-group">
                <input type="text" class="form-control" v-model="info.FirstName" id="FirstName" required />
            </div>
        </div>
        <div class="col-md-4" >
            <label for="LastName">Last Name <span class="required">*</span></label>
            <div class="form-group">
                <input type="text" class="form-control" v-model="info.LastName" id="LastName" />
            </div>
        </div>
        <div class="col-md-4" >
            <label for="MiddleInitial">Middle Initial</label>
            <div class="form-group">
                <input type="text" class="form-control" v-model="info.MiddleInitial" id="MiddleInitial" required />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="email">Email Address <span class="required">*</span></label>
            <div class="form-group">
                <input id="email" class="form-control" type="email" name="email" v-model="info.Email" required>
            </div>
            <label for="email_confirmation" class="sr-only">Confirm your Email</label>
            <div class="form-group">
                <input id="email_confirmation" class="form-control" type="email" name="email_confirmation" v-model="email" placeholder="Confirm Email" required>
            </div>
        </div>
        <div class="col-md-8">
            <label for="comments">Mailing Address <span class="required">*</span></label>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="info.Address" placeholder="Street" required />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="info.Address2" placeholder="Apt/Ste" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="info.City" placeholder="City" required />
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <select class="custom-select" v-model="info.State" required>
                            <option value="">State</option>
                            <option v-for="(name, abbreviation) in states" :value="abbreviation">{{ name }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="info.Zip" placeholder="Zip" required />
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <select class="custom-select" v-model="info.Country" required>
                            <option value="">Country</option>
                            <option v-for="(country, abbreviation) in countries" :value="abbreviation">{{ country }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4" >
            <label for="HomePhone">Home Phone <span class="required">*</span></label>
            <div class="form-group">
                <input type="text" class="form-control" v-model="info.HomePhone" id="HomePhone" required/>
            </div>
        </div>
        <div class="col-md-4" >
            <label for="WorkPhone">Work Phone</label>
            <div class="form-group">
                <input type="text" class="form-control" v-model="info.WorkPhone" id="WorkPhone"/>
            </div>
        </div> 
        <div class="col-md-4" >
            <label for="OtherPhone">Cell Phone</label>
            <div class="form-group">
                <input type="text" class="form-control" v-model="info.OtherPhone" id="OtherPhone"/>
            </div>
        </div>
    </div>
    <input type="hidden" v-model="info.Title" placeholder="Title" />
</div>
</template>

<script>
import stateslist from '../helpers/states.js'
import countryList from '../helpers/countries.js'
export default {
    props: ['data-info'],
    data() {
        return {
            info: this.dataInfo,
            email: '',
            states: stateslist,
            countries: countryList
        }
    }
}

</script>
