<template>
  <div class="c">
    <div
      class="question-item"
      data-nextpage="questions/previous-spouse.php"
    >
      <h3 class="heading3">
        Your spouse details
      </h3>

      <div class="form-wrapper">
        <div class="error-message" />
        <ValidationObserver
          ref="observer"
          v-slot="{ invalid }"
        >
          <form
            id="frmSpouseDetails"
            name="frmSpouseDetails"
            method="post"
            class="custom-form"
            @submit.prevent="handleSubmit"
          >
            <!-- Marriage Date and Location Section -->
            <div class="row">
              <div class="col-md-6 col-sm-12 nopadding">
                <div class="field-group">
                  <label
                    for="marriage_date"
                    class="input-label"
                  >Marriage Date</label>
                  <ValidationProvider
                    v-slot="{ errors }"
                    name="Marriage Date"
                    rules="date"
                  >
                    <input
                      v-model="
                        marriageDate
                      "
                      v-mask="'##/##/####'"
                      type="text"
                      class="field-input"
                      name="marriage_date"
                      placeholder="mm/dd/yyyy"
                    >
                    <span
                      v-if="
                        errors != undefined &&
                          errors.length
                      "
                      class="invalid-feedback d-block"
                    >
                      {{ errors[0] }}
                    </span>
                  </ValidationProvider>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 nopadding">
                <div class="field-group">
                  <label
                    for="marriage_location"
                    class="input-label"
                  >Marriage Location</label>
                  <validation-provider
                    v-slot="{ errors }"
                    name="Marriage Location"
                    rules="required|address|max:200"
                  >
                    <input
                      id="marriage_location"
                      v-model="
                        marriageLocation
                      "
                      type="text"
                      name="marriage_location"
                      class="field-input required"
                      placeholder="Location"
                    >
                    <div
                      v-if="
                        errors != undefined &&
                          errors.length
                      "
                      class="invalid-feedback d-block"
                    >
                      {{ errors[0] }}
                    </div>
                  </validation-provider>
                </div>
              </div>
            </div>

            <!-- Spouse Details Heading -->
            <h4 class="form-subhead">
              Spouse Details
            </h4>

            <!-- Legal name and nick name section -->
            <div class="row">
              <div class="col-md-6 col-sm-12 nopadding">
                <div class="field-group">
                  <label
                    for="legal_name"
                    class="input-label"
                  >Legal Name</label>
                  <ValidationProvider
                    v-slot="{ errors }"
                    name="Legal Name"
                    rules="required|alpha_spaces|max:50"
                  >
                    <input
                      id="legal_name"
                      v-model="legalName"
                      type="text"
                      name="legal_name"
                      class="field-input required"
                      placeholder="Legal Name"
                    >
                    <div
                      v-for="(error, index) in errors"
                      :key="index"
                      class="invalid-feedback d-block"
                    >
                      {{ error }}
                    </div>
                  </ValidationProvider>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 nopadding">
                <div class="field-group">
                  <label
                    for="nickname"
                    class="input-label"
                  >Nickname or Prior Name</label>
                  <ValidationProvider
                    v-slot="{ errors }"
                    name="Nick Name"
                    rules="alpha_spaces|max:30"
                  >
                    <input
                      id="nickname"
                      v-model="nickName"
                      type="text"
                      name="nickname"
                      class="field-input"
                      placeholder="Nickname or prior name"
                    >
                    <span
                      v-if="
                        errors != undefined &&
                          errors.length
                      "
                      class="invalid-feedback d-block"
                    >
                      {{ errors[0] }}
                    </span>
                  </ValidationProvider>
                </div>
              </div>
            </div>


            <!-- Spouse Home Address Section -->
            <home-address 
            v-model="address"
            @input="newAddress => {address = newAddress;}" address-type="personal" />

            <!-- Spouse's Phone number(s) section -->
            <div class="row">
              <div class="col nopadding">
                <phone-details
                  v-model="phoneNumbers"
                                    @input="
                                        newPhoneNumbers => {
                                            phoneNumbers = newPhoneNumbers;
                                        }
                                    "
                />
              </div>
            </div>

            <!-- Spouse's Date of birth section -->
            <div class="row">
                <div class="col nopadding">
                    <div class="field-group">
                        <label
                            for="dob"
                            class="input-label"
                        >Date of Birth</label>
                        <ValidationProvider
                            v-slot="{ errors }"
                            name="Date of Birth"
                            rules="date"
                        >
                            <input
                            v-model="dateOfBirth"
                            v-mask="'##/##/####'"
                            type="text"
                            class="field-input"
                            name="date_of_birth"
                            placeholder="mm/dd/yyyy"
                            >
                            <span
                            v-if="errors != undefined && errors.length"
                            class="invalid-feedback d-block"
                            >
                            {{ errors[0] }}
                            </span>
                        </ValidationProvider>
                    </div>
                </div>
            </div>

            <!-- Spouse's Citizsenship and Passport section -->
            <div class="row">
              <div class="col-md-6 col-sm-12 nopadding">
                <div class="field-group">
                  <label
                    for="citizenship"
                    class="input-label"
                  >Citizenship</label>
                  <validation-provider
                    v-slot="{ errors }"
                    name="Citizenship"
                    vid="citizenship"
                  >
                    <Select2
                      id="citizenship"
                      v-model="countryId"
                      name="citizenship"
                      width="resolve"
                      data-placeholder="Select an Options"
                      :options="citizenshipOptions"
                      @change="
                        citizenshipChangeEvent($event)
                      "
                      @select="
                        citizenshipSelectEvent($event)
                      "
                    />
                    <span
                      v-if="
                        errors != undefined &&
                          errors.length
                      "
                      class="invalid-feedback d-block"
                    >
                      {{ errors[0] }}
                    </span>
                  </validation-provider>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 nopadding">
                <div class="field-group">
                  <label
                    for="passport_number"
                    class="input-label"
                  >Passport Number</label>
                  <validation-provider
                    v-slot="{ errors }"
                    name="Passport Number"
                    rules="required_if:citizenship|max:20"
                  >
                    <input
                      id="passport_number"
                      v-model="
                        passportNumber
                      "
                      type="text"
                      name="passport_number"
                      class="field-input"
                      placeholder="Passport Number"
                    >
                    <span
                      v-if=" errors != undefined &&errors.length"
                      class="invalid-feedback d-block"
                    >
                      {{ errors[0] }}
                    </span>
                  </validation-provider>
                </div>
              </div>
            </div>

            <!-- Spouse's Father name and birth place section -->
            <div class="row">
              <div class="col-md-6 col-sm-12 nopadding">
                <div class="field-group">
                  <validation-provider
                    v-slot="{ errors }"
                    name="Father's Name"
                    rules="alpha_spaces|max:50"
                  >
                    <label
                      for="father_name"
                      class="input-label"
                    >Father's name</label>
                    <input
                      id="father_name"
                      v-model="fatherName"
                      type="text"
                      name="father_name"
                      class="field-input"
                      placeholder="Father's Name"
                    >
                    <div
                      v-if="
                        errors != undefined &&
                          errors.length
                      "
                      class="invalid-feedback d-block"
                    >
                      {{ errors[0] }}
                    </div>
                  </validation-provider>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 nopadding">
                <div class="field-group">
                  <label
                    for="father_birth_place"
                    class="input-label"
                  >Father's Birthplace</label>
                  <validation-provider
                    v-slot="{ errors }"
                    name="Father's Birthplace"
                    rules="address|max:200"
                  >
                    <input
                      id="father_birth_place"
                      v-model="
                        fatherBirthPlace
                      "
                      type="text"
                      name="father_birth_place"
                      class="field-input field-input__last"
                      placeholder="Birth place"
                    >
                    <div
                      v-if="
                        errors != undefined &&
                          errors.length
                      "
                      class="invalid-feedback d-block"
                    >
                      {{ errors[0] }}
                    </div>
                  </validation-provider>
                </div>
              </div>
            </div>

            <!-- Spouse's Mother name and birth place section -->
            <div class="row">
              <div class="col-md-6 col-sm-12 nopadding">
                <div class="field-group">
                  <label
                    for="mother_name"
                    class="input-label"
                  >Mother's Name</label>
                  <validation-provider
                    v-slot="{ errors }"
                    name="Mother's Name"
                    rules="alpha_spaces|max:50"
                  >
                    <input
                      id="mother_name"
                      v-model="motherName"
                      type="text"
                      name="mother_name"
                      class="field-input"
                      placeholder="Mother's Name"
                    >
                    <div
                      v-if="
                        errors != undefined &&
                          errors.length
                      "
                      class="invalid-feedback d-block"
                    >
                      {{ errors[0] }}
                    </div>
                  </validation-provider>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 nopadding">
                <div class="field-group">
                  <label
                    for="mother_birth_place"
                    class="input-label"
                  >Mother's Birthplace</label>
                  <validation-provider
                    v-slot="{ errors }"
                    name="Mother's Birthplace"
                    rules="address|max:200"
                  >
                    <input
                      id="mother_birth_place"
                      v-model="
                        motherBirthPlace
                      "
                      type="text"
                      name="mother_birth_place"
                      class="field-input field-input__last"
                      placeholder="Birth place"
                    >
                    <div
                      v-if="
                        errors != undefined &&
                          errors.length
                      "
                      class="invalid-feedback d-block"
                    >
                      {{ errors[0] }}
                    </div>
                  </validation-provider>
                </div>
              </div>
            </div>

            <!-- Spouse's email(s) credentials section -->
            <div class="row">
              <div class="col nopadding">
                <email-details
                  v-model="emails" @input="newEmails => {emails = newEmails;}"
                />
              </div>
            </div>

            <!-- Spouse's Social media credentials section -->
            <div class="row">
              <div class="col nopadding">
                <social-media-details
                  v-model="socialMediaDetails" @input="newSocials => {socialMediaDetails = newSocials;}"
                />
              </div>
            </div>

            <!-- Spouse's Employment Details section -->
            <div class="row">
              <div class="col nopadding">
                <employment-details
                  v-model="employmentDetails"
                                    @input="newEmploymentDetails => {employmentDetails = newEmploymentDetails;}"
                />
              </div>
            </div>

            <!-- Mark as complete button section -->
            <div class="field-group form-group-checkbox clearfix">
              <label for="is_completed">
                <input
                  id="is_completed"
                  v-model="isCompleted"
                  type="checkbox"
                  :checked="isCompleted"
                  name="is_completed"
                  :value="isCompleted"
                ><i /> <span>Mark as complete</span>
              </label>
            </div>

            <!-- Save and Continue Button section -->
            <div class="field-group field-group__action clearfix">
              <input
                type="submit"
                class="field-submit btn-primary"
                :value="buttonText"
              >
            </div>
          </form>
        </ValidationObserver>
        <div class="clearfix" />
      </div>
    </div>
  </div>
</template>
<script>
import Select2 from 'v-select2-component';
import Datepicker from 'vuejs-datepicker';
import HomeAddress from './elements/Address';
import PhoneDetails from './elements/PhoneDetails.vue';
import EmailDetails from './elements/EmailDetails.vue';
import SocialMediaDetails from './elements/SocialMediaDetails.vue';
import EmploymentDetails from './elements/EmploymentDetails.vue';
import { ValidationObserver, ValidationProvider } from 'vee-validate';

export default {
    components: {
        PhoneDetails,
        EmailDetails,
        HomeAddress,
        Datepicker,
        SocialMediaDetails,
        EmploymentDetails,
        Select2,
        ValidationObserver,
        ValidationProvider
    },
    data() {
        return {
            spouseDetails: [],
            address: {},
            citizenshipOptions: [],
            countryId: "",
            dateOfBirth: "",
            emails: [],
            employmentDetails: [],
            errors: [],
            fatherName: "",
            fatherBirthPlace: "",
            isCompleted: false,
            legalName: "",
            nickName: "",
            marriageDate: "",
            marriageLocation: "",
            motherName: "",
            motherBirthPlace: "",
            passportNumber: "",
            phoneNumbers: [],
            socialMediaDetails: [],
            personalDetailId: "",
            userId: 0,
            submitted: false
        };
    },
    computed: {
        buttonText() {
            return this.spouseDetails && this.spouseDetails.id
                ? "Update and continue"
                : "Save and continue";
        },
        disabledDates() {
            return { from: new Date() };
        }
    },
    created() {
        this.getCountryList();
        this.getSpouseInfo();
    },
    methods: {
        async handleSubmit(e) {
            this.submitted = true;
            const isValid = await this.$refs.observer.validate();
            if (isValid) {
                const formData = this.getFormData(e);
                if(this.spouseDetails && this.spouseDetails.id) {
                    formData.append("_method", "put");
                }

                if (this.spouseDetails && this.spouseDetails.id) {
                    axios
                        .post(
                            '/personal/spouse-info/' + this.spouseDetails.user_id,
                            formData
                        )
                        .then(response => {
                            console.log(response);
                            this.$router.push('/previous-spouse-question');
                        })
                        .catch(function() {});
                } else {
                    axios
                        .post('/personal/spouse-info', formData)
                        .then(response => {
                            console.log(response);
                            this.$router.push('/previous-spouse-question');
                        })
                        .catch(function() {});
                }
            }
        },
        getFormData(e) {
            const form = e.target;
            const formData = new FormData(form);

            formData.append('marriage_date', this.marriageDate);
            formData.append('marriage_location', this.marriageLocation);
            formData.append("legal_name", this.legalName);
            formData.append("nickname", this.nickName);
            formData.append("spouse_address", JSON.stringify(this.address));
            formData.append("phones", JSON.stringify(this.phoneNumbers));
            formData.append("dob", this.dateOfBirth);
            formData.append("country_id", this.countryId);
            formData.append("passport_number", this.passportNumber);
            formData.append("father_name", this.fatherName);
            formData.append("father_birth_place", this.fatherBirthPlace);
            formData.append("mother_name", this.motherName);
            formData.append("mother_birth_place", this.motherBirthPlace);
            formData.append("emails", JSON.stringify(this.emails));
            formData.append(
                "spouse_social_media",
                JSON.stringify(this.socialMediaDetails)
            );
            formData.append(
                "spouse_employer",
                JSON.stringify(this.employmentDetails)
            );
            formData.append("is_completed", this.isCompleted);

            return formData;
        },
        populateNewForm() {
            this.marriageDate= '',
            this.marriageLocation = "",
            this.legalName = "",
            this.nickName = "",
            this.address = {
                street_address1: null,
                street_address2: null,
                city: null,
                state: null,
                zipcode: null
            },
            this.phoneNumbers = [{ phone: null }],
            this.dateOfBirth = "",
            this.countryId = "",
            this.passportNumber = "",
            this.fatherName = "",
            this.fatherBirthPlace = "",
            this.motherName = "",
            this.motherBirthPlace = "",
            this.emails = [{ email: null, password: null }],
            this.socialMediaDetails = [{ social_id: null, username: null, password: null }],
            this.employmentDetails = [{
                employer_name: null,
                        employer_phone: null,
                        employer_username: null,
                        employer_password: null,
                        address: {
                            street_address1: null,
                            street_address2: null,
                            city: null,
                            state: null,
                            zipcode: null
                        },
                        benefits: []
            }],
            this.isCompleted = false;
        },
        populateData(spouseData) {
            this.spouseDetails = spouseData;

            this.marriageLocation = spouseData.marriage_location;
            this.marriageDate = spouseData.marriage_date;
            this.legalName = spouseData.legal_name;
            this.nickName = spouseData.nickname;
            this.dateOfBirth = spouseData.dob;
            this.fatherName = spouseData.father_name;
            this.fatherBirthPlace = spouseData.father_birth_place;
            this.motherName = spouseData.mother_name;
            this.motherBirthPlace = spouseData.mother_birth_place;
            this.countryId = spouseData.country_id;
            this.passportNumber = spouseData.passport_number;

            if (spouseData.address) {
            this.address = spouseData.address;
            }

            if (spouseData.phones.length > 0) {
                this.phoneNumbers = spouseData.phones;
            } else {
                this.phoneNumbers = [{ phone: null }];
            }

            if (spouseData.emails.length > 0) {
                this.emails = spouseData.emails;
            } else {
                this.emails = [{ email: null, password: null }];
            }

            if (spouseData.socials.length > 0) {
                this.socialMediaDetails = spouseData.socials;
            } else {
                this.socialMediaDetails = [
                    { social_id: null, username: null, password: null }
                ];
            }

            if (spouseData.employers.length > 0) {
                this.employmentDetails = spouseData.employers;
            } else {
                this.employmentDetails = [
                    {
                        employer_name: null,
                        employer_phone: null,
                        employer_username: null,
                        employer_password: null,
                        address: {
                            street_address1: null,
                            street_address2: null,
                            city: null,
                            state: null,
                            zipcode: null
                        },
                        benefits: []
                    }
                ];
            }

            if (spouseData.steps) {
                if (spouseData.steps.is_completed) {
                    this.isCompleted = true;
                }
            } else {
                this.isCompleted = false;
            }
         },
        getSpouseInfo() {
            axios.get("/personal/spouse-info").then(response => {
                if (response.status == 200) {
                    if (response.data.data && response.data.data.id !== undefined) {
                        this.populateData(response.data.data);
                        this.isCompleted = response.data.is_completed;
                    } else {
                        this.populateNewForm();
                    }
                }
            });
        },
        getCountryList () {
            axios.get('/countries').then(response => {
            if (response.status == 200) {
                this.citizenshipOptions = response.data.countries;
            }
        });
        },
        citizenshipChangeEvent(val) {
            console.log(val);
        },
        citizenshipSelectEvent({ id, text }) {
            console.log({
                id,
                text
            });
        }
    }
};
</script>