<template>
  <div class="c">
    <div
      class="question-item"
      data-nextpage="questions/previous-spouse.php"
    >
      <h3 class="heading3">Your spouse details</h3>

      <div class="form-wrapper">
        <div class="error-message"></div>
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
                  <validation-provider
                    name="Marriage Location"
                    rules="required"
                    v-slot="{ errors }"
                  >
                    <datepicker
                      name="marriage_date"
                      placeholder="M/dd/YYYY"
                      :format="'M/dd/yyyy'"
                      :disabled-dates="disabledDates"
                      v-model="spouseDetails.marriage_date"
                      class="field-datepicker field-input"
                    >
                    </datepicker>
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
                    for="marriage_location"
                    class="input-label"
                  >Marriage Location</label>
                  <validation-provider
                    name="Marriage Location"
                    rules="required|address|max:200"
                    v-slot="{ errors }"
                  >
                    <input
                      type="text"
                      name="marriage_location"
                      id="marriage_location"
                      class="field-input required"
                      placeholder="Location"
                      v-model="spouseDetails.marriage_location"
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

            <!-- Spouse Details Heading -->
            <h4 class="form-subhead">Spouse Details</h4>

            <!-- Legal name and nick name section -->
            <div class="row">
              <div class="col-md-6 col-sm-12 nopadding">
                <div class="field-group">
                  <label
                    for="legal_name"
                    class="input-label"
                  >Legal Name</label>
                  <ValidationProvider
                    name="Legal Name"
                    rules="required|max:50"
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
                      class="field-input"
                      placeholder="Nickname or prior name"
                      v-model="spouseDetails.nickname"
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

            <!-- Spouse Home Address Section -->
            <div class="row">
              <div class="col nopadding">
                <div class="field-group">
                  <label for="home_address">Home Address</label>
                  <ValidationProvider
                    name="Home Address"
                    rules="max:1000"
                    v-slot="{ errors }"
                  >
                    <textarea
                      rows="2"
                      name="home_address"
                      id="home_address"
                      v-model="spouseDetails.home_address"
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

            <!-- Spouse's Phone number(s) section -->
            <div class="row">
              <div class="col nopadding">
                <phone-details
                  v-on:phone-details-updates="updatePhoneNumbers"
                  :user-phones="phones"
                  v-if="phones.length > 0"
                ></phone-details>
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
                  <datepicker
                    name="dob"
                    format="MM/d/yyyy"
                    placeholder="MM/DD/YYYY"
                    :disabled-dates="disabledDates"
                    v-model="spouseDetails.dob"
                    class="field-datepicker field-input"
                  >
                  </datepicker>
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
                    name="Citizenship"
                    vid="citizenship"
                    v-slot="{ errors }"
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
                    rules="required_if:citizenship|max:20"
                    v-slot="{ errors }"
                  >
                    <input
                      type="text"
                      name="passport_number"
                      id="passport_number"
                      class="field-input"
                      placeholder="Passport Number"
                      v-model="spouseDetails.passport_number"
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

            <!-- Spouse's Father name and birth place section -->
            <div class="row">
              <div class="col-md-6 col-sm-12 nopadding">
                <div class="field-group">
                  <validation-provider
                    name="Father's Name"
                    rules="alpha_spaces|max:50"
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
                      class="field-input"
                      placeholder="Father's Name"
                      v-model="spouseDetails.father_name"
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
                    rules="address|max:200"
                    v-slot="{ errors }"
                  >
                    <input
                      type="text"
                      name="father_birth_place"
                      id="father_birth_place"
                      class="field-input field-input__last"
                      placeholder="Birth place"
                      v-model="spouseDetails.father_birth_place"
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

            <!-- Spouse's Mother name and birth place section -->
            <div class="row">
              <div class="col-md-6 col-sm-12 nopadding">
                <div class="field-group">
                  <label
                    for="mother_name"
                    class="input-label"
                  >Mother's Name</label>
                  <validation-provider
                    name="Mother's Name"
                    rules="alpha_spaces|max:50"
                    v-slot="{ errors }"
                  >
                    <input
                      type="text"
                      name="mother_name"
                      id="mother_name"
                      class="field-input"
                      placeholder="Mother's Name"
                      v-model="spouseDetails.mother_name"
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
                    rules="address|max:200"
                    v-slot="{ errors }"
                  >
                    <input
                      type="text"
                      name="mother_birth_place"
                      id="mother_birth_place"
                      class="field-input field-input__last"
                      placeholder="Birth place"
                      v-model="spouseDetails.mother_birth_place"
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

            <!-- Spouse's email(s) credentials section -->
            <div class="row">
              <div class="col nopadding">
                <email-details
                  v-on:email-details-updates="updateEmails"
                  :user-emails="emails"
                  v-if="emails !== undefined && emails.length"
                ></email-details>
              </div>
            </div>

            <!-- Spouse's Social media credentials section -->
            <div class="row">
              <div class="col nopadding">
                <social-media-details
                  v-on:social-media-details-updates="updateSocialMedia"
                  :user-socials="socials"
                  v-if="socials !== undefined && socials.length"
                ></social-media-details>
              </div>
            </div>

            <!-- Spouse's Employment Details section -->
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
                  v-model="is_completed"
                  :value="is_completed"
                /><i></i> <span>Mark as complete</span>
              </label>
            </div>

            <!-- Save and Continue Button section -->
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
import Select2 from "v-select2-component";
import Datepicker from "vuejs-datepicker";
import PhoneDetails from "./PhoneDetails.vue";
import EmailDetails from "./EmailDetails.vue";
import SocialMediaDetails from "./SocialMediaDetails.vue";
import EmploymentDetails from "./EmploymentDetails.vue";
import { ValidationObserver, ValidationProvider } from "vee-validate";


export default {
  components: {
    PhoneDetails,
    EmailDetails,
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
      phones: [],
      emails: [],
      socials: [],
      employers: [],
      userId: 0,
      submitted: false,
      citizenshipOptions: [],
      is_completed: false,
    };
  },
  computed: {
    disabledDates() {
      return { from: new Date() };
    }
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
            this.socials = [{ social: null, username: null, password: null }];
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
          if(this.spouseDetails.users_personal_details_completion.length > 0) {
            if (this.spouseDetails.users_personal_details_completion[0].is_completed == 1) {
              this.is_completed = true;
            }
          } else {
            //this.completionStatus = { step_id: null, is_visited: null, is_filled: null, is_completed: null };
            this.is_completed = false;
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
          this.is_completed = false;
        }
      }
    });
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
            .post("/spouse/" + this.userId + "/updatedata", formData)
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
    }
  }
};
</script>

<style>
.mb-2 {
  margin-bottom: 2px;
}
</style>
