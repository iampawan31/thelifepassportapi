<template>
    <div class="c">
        <div class="question-item" data-nextpage="questions/previous-spouse.php">
            <h3 class="heading3">Your spouse details</h3>

            <div class="form-wrapper">
                <div class="error-message"></div>
                <ValidationObserver ref="observer" v-slot="{ invalid }">
                <form
                    id="frmSpouseDetails"
                    name="frmSpouseDetails"
                    method="post"
                    class="custom-form"
                    action="#"
                    @submit.prevent="handleSubmit()"
                >
                    <div class="field-group">
                        <label for="marriage_date" class="input-label">Marriage Date and location</label>
                        <div class="fields-group clearfix">
                            <date-picker name="marriage_date" id="marriage_date" v-model="spouseDetails.marriage_date" valueType="format" :first-day-of-week="1"
                                :lang="lang" format="MM/DD/YYYY" placeholder="MM/DD/YYYY" 
                                class="field-datepicker field-input">
                            </date-picker>
                            
                            <input
                                type="text"
                                name="marriage_location"
                                id="marriage_location"
                                class="field-input required"
                                placeholder="Location"
                                v-model="spouseDetails.marriage_location"
                            />
                        </div>
                    </div>

                    <h4 class="form-subhead">Spouse Details</h4>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="field-group">
                                <label for="spouse_legal_name" class="input-label">Legal Name</label>
                                <ValidationProvider name="Legal Name" rules="required" v-slot="{ errors }">
                                <input
                                    type="text"
                                    name="spouse_legal_name"
                                    id="spouse_legal_name"
                                    class="field-input required"
                                    placeholder="Legal Name"
                                    v-model="spouseDetails.spouse_legal_name"
                                />
                                <div class="invalid-feedback d-block" v-for="(error, index) in errors" v-bind:key="index">{{ error }}</div>
                                </ValidationProvider>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="field-group">
                                <label
                                    for="spouse_nickname"
                                    class="input-label"
                                >Nickname or Prior Name</label>
                                <input
                                    type="text"
                                    name="spouse_nickname"
                                    id="spouse_nickname"
                                    class="field-input"
                                    placeholder="Nickname or prior name"
                                    v-model="spouseDetails.spouse_nickname"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="spouse_home_address">Home Address</label>
                        <textarea
                            rows="2"
                            name="spouse_home_address"
                            id="spouse_home_address"
                            v-model="spouseDetails.spouse_home_address"
                            class="field-input"
                            placeholder="Street Address, Town, City, State, Zipcode and country"
                        ></textarea>
                    </div>

                    <phone></phone>

                    <div class="field-group">
                        <label for="spouse_dob" class="input-label">Date of Birth</label>
                        <date-picker 
                            name="spouse_dob" 
                            id="spouse_dob" 
                            v-model="spouseDetails.spouse_dob" 
                            valueType="format" :first-day-of-week="1"
                            :lang="lang" format="MM/DD/YYYY" 
                            placeholder="MM/DD/YYYY" 
                            class="field-datepicker field-input">
                        </date-picker>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="field-group">
                                <label for="citizenship" class="input-label">Citizenship</label>
                                <select
                                    name="citizenship"
                                    id="citizenship"
                                    class="custom-select"
                                    data-placeholder="Citizenship"
                                    v-model="spouseDetails.citizenship"
                                >
                                    <option></option>
                                    <option value="1">Brother</option>
                                    <option value="2">Sister</option>
                                    <option value="3">Son</option>
                                    <option value="4">Daughter</option>
                                    <option value="5">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="field-group">
                                <label for="passport_number" class="input-label">Passport Number</label>
                                <input
                                    type="text"
                                    name="passport_number"
                                    id="legal_name"
                                    class="field-input"
                                    placeholder="Passport Number"
                                    v-model="spouseDetails.passport_number"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="father_name" class="input-label">Father's name and birth place</label>
                        <div class="fields-group clearfix">
                            <input
                                type="text"
                                name="father_name"
                                id="father_name"
                                class="field-input"
                                placeholder="Father's Name"
                                v-model="spouseDetails.father_name"
                            />
                            <input
                                type="text"
                                name="father_birth_place"
                                id="father_birth_place"
                                class="field-input field-input__last"
                                placeholder="Birth place"
                                v-model="spouseDetails.father_birth_place"
                            />
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="mother_name" class="input-label">Mother's name and birth place</label>
                        <div class="fields-group clearfix">
                            <input
                                type="text"
                                name="mother_name"
                                id="mother_name"
                                class="field-input"
                                placeholder="Mother's Name"
                                v-model="spouseDetails.mother_name"
                            />
                            <input
                                type="text"
                                name="mother_birth_place"
                                id="mother_birth_place"
                                class="field-input field-input__last"
                                placeholder="Birth place"
                                v-model="spouseDetails.mother_birth_place"
                            />
                        </div>
                    </div>

                    <h4 class="form-subhead">Email Addresses</h4>
                    <email></email>

                    <h4 class="form-subhead">Social Media</h4>
                    <social></social>

                    <h4 class="form-subhead">Current Employers including self employment</h4>
                    <employee></employee>

                    <div class="field-group field-group__action clearfix">
                        <input
                            type="submit"
                            class="field-submit btn-primary"
                            value="Save and continue"
                        />
                    </div>
                </form>
                </ValidationObserver>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</template>
<script>
import DatePicker from 'vue2-datepicker';
import Phone from './Phone.vue';
import Email from './Email.vue';
import Social from './Social.vue';
import Employee from './Employee.vue';
import { ValidationObserver, ValidationProvider } from "vee-validate";
    
export default {
    components:{
        Phone,
        Email,
        DatePicker,
        Social,
        Employee,
        ValidationObserver,
		ValidationProvider
    },
    data() {
        return {
            spouseDetails: {
                marriage_date: '',
                marriage_location: '',
                spouse_legal_name: '',
                spouse_nickname: '',
                spouse_home_address: '',
                spouse_dob: '',
                citizenship: '',
                passport_number: '',
                father_name: '',
                father_birth_place: '',
                mother_name: '',
                mother_birth_place: ''
            },
            lang: {
                days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                pickers: ['next 7 days', 'next 30 days', 'previous 7 days', 'previous 30 days'],
                placeholder: {
                    date: 'Select Date',
                    dateRange: 'Select Date Range'
                }
            },
        };
    },
    mounted() {},
    methods: {
        async handleSubmit(e) {
            const isValid = await this.$refs.observer.validate();
            if(!isValid){

            }else{
                this.$router.push("/previous-spouse-question");
            }
        }
    }
};
</script>