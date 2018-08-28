<template>
    <div>
        <form>
            <div class="row">
                <button class="btn col-md mx-3 my-1" type="button" :class="{'btn-info text-white': step == 1, 'btn-outline-secondary': step !== 1}" @click="step = 1">Step 1 - Trip Details</button>
                <button class="btn col-md mx-3 my-1" type="button" :class="{'btn-info text-white': step == 2, 'btn-outline-secondary': step !== 2}" @click="step = 2">Step 2 - Contact Info</button>
                <button class="btn col-md mx-3 my-1" type="button" :class="{'btn-info text-white': step == 3, 'btn-outline-secondary': step !== 3}" @click="step = 3">Step 3 - Payment</button>
                <button class="btn col-md mx-3 my-1" type="button" :class="{'btn-info text-white': step == 4, 'btn-outline-secondary': step !== 4}" @click="step = 4">Step 4 - Confirmation</button>
            </div>
            <div class="mt-4 text-right text-sm">
                <p><span class="required">*</span> = required</p>
            </div>
            <div v-if="step == 1">
                <div class="mt-4">
                    <h2>Trip Details</h2>
                </div>
                <div class="row align-items-end">
                    <div class="col-6 col-md-4 col-lg-3">
                        <label for="ArrivalDate">Check-in</label>
                        <div class="form-group">
                            <input type="text" id="ArrivalDate" class="form-control" v-model="info.ArrivalDate" disabled>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <label for="DepartureDate">Check-out</label>
                        <div class="form-group">
                            <input type="text" id="DepartureDate" class="form-control" v-model="info.DepartureDate" disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group text-lg-right">
                        <p>Use the calendar to select the dates of your stay.</p>
                        </div>
                    </div>
                    <div class="col-12 availability-cal mb-2">
                        <div class="form-group">
                            <v-date-picker
                                mode="range"
                                :attributes="calendarOptions"
                                is-double-paned
                                v-model="info.selectedDate"
                                :disabled-dates="calendarOptions[0].dates"
                                :popover-expanded="true"
                                :is-inline="true"
                                @dayclick="changeDate"
                            >
                            </v-date-picker>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="numNights">Number of Nights</label>
                        <div class="form-group">
                            <input type="number" id="numNights" class="form-control" v-model="numNights" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="numPersons">Number of people <span class="required">*</span></label>
                        <div class="form-group">
                            <input type="number" id="numPersons" class="form-control" v-model="info.Persons">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="promoCode">Promo Code</label>
                        <div class="form-group">
                            <input id="promoCode" class="form-control" type="text" name="promoCode" v-model="info.PromoCode">
                        </div>

                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="comments">Comments</label>
                        <div class="form-group">
                            <textarea id="comments" class="form-control" v-model="info.Notes" style="height:145px;"></textarea>
                        </div>
                    </div>
                </div>
                <input type="hidden" v-model="info.UnitId">
                <input type="hidden" v-model="info.LocationId">
                <label>Read our Rental Terms</label>
                <div class="form-group">
                    <div id="termstext" class="p-4 border" style="max-height:145px; overflow-y: scroll" v-html="getTerms()"></div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input id="termsAccepted" class="custom-control-input" type="checkbox" name="termsAccepted" v-model="termsAccepted" :checked="termsAccepted">
                        <label class="custom-control-label" for="termsAccetped">Do you accept the terms? <span class="required">*</span></label>
                    </div>
                </div>
            </div>
            <div v-if="step == 2">
                <div class="mt-4">
                    <h2>Contact Info</h2>
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
                                    <select class="custom-select" v-model="info.State" required >
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
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <input type="text" class="form-control" v-model="info.Zip" placeholder="Zip" required />
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <select class="custom-select" v-model="info.Country" required >
                                        <option value="">Country</option>
                                        <option value="Albania">AL - Albania</option>
                                        <option value="Algeria">DZ - Algeria</option>
                                        <option value="American Samoa">AS - American Samoa</option>
                                        <option value="Andorra">AD - Andorra</option>
                                        <option value="Angola">AO - Angola</option>
                                        <option value="Anguilla">AI - Anguilla</option>
                                        <option value="Antarctica">AQ - Antarctica</option>
                                        <option value="Antigua And Barbuda">AG - Antigua And Barbuda</option>
                                        <option value="Argentina">AR - Argentina</option>
                                        <option value="Armenia">AM - Armenia</option>
                                        <option value="Aruba">AW - Aruba</option>
                                        <option value="Australia">AU - Australia</option>
                                        <option value="Austria">AT - Austria</option>
                                        <option value="Azerbaijan">AZ - Azerbaijan</option>
                                        <option value="Bahamas, The">BS - Bahamas, The</option>
                                        <option value="Bahrain">BH - Bahrain</option>
                                        <option value="Bangladesh">BD - Bangladesh</option>
                                        <option value="Barbados">BB - Barbados</option>
                                        <option value="Belarus">BY - Belarus</option>
                                        <option value="Belgium">BE - Belgium</option>
                                        <option value="Belize">BZ - Belize</option>
                                        <option value="Benin">BJ - Benin</option>
                                        <option value="Bermuda">BM - Bermuda</option>
                                        <option value="Bhutan">BT - Bhutan</option>
                                        <option value="Bolivia">BO - Bolivia</option>
                                        <option value="Bosnia">BA - Bosnia</option>
                                        <option value="Botswana">BW - Botswana</option>
                                        <option value="Bouvet Island">BV - Bouvet Island</option>
                                        <option value="Brazil">BR - Brazil</option>
                                        <option value="British Indian Ocean">IO - British Indian Ocean</option>
                                        <option value="Brunei">BN - Brunei</option>
                                        <option value="Bulgaria">BG - Bulgaria</option>
                                        <option value="Burkina Faso">BF - Burkina Faso</option>
                                        <option value="Burundi">BI - Burundi</option>
                                        <option value="Cambodia">KH - Cambodia</option>
                                        <option value="Cameroon">CM - Cameroon</option>
                                        <option value="Canada">CA - Canada</option>
                                        <option value="Cape Verde">CV - Cape Verde</option>
                                        <option value="Cayman Islands">KY - Cayman Islands</option>
                                        <option value="Central African Republic">CF - Central African Republic</option>
                                        <option value="Chad">TD - Chad</option>
                                        <option value="Chile">CL - Chile</option>
                                        <option value="China">CN - China</option>
                                        <option value="Christmas Island">CX - Christmas Island</option>
                                        <option value="Cocos Islands">CC - Cocos Islands</option>
                                        <option value="Colombia">CO - Colombia</option>
                                        <option value="Comoros">KM - Comoros</option>
                                        <option value="Congo">CG - Congo</option>
                                        <option value="Congo">CD - Congo</option>
                                        <option value="Cook Islands">CK - Cook Islands</option>
                                        <option value="Costa Rica">CR - Costa Rica</option>
                                        <option value="Cote D'Ivoire">CI - Cote D'Ivoire</option>
                                        <option value="Croatia (Hrvatska)">HR - Croatia (Hrvatska)</option>
                                        <option value="Cuba">CU - Cuba</option>
                                        <option value="Cyprus">CY - Cyprus</option>
                                        <option value="Czech Republic">CZ - Czech Republic</option>
                                        <option value="Denmark">DK - Denmark</option>
                                        <option value="Djibouti">DJ - Djibouti</option>
                                        <option value="Dominica">DM - Dominica</option>
                                        <option value="Dominican Republic">DO - Dominican Republic</option>
                                        <option value="East Timor">TP - East Timor</option>
                                        <option value="Ecuador">EC - Ecuador</option>
                                        <option value="Egypt">EG - Egypt</option>
                                        <option value="El Salvador">SV - El Salvador</option>
                                        <option value="Equatorial Guinea">GQ - Equatorial Guinea</option>
                                        <option value="Eritrea">ER - Eritrea</option>
                                        <option value="Estonia">EE - Estonia</option>
                                        <option value="Ethiopia">ET - Ethiopia</option>
                                        <option value="Falkland Islands">FK - Falkland Islands</option>
                                        <option value="Faroe Islands">FO - Faroe Islands</option>
                                        <option value="Fiji Islands">FJ - Fiji Islands</option>
                                        <option value="Finland">FI - Finland</option>
                                        <option value="France">FR - France</option>
                                        <option value="French Guiana">GF - French Guiana</option>
                                        <option value="French Polynesia">PF - French Polynesia</option>
                                        <option value="French Southern">TF - French Southern</option>
                                        <option value="Gabon">GA - Gabon</option>
                                        <option value="Gambia, The">GM - Gambia, The</option>
                                        <option value="Georgia">GE - Georgia</option>
                                        <option value="Germany">DE - Germany</option>
                                        <option value="Ghana">GH - Ghana</option>
                                        <option value="Gibraltar">GI - Gibraltar</option>
                                        <option value="Greece">GR - Greece</option>
                                        <option value="Greenland">GL - Greenland</option>
                                        <option value="Grenada">GD - Grenada</option>
                                        <option value="Guadeloupe">GP - Guadeloupe</option>
                                        <option value="Guam">GU - Guam</option>
                                        <option value="Guatemala">GT - Guatemala</option>
                                        <option value="Guinea">GN - Guinea</option>
                                        <option value="Guinea-Bissau">GW - Guinea-Bissau</option>
                                        <option value="Guyana">GY - Guyana</option>
                                        <option value="Haiti">HT - Haiti</option>
                                        <option value="Heard Islands">HM - Heard Islands</option>
                                        <option value="Honduras">HN - Honduras</option>
                                        <option value="Hong Kong S.A.R.">HK - Hong Kong S.A.R.</option>
                                        <option value="Hungary">HU - Hungary</option>
                                        <option value="Iceland">IS - Iceland</option>
                                        <option value="India">IN - India</option>
                                        <option value="Indonesia">ID - Indonesia</option>
                                        <option value="Iran">IR - Iran</option>
                                        <option value="Iraq">IQ - Iraq</option>
                                        <option value="Ireland">IE - Ireland</option>
                                        <option value="Israel">IL - Israel</option>
                                        <option value="Italy">IT - Italy</option>
                                        <option value="Jamaica">JM - Jamaica</option>
                                        <option value="Japan">JP - Japan</option>
                                        <option value="Jordan">JO - Jordan</option>
                                        <option value="Kazakhstan">KZ - Kazakhstan</option>
                                        <option value="Kenya">KE - Kenya</option>
                                        <option value="Kiribati">KI - Kiribati</option>
                                        <option value="Korea">KR - Korea</option>
                                        <option value="Korea, North">KP - Korea, North</option>
                                        <option value="Kuwait">KW - Kuwait</option>
                                        <option value="Kyrgyzstan">KG - Kyrgyzstan</option>
                                        <option value="Laos">LA - Laos</option>
                                        <option value="Latvia">LV - Latvia</option>
                                        <option value="Lebanon">LB - Lebanon</option>
                                        <option value="Lesotho">LS - Lesotho</option>
                                        <option value="Liberia">LR - Liberia</option>
                                        <option value="Libya">LY - Libya</option>
                                        <option value="Liechtenstein">LI - Liechtenstein</option>
                                        <option value="Lithuania">LT - Lithuania</option>
                                        <option value="Luxembourg">LU - Luxembourg</option>
                                        <option value="Macau S.A.R.">MO - Macau S.A.R.</option>
                                        <option value="Macedonia">MK - Macedonia</option>
                                        <option value="Madagascar">MG - Madagascar</option>
                                        <option value="Malawi">MW - Malawi</option>
                                        <option value="Malaysia">MY - Malaysia</option>
                                        <option value="Maldives">MV - Maldives</option>
                                        <option value="Mali">ML - Mali</option>
                                        <option value="Malta">MT - Malta</option>
                                        <option value="Marshall Islands">MH - Marshall Islands</option>
                                        <option value="Martinique">MQ - Martinique</option>
                                        <option value="Mauritania">MR - Mauritania</option>
                                        <option value="Mauritius">MU - Mauritius</option>
                                        <option value="Mayotte">YT - Mayotte</option>
                                        <option value="Mexico">MX - Mexico</option>
                                        <option value="Micronesia">FM - Micronesia</option>
                                        <option value="Moldova">MD - Moldova</option>
                                        <option value="Monaco">MC - Monaco</option>
                                        <option value="Mongolia">MN - Mongolia</option>
                                        <option value="Montserrat">MS - Montserrat</option>
                                        <option value="Morocco">MA - Morocco</option>
                                        <option value="Mozambique">MZ - Mozambique</option>
                                        <option value="Myanmar">MM - Myanmar</option>
                                        <option value="Namibia">NA - Namibia</option>
                                        <option value="Nauru">NR - Nauru</option>
                                        <option value="Nepal">NP - Nepal</option>
                                        <option value="Netherlands Antilles">AN - Netherlands Antilles</option>
                                        <option value="Netherlands, The">NL - Netherlands, The</option>
                                        <option value="New Caledonia">NC - New Caledonia</option>
                                        <option value="New Zealand">NZ - New Zealand</option>
                                        <option value="Nicaragua">NI - Nicaragua</option>
                                        <option value="Niger">NE - Niger</option>
                                        <option value="Nigeria">NG - Nigeria</option>
                                        <option value="Niue">NU - Niue</option>
                                        <option value="Norfolk Island">NF - Norfolk Island</option>
                                        <option value="Northern Mariana Islands">MP - Northern Mariana Islands</option>
                                        <option value="Norway">NO - Norway</option>
                                        <option value="Oman">OM - Oman</option>
                                        <option value="Pakistan">PK - Pakistan</option>
                                        <option value="Palau">PW - Palau</option>
                                        <option value="Panama">PA - Panama</option>
                                        <option value="Papua new Guinea">PG - Papua new Guinea</option>
                                        <option value="Paraguay">PY - Paraguay</option>
                                        <option value="Peru">PE - Peru</option>
                                        <option value="Philippines">PH - Philippines</option>
                                        <option value="Pitcairn Island">PN - Pitcairn Island</option>
                                        <option value="Poland">PL - Poland</option>
                                        <option value="Portugal">PT - Portugal</option>
                                        <option value="Puerto Rico">PR - Puerto Rico</option>
                                        <option value="Qatar">QA - Qatar</option>
                                        <option value="Reunion">RE - Reunion</option>
                                        <option value="Romania">RO - Romania</option>
                                        <option value="Russia">RU - Russia</option>
                                        <option value="Rwanda">RW - Rwanda</option>
                                        <option value="Saint Helena">SH - Saint Helena</option>
                                        <option value="Saint Kitts And Nevis">KN - Saint Kitts And Nevis</option>
                                        <option value="Saint Lucia">LC - Saint Lucia</option>
                                        <option value="Saint Pierre and Miquelon">PM - Saint Pierre and Miquelon</option>
                                        <option value="Saint Vincent">VC - Saint Vincent</option>
                                        <option value="Samoa">WS - Samoa</option>
                                        <option value="San Marino">SM - San Marino</option>
                                        <option value="Sao Tome and Principe">ST - Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">SA - Saudi Arabia</option>
                                        <option value="Senegal">SN - Senegal</option>
                                        <option value="Seychelles">SC - Seychelles</option>
                                        <option value="Sierra Leone">SL - Sierra Leone</option>
                                        <option value="Singapore">SG - Singapore</option>
                                        <option value="Slovakia">SK - Slovakia</option>
                                        <option value="Slovenia">SI - Slovenia</option>
                                        <option value="Solomon Islands">SB - Solomon Islands</option>
                                        <option value="Somalia">SO - Somalia</option>
                                        <option value="South Africa">ZA - South Africa</option>
                                        <option value="South Georgia">GS - South Georgia</option>
                                        <option value="Spain">ES - Spain</option>
                                        <option value="Sri Lanka">LK - Sri Lanka</option>
                                        <option value="Sudan">SD - Sudan</option>
                                        <option value="Suriname">SR - Suriname</option>
                                        <option value="Svalbard Island">SJ - Svalbard Island</option>
                                        <option value="Swaziland">SZ - Swaziland</option>
                                        <option value="Sweden">SE - Sweden</option>
                                        <option value="Switzerland">CH - Switzerland</option>
                                        <option value="Syria">SY - Syria</option>
                                        <option value="Taiwan">TW - Taiwan</option>
                                        <option value="Tajikistan">TJ - Tajikistan</option>
                                        <option value="Tanzania">TZ - Tanzania</option>
                                        <option value="Thailand">TH - Thailand</option>
                                        <option value="Togo">TG - Togo</option>
                                        <option value="Tokelau">TK - Tokelau</option>
                                        <option value="Tongarn">TO - Tongarn</option>
                                        <option value="Trinidad And Tobago">TT - Trinidad And Tobago</option>
                                        <option value="Tunisia">TN - Tunisia</option>
                                        <option value="Turkey">TR - Turkey</option>
                                        <option value="Turkmenistan">TM - Turkmenistan</option>
                                        <option value="Turks And Caicos Islands">TC - Turks And Caicos Islands</option>
                                        <option value="Tuvalu">TV - Tuvalu</option>
                                        <option value="Uganda">UG - Uganda</option>
                                        <option value="Ukraine">UA - Ukraine</option>
                                        <option value="United Arab Emirates">AE - United Arab Emirates</option>
                                        <option value="United Kingdom">UK - United Kingdom</option>
                                        <option value="United States">US - United States</option>
                                        <option value="United States Islands">UM - United States Islands</option>
                                        <option value="Uruguay">UY - Uruguay</option>
                                        <option value="Uzbekistan">UZ - Uzbekistan</option>
                                        <option value="Vanuatu">VU - Vanuatu</option>
                                        <option value="Vatican City State">VA - Vatican City State</option>
                                        <option value="Venezuela">VE - Venezuela</option>
                                        <option value="Vietnam">VN - Vietnam</option>
                                        <option value="Virgin Islands (British)">VG - Virgin Islands (British)</option>
                                        <option value="Virgin Islands (US)">VI - Virgin Islands (US)</option>
                                        <option value="Wallis And Futuna Islands">WF - Wallis And Futuna Islands</option>
                                        <option value="Yemen">YE - Yemen</option>
                                        <option value="Yugoslavia">YU - Yugoslavia</option>
                                        <option value="Zambia">ZM - Zambia</option>
                                        <option value="Zimbabwe">ZW – Zimbabwe</option>
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

            <div v-if="step == 3">
                <div class="mt-4">
                    <h2>Payment</h2>
                </div>
                <input type="number" v-model="info.CreditCardNumber" placeholder="CreditCardNumber" />
                <input type="number" v-model="info.ExpMonth" placeholder="ExpMonth" />
                <input type="number" v-model="info.ExpYear" placeholder="ExpYear" />
                <input type="text" v-model="info.NameOnCard" placeholder="NameOnCard" />
                <input type="number" v-model="info.CCCVCode" placeholder="CCCVCode" />
                <input type="text" v-model="info.BillingAddress" placeholder="BillingAddress"/>
                <input type="text" v-model="info.BillingCity" placeholder="BillingCity"/>
                <input type="text" v-model="info.BillingState" placeholder="BillingState"/>
                <input type="number" v-model="info.BillingZip" placeholder="BillingZip"/>
                <input type="text" v-model="info.BillingCountry" placeholder="BillingCountry"/>
            </div>
        </form>
        <div class="my-4">
            <button class="btn" @click="back">Back</button>
            <button class="btn btn-primary text-white" @click="next">Next</button>
        </div>
    </div>
</template>


<script>
import ReservationInfo from '../models/reservation-info.js';
import { setupCalendar, Calendar} from 'v-calendar'
import 'v-calendar/lib/v-calendar.min.css';
import moment from 'moment';
import CCValidator from '../models/ccvalidator.js';

setupCalendar({
    firstDayOfWeek: 1,
    paneWidth: 300,
    formats: {
        title: 'MMMM YYYY',
        weekdays: 'WWW',
        navMonths: 'MMM',
        input: ['L', 'YYYY-MM-DD', 'YYYY/MM/DD'],
        dayPopover: 'L',
    }
});


export default {
    props: ['unitId'],
    data() {
        return {
            info: new ReservationInfo(),
            step: 1,
            checkIn: null,
            checkOut: null,
            numNights: 7,
            email: null,
            termsAccepted: false,
            unit: {},
            calendarOptions: [{
                dates: [],
                highlight: {
                    backgroundColor: '#ff8080',
                },
                contentStyle: {
                    color: '#ffffff',
                }
            }],
            bookings: []
        }
    },
    mounted () {
        this.info.UnitId = this.unitId;
        this.getUnit();

    },
    computed: {
        CCCVCode() {
            return this.info.CCCVCode;
        }
    },
    watch: {
        CCCVCode: function (newCode, oldCode) {
            var vm = this;
            if (newCode.length > 4) {
                this.info.CCCVCode = this.info.CCCVCode.slice(0, -1);
            }
        }
    },
    methods: {
        submit() {
            this.info.submit();
        },
        checkInChanged (date) {
            this.checkIn = new Date(moment(date));
            this.info.ArrivalDate = moment(date).format("MM/DD/YYYY");
        },
        checkOutChanged (date) {
            let out = moment(date);
            this.checkOut = new Date(out);
            this.info.DepartureDate = out.format("MM/DD/YYYY");
            this.numNights = out.diff(this.checkIn, 'days');
        },
        clearDates() {
            this.info.ArrivalDate = null;
            this.info.DepartureDate = null;
        },
        back() {
            if (this.step > 1) this.step -= 1;
        },
        next() {
            if (this.step < 4) this.step += 1;
        },
        getUnit() {
            axios.get('https://rns.mexicobeachvacations.com/units/' + this.unitId)
                .then(response => {
                    this.unit = response.data;

                    this.unit.availability.forEach( booking => {
                        this.bookings.push({
                            start: booking.arrival_date,
                            end: booking.departure_date,
                            title: 'Booked',
                            id: booking.rns_id
                        });
                    });

                    this.calendarOptions[0].dates = this.bookings;
                })
                .catch(err => {
                    console.log(err)
                })
        },
        getTerms() {
            return '<p>terms will go here...</p><p>terms will go here...</p><p>terms will go here...</p><p>terms will go here...</p>';
        },
        changeDate(value){
            console.log(value);

            if(value.attributes.length === 0){
                this.checkIn = new Date(moment(value.dateTime));
                this.info.ArrivalDate = moment(value.dateTime).format("MM/DD/YYYY");
            }
            if(value.attributes.length === 1){
                let out = moment(value.dateTime);
                this.checkOut = new Date(out);
                this.info.DepartureDate = out.format("MM/DD/YYYY");
                this.numNights = out.diff(this.checkIn, 'days');
            }
        }
    }
}
</script>
<style lang="scss" >
.required {
    color: red;
}
.availability-cal .c-pane-container .c-pane {
    background: #FFF;
    width: 300px !important;

    @media (min-width: 576px){
        width: 250px !important;
    }
    @media (min-width: 768px){
        width: 345px !important;
    }
    @media (min-width: 993px){
        width: 465px !important;
        
        .c-day-content,
        .c-day-background {
            height: 2.8rem !important;

            &:hover {
                width: 2.8rem !important;
            }
        }
    }
    @media (min-width: 1200px){
        width: 550px !important;
    }

    .c-weekdays,
    .c-day-content {
        font-family: "ABeeZee", sans-serif;
    }
    .c-title {
        font-family: "Fira Sans Condensed", sans-serif;
    }
    .c-arrow-layout {
        padding: 6px 5px 4px;
        border: 2px solid #ff6f74;
        border-radius: 50%;
        color: #ff6f74;
    }

}
</style>
