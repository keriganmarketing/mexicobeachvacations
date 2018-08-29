<template>
    <div class="form-group">
        <select class="custom-select" v-model="modelData" required @change="$emit('selectOption',modelData)" >
            <option value="">State</option>
            <option value="AL">AL – Alabama</option>
            <option value="AB">AB - Alberta</option>
            <option value="AK">AK – Alaska</option>
            <option value="AZ">AZ – Arizona</option>
            <option value="AR">AR – Arkansas</option>
            <option value="BC">BC – British Columbia</option>
            <option value="CA">CA – California</option>
            <option value="CO">CO – Colorado</option>
            <option value="CT">CT – Connecticut</option>
            <option value="DE">DE – Delaware</option>
            <option value="FL">FL – Florida</option>
            <option value="GA">GA – Georgia</option>
            <option value="HI">HI – Hawaii</option>
            <option value="ID">ID – Idaho</option>
            <option value="IL">IL – Illinois</option>
            <option value="IN">IN - Indiana</option>
            <option value="IA">IA - Iowa</option>
            <option value="KS">KS – Kansas Other Countries</option>
            <option value="KY">KY – Kentucky</option>
            <option value="LA">LA - Louisiana</option>
            <option value="ME">ME - Maine</option>
            <option value="MD">MD - Maryland</option>
            <option value="MA">MA - Massachusetts</option>
            <option value="MB">MB - Manitoba</option>
            <option value="MI">MI - Michigan</option>
            <option value="MN">MN - Minnesota</option>
            <option value="MS">MS - Mississippi</option>
            <option value="MO">MO - Missouri</option>
            <option value="MT">MT - Montana</option>
            <option value="NB">NB – New Brunswick</option>
            <option value="NE">NE - Nebraska</option>
            <option value="NF">NF – Newfoundland and Labrador</option>
            <option value="NV">NV - Nevada</option>
            <option value="NH">NH - New Hampshire</option>
            <option value="NJ">NJ - New Jersey</option>
            <option value="NM">NM - New Mexico</option>
            <option value="NS">NS – Nova Scotia</option>
            <option value="NY">NY - New York</option>
            <option value="NC">NC - North Carolina</option>
            <option value="ND">ND - North Dakota</option>
            <option value="NT">NT – Northwest Territories</option>
            <option value="NU">NU - Nunavut</option>
            <option value="OH">OH - Ohio</option>
            <option value="OK">OK - Oklahoma</option>
            <option value="ON">ON - Ontario</option>
            <option value="OR">OR - Oregon</option>
            <option value="PA">PA - Pennsylvania</option>
            <option value="PE">PE – Prince Edward Island</option>
            <option value="QC">QC - Quebec</option>
            <option value="RI">RI - Rhode Island</option>
            <option value="SC">SC - South Carolina</option>
            <option value="SD">SD - South Dakota</option>
            <option value="SK">SK - Saskatchewan</option>
            <option value="TN">TN - Tennessee</option>
            <option value="TX">TX - Texas</option>
            <option value="UT">UT - Utah</option>
            <option value="VT">VT - Vermont</option>
            <option value="VA">VA - Virginia</option>
            <option value="WA">WA - Washington</option>
            <option value="DC">DC - Washington, DC</option>
            <option value="WV">WV - West Virginia</option>
            <option value="WI">WI - Wisconsin</option>
            <option value="WY">WY - Wyoming</option>
            <option value="XX">XX – Other</option>
            <option value="YK">YK – Yukon Territory</option>
        </select>
    </div>
</template>
<script>
export default {
    data(){
        return {
            modelData: ''
        }
    }
}
</script>