<template>
    <div class="c">
        <div
            class="question-item"
            data-nextpage="questions/previous-spouse.php"
        >
            <h3 class="heading3">Your spouse details</h3>

            <div class="form-wrapper">
                <div class="error-message"></div>
                <ValidationObserver ref="observer" v-slot="{ invalid }">
                    <form
                        id="frmSpouseDetails"
                        name="frmSpouseDetails"
                        method="post"
                        class="custom-form"
                        @submit.prevent="handleSubmit"
                    >
                        <div class="field-group">
                            <label for="marriage_date" class="input-label"
                                >Marriage Date and location</label
                            >
                            <div class="fields-group clearfix">
                                <datepicker
                                    name="marriage_date"
                                    format="MM/d/yyyy"
                                    placeholder="MM/DD/YYYY"
                                    v-model="spouseDetails.marriage_date"
                                    class="field-datepicker field-input"
                                >
                                </datepicker>

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
                                    <label for="legal_name" class="input-label"
                                        >Legal Name</label
                                    >
                                    <ValidationProvider
                                        name="Legal Name"
                                        rules="required"
                                        v-slot="{ errors }"
                                    >
                                        <input
                                            type="text"
                                            name="legal_name"
                                            id="legal_name"
                                            class="field-input required"
                                            placeholder="Legal Name"
                                            v-model="spouseDetails.legal_name"
                                        />
                                        <div
                                            class="invalid-feedback d-block"
                                            v-for="(error, index) in errors"
                                            v-bind:key="index"
                                        >
                                            {{ error }}
                                        </div>
                                    </ValidationProvider>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="field-group">
                                    <label for="nickname" class="input-label"
                                        >Nickname or Prior Name</label
                                    >
                                    <input
                                        type="text"
                                        name="nickname"
                                        id="nickname"
                                        class="field-input"
                                        placeholder="Nickname or prior name"
                                        v-model="spouseDetails.nickname"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="field-group">
                            <label for="home_address">Home Address</label>
                            <textarea
                                rows="2"
                                name="home_address"
                                id="home_address"
                                v-model="spouseDetails.home_address"
                                class="field-input"
                                placeholder="Street Address, Town, City, State, Zipcode and country"
                            ></textarea>
                        </div>

                        <phone-details
                            :user-phones="phones"
                            v-if="phones.length > 0"
                        ></phone-details>

                        <div class="field-group">
                            <label for="dob" class="input-label"
                                >Date of Birth</label
                            >
                            <datepicker
                                name="dob"
                                format="MM/d/yyyy"
                                placeholder="MM/DD/YYYY"
                                v-model="spouseDetails.dob"
                                class="field-datepicker field-input"
                            >
                            </datepicker>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="field-group">
                                    <label for="citizenship" class="input-label"
                                        >Citizenship</label
                                    >
                                    <Select2
                                        name="citizenship"
                                        id="citizenship"
                                        width="resolve"
                                        data-placeholder="Select an Options"
                                        v-model="spouseDetails.country_id"
                                        :options="citizenshipOptions"
                                        @change="citizenshipChangeEvent($event)"
                                        @select="citizenshipSelectEvent($event)"
                                    />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="field-group">
                                    <label
                                        for="passport_number"
                                        class="input-label"
                                        >Passport Number</label
                                    >
                                    <input
                                        type="text"
                                        name="passport_number"
                                        id="passport_number"
                                        class="field-input"
                                        placeholder="Passport Number"
                                        v-model="spouseDetails.passport_number"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="field-group">
                            <label for="father_name" class="input-label"
                                >Father's name and birth place</label
                            >
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
                            <label for="mother_name" class="input-label"
                                >Mother's name and birth place</label
                            >
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
                        <email
                            :user-emails="emails"
                            v-if="emails.length > 0"
                        ></email>

                        <h4 class="form-subhead">Social Media</h4>
                        <social-media-details
                            :user-socials="socials"
                            v-if="socials.length > 0"
                        ></social-media-details>

                        <h4 class="form-subhead">
                            Current Employers including self employment
                        </h4>
                        <employee
                            :user-employers="employers"
                            v-if="employers.length > 0"
                        ></employee>

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
//import DatePicker from 'vue2-datepicker';
import Select2 from "v-select2-component";
import Datepicker from "vuejs-datepicker";
import PhoneDetails from "./PhoneDetails.vue";
import Email from "./Email.vue";
import SocialMediaDetails from "./SocialMediaDetails.vue";
import Employee from "./Employee.vue";
import { ValidationObserver, ValidationProvider } from "vee-validate";

export default {
    components: {
        PhoneDetails,
        Email,
        Datepicker,
        SocialMediaDetails,
        Employee,
        Select2,
        ValidationObserver,
        ValidationProvider
    },
    data() {
        return {
            spouseDetails: [],
            phones: [],
            emails: [],
            socials: [],
            employers: [],
            userId: 0,
            submitted: false,
            citizenshipOptions: []
        };
    },
    created() {
        axios.get("/countrylist").then(response => {
            if (response.status == 200) {
                this.citizenshipOptions = response.data.countries;
            }
        });

        axios.get("/getspouseinfo").then(response => {
            if (response.status == 200) {
                if (response.data.data[0]) {
                    this.spouseDetails = JSON.parse(
                        JSON.stringify(response.data.data[0])
                    );
                    this.userId = this.spouseDetails.user_id;

                    if (this.spouseDetails.spouse_phone.length > 0) {
                        this.phones = this.spouseDetails.spouse_phone;
                    } else {
                        this.phones = [{ number: null }];
                    }

                    if (this.spouseDetails.spouse_email.length > 0) {
                        this.emails = this.spouseDetails.spouse_email;
                    } else {
                        this.emails = [{ email: null, password: null }];
                    }

                    if (this.spouseDetails.spouse_socail_media.length > 0) {
                        this.socials = this.spouseDetails.spouse_socail_media;
                    } else {
                        this.socials = [
                            { social: null, username: null, password: null }
                        ];
                    }

                    if (this.spouseDetails.spouse_employer.length > 0) {
                        this.employers = this.spouseDetails.spouse_employer;
                    } else {
                        this.employers = [
                            {
                                employer_name: null,
                                employer_phone: null,
                                employer_address: null,
                                computer_username: null,
                                computer_password: null,
                                employee_benefits: null
                            }
                        ];
                    }
                } else {
                    this.phones = [{ number: null }];
                    this.emails = [{ email: null, password: null }];
                    this.socials = [
                        { social: null, username: null, password: null }
                    ];
                    this.employers = [
                        {
                            employer_name: null,
                            employer_phone: null,
                            employer_address: null,
                            computer_username: null,
                            computer_password: null,
                            employee_benefits: null
                        }
                    ];
                }
            }
        });
    },
    mounted() {},
    methods: {
        async handleSubmit(e) {
            this.submitted = true;
            const isValid = await this.$refs.observer.validate();
            if (!isValid) {
            } else {
                const form = e.target;
                const formData = new FormData(form);

                if (this.userId) {
                    axios
                        .post(
                            "/spouse/" + this.userId + "/updatedata",
                            formData
                        )
                        .then(response => {
                            this.$router.push("/previous-spouse-question");
                        })
                        .catch(function() {});
                } else {
                    axios
                        .post("/spouse/postdata", formData)
                        .then(response => {
                            this.$router.push("/previous-spouse-question");
                        })
                        .catch(function() {});
                }
            }
        }
    }
};
</script>
