<template>
  <div class="c">
    <div class="question-item">
      <h3 class="heading3">Enter your personal details:</h3>
      <div class="form-wrapper">
        <ValidationObserver
          ref="observer"
          v-slot="{ invalid }"
        >
          <form
            id="frmPersonalDetails"
            name="frmPersonalDetails"
            method="post"
            class="custom-form"
            @submit.prevent="handleSubmit"
          >

            <!-- Legal name and Nick name section -->
            <div class="row">
              <div class="col-md-6 col-sm-12 nopadding">
                <div class="field-group">
                  <label
                    for="legal_name"
                    class="input-label"
                  >Legal Name</label>
                  <ValidationProvider
                    name="Legal Name"
                    rules="required|alpha_spaces|max:30"
                    v-slot="{ errors }"
                  >
                    <input
                      type="text"
                      name="legal_name"
                      v-model="personalDetail.legal_name"
                      id="legal_name"
                      class="field-input required"
                      placeholder="Legal Name"
                    />
                    <span
                      v-if="errors != undefined && errors.length"
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
                    for="nickname"
                    class="input-label"
                  >Nickname or Prior Name</label>
                  <ValidationProvider
                    name="Nick Name"
                    rules="alpha_spaces|max:30"
                    v-slot="{ errors }"
                  >
                    <input
                      type="text"
                      name="nickname"
                      id="nickname"
                      v-model="personalDetail.nickname"
                      class="field-input"
                      placeholder="Nickname or prior name"
                    />
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

            <!-- Home Address Section -->
            <div class="row">
              <div class="col nopadding">
                <div class="field-group">
                  <label for="home_address">Home Address</label>
                  <ValidationProvider
                    name="Home Address"
                    rules="max:200"
                    v-slot="{ errors }"
                  >
                    <textarea
                      rows="2"
                      name="home_address"
                      id="home_address"
                      v-model="personalDetail.home_address"
                      class="field-input"
                      placeholder="Street Address, Town, City, State, Zipcode and country"
                    ></textarea>
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

            <!-- Phone Number(s) section -->
            <div class="row">
              <div class="col nopadding">
                <phone-details
                  v-on:phone-details-updates="updatePhoneNumbers"
                  :user-phones="phones"
                  v-if="phones.length > 0"
                ></phone-details>
              </div>
            </div>

            <!-- Date of birth Section -->
            <div class="row">
              <div class="col nopadding">
                <div class="field-group">
                  <label
                    for="dob"
                    class="input-label"
                  >Date of Birth</label>
                  <date-picker
                    name="date"
                    :disabled-dates="disabledDates"
                    placeholder="M/dd/YYYY"
                    :format="'M/dd/yyyy'"
                    @selected="updateBirthDateFormat"
                    v-model="personalDetail.dob"
                    class="field-datepicker field-input"
                  >
                  </date-picker>
                </div>
              </div>
            </div>

            <!-- Citizenship and Passport Number Section -->
            <div class="row">
              <div class="col-md-6 col-sm-12 nopadding">
                <div class="field-group">
                  <label
                    for="citizenship"
                    class="input-label"
                  >Citizenship</label>
                  <validation-provider
                    vid="citizenship"
                    v-slot="{ errors }"
                  >
                    <Select2
                      name="citizenship"
                      id="citizenship"
                      width="resolve"
                      data-placeholder="Select an Options"
                      v-model="personalDetail.country_id"
                      :options="citizenshipOptions"
                      @change="citizenshipChangeEvent($event)"
                      @select="citizenshipSelectEvent($event)"
                    />
                    <span
                      v-if="errors != undefined && errors.length"
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
                    name="Passport Number"
                    rules="required_if:citizenship"
                    v-slot="{ errors }"
                  >
                    <input
                      type="text"
                      name="passport_number"
                      id="passport_number"
                      v-model="personalDetail.passport_number"
                      class="field-input"
                      placeholder="Passport Number"
                    />
                    <span
                      v-if="errors != undefined && errors.length"
                      class="invalid-feedback d-block"
                    >
                      {{ errors[0] }}
                    </span>
                  </validation-provider>
                </div>
              </div>
            </div>

            <!-- Father's name and birthplace section -->
            <div class="row">
              <div class="col-md-6 col-sm-12 clearfix nopadding">
                <div class="field-group">
                  <validation-provider
                    name="Father's Name"
                    rules="alpha_spaces"
                    v-slot="{ errors }"
                  >
                    <label
                      for="father_name"
                      class="input-label"
                    >Father's name</label>
                    <input
                      type="text"
                      name="father_name"
                      id="father_name"
                      v-model="personalDetail.father_name"
                      class="field-input"
                      placeholder="Father's Name"
                    />
                    <div
                      v-if="errors != undefined && errors.length"
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
                    name="Father's Birthplace"
                    rules="alpha_num"
                    v-slot="{ errors }"
                  >
                    <input
                      type="text"
                      name="father_birth_place"
                      id="father_birth_place"
                      v-model="personalDetail.father_birth_place"
                      class="field-input"
                      placeholder="Birth place"
                    />
                    <div
                      v-if="errors != undefined && errors.length"
                      class="invalid-feedback d-block"
                    >
                      {{ errors[0] }}
                    </div>
                  </validation-provider>
                </div>
              </div>
            </div>

            <!-- Mother's Name and birthplace section -->
            <div class="row">
              <div class="col-md-6 col-sm-12 nopadding">
                <div class="field-group">
                  <label
                    for="mother_name"
                    class="input-label"
                  >Mother's Name</label>
                  <validation-provider
                    name="Mother's Name"
                    rules="alpha_spaces"
                    v-slot="{ errors }"
                  >
                    <input
                      type="text"
                      name="mother_name"
                      id="mother_name"
                      class="field-input"
                      v-model="personalDetail.mother_name"
                      placeholder="Mother's Name"
                    />
                    <div
                      v-if="errors != undefined && errors.length"
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
                    name="Mother's Birthplace"
                    rules="alpha_num"
                    v-slot="{ errors }"
                  >
                    <input
                      type="text"
                      name="mother_birth_place"
                      id="mother_birth_place"
                      v-model="personalDetail.mother_birth_place"
                      class="field-input"
                      placeholder="Birth place"
                    />
                    <div
                      v-if="errors != undefined && errors.length"
                      class="invalid-feedback d-block"
                    >
                      {{ errors[0] }}
                    </div>
                  </validation-provider>
                </div>
              </div>
            </div>

            <!-- Email(s) credentials section -->
            <div class="row">
              <div class="col nopadding">
                <email-details
                  v-on:email-details-updates="updateEmails"
                  :user-emails="emails"
                  v-if="emails.length"
                ></email-details>
              </div>
            </div>

            <!-- Social media login credentials section -->
            <div class="row">
              <div class="col nopadding">
                <social-media-details
                  v-on:social-media-details-updates="updateSocialMedia"
                  :user-socials="socials"
                  v-if="socials !== undefined && socials.length"
                ></social-media-details>
              </div>
            </div>

            <!-- Employment Details section -->
            <div class="row">
              <div class="col nopadding">
                <employment-details
                  v-on:employment-details-updated="updateEmploymentDetails"
                  :user-employers="employers"
                  v-if="employers !== undefined && employers.length > 0"
                ></employment-details>
              </div>
            </div>

            <!-- Mark as complete button section -->
            <div class="field-group form-group-checkbox clearfix">
              <label for="chk_complete">
                <input
                  type="checkbox"
                  name="chk_complete"
                  id="chk_complete"
                  value="1"
                /><i></i> <span>Mark as complete</span>
              </label>
            </div>

            <!-- Save and Continue button section -->
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
import DatePicker from "vuejs-datepicker";
import Select2 from "v-select2-component";
import PhoneDetails from "./PhoneDetails.vue";
import EmailDetails from "./EmailDetails.vue";
import SocialMediaDetails from "./SocialMediaDetails.vue";
import EmploymentDetails from "./EmploymentDetails.vue";
import { ValidationObserver, ValidationProvider } from "vee-validate";
import { extend } from "vee-validate";
import {
  alpha_spaces,
  alpha_num,
  max,
  required_if
} from "vee-validate/dist/rules";
import { async } from "q";
import VueRouter from "vue-router";

export default {
  components: {
    PhoneDetails,
    EmailDetails,
    DatePicker,
    SocialMediaDetails,
    EmploymentDetails,
    Select2,
    ValidationObserver,
    ValidationProvider
  },
  data() {
    return {
      errors: [],
      personalDetail: [],
      citizenshipOptions: [],
      phones: [],
      emails: [],
      socials: [],
      employers: [],
      userId: 0,
      result2: "",
      // lang: {
      // 	days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      // 	months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      // 	pickers: ['next 7 days', 'next 30 days', 'previous 7 days', 'previous 30 days'],
      // 	placeholder: {
      // 		date: 'Select Date',
      // 		dateRange: 'Select Date Range'
      // 	}
      // },
      submitted: false
    };
  },
  created() {
    this.getCountyList();
    this.getPersonalInfo();
  },
  computed: {
    disabledDates() {
      return { from: new Date() };
    }
  },
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
            .post("/personal-info/" + this.userId + "/updatedata", formData)
            .then(response => {
              this.$router.push("/spouse-question");
              //this.redirectToPage();
            })
            .catch(function() {});
        } else {
          axios
            .post("/personal-info/postdata", formData)
            .then(response => {
              this.$router.push("/spouse-question");
            })
            .catch(function() {});
        }
      }
    },
    async redirectToPage() {
      await axios.get("spouse/getmarriagestatus").then(response => {
        if (response.status == 200) {
          if (response.data) {
            console.log(response.data);
            if (
              (response.data.data && response.data.data.is_married == "0") ||
              (response.data.data && response.data.data.is_married == "2")
            ) {
              this.$router.push("/previous-spouse-question");
            } else {
              this.$router.push("/spouse");
            }
          }
        }
      });
    },
    getPersonalInfo() {
      axios.get("/getpersonalinfo").then(response => {
        if (response.status == 200) {
          console.log(response.data);
          if (response.data.data[0]) {
            this.personalDetail = JSON.parse(
              JSON.stringify(response.data.data[0])
            );
            this.userId = this.personalDetail.user_id;

            if (this.personalDetail.user_phone.length > 0) {
              this.phones = this.personalDetail.user_phone;
            } else {
              this.phones = [{ number: null }];
            }

            if (this.personalDetail.user_email.length > 0) {
              this.emails = this.personalDetail.user_email;
            } else {
              this.emails = [{ email: null, password: null }];
            }

            if (this.personalDetail.user_socail_media.length > 0) {
              this.socials = this.personalDetail.user_socail_media;
            } else {
              this.socials = [{ social: null, username: null, password: null }];
            }

            if (this.personalDetail.user_employer.length > 0) {
              this.employers = this.personalDetail.user_employer;
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
            this.socials = [{ social: null, username: null, password: null }];
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
    getCountyList() {
      axios.get("/countrylist").then(response => {
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
    },
    updatePhoneNumbers(data) {
      this.phones = data;
    },
    updateEmails(data) {
      this.emails = data;
    },
    updateSocialMedia(data) {
      this.socials = data;
    },
    updateEmploymentDetails(index, data) {
      this.employers[index] = data;
    },
    updateBirthDateFormat() {
      this.personalDetail.dob = new Date(this.personalDetail.dob).toString;
    }
  }
};

extend("alpha_spaces", alpha_spaces);
extend("max", max);
extend("required_if", required_if);
extend("alpha_num", alpha_num);
</script>
<style>
.mb-2 {
  margin-bottom: 2px;
}
</style>
