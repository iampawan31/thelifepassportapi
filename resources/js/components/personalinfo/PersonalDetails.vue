<template>
  <div class="c">
    <div class="question-item">
      <h3 class="heading3">
        Enter your personal details:
      </h3>
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
              <div class="col-md-6 col-sm-12 pr">
                <div class="field-group">
                  <label
                    for="legal_name"
                    class="input-label"
                  >Legal Name</label>
                  <ValidationProvider
                    v-slot="{ errors }"
                    name="Legal Name"
                    rules="required|alpha_spaces|max:30"
                  >
                    <input
                      id="legal_name"
                      v-model="legalName"
                      type="text"
                      name="legal_name"
                      class="field-input required"
                      placeholder="Legal Name"
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
              <div class="col-md-6 col-sm-12 pl">
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
            <home-address :home-address="address" address-type="personal" class="padding"
                  @home-address-update="updateHomeAddress" />

            <!-- Phone Number(s) section -->
            <div class="row">
              <div class="col nopadding">
                <phone-details
                  :user-phones="phoneNumbers"
                  @phone-details-updates="updatePhoneNumbers"
                />
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
                      name="date"
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

            <!-- Citizenship and Passport Number Section -->
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
                      v-model="citizenship"
                      name="citizenship"
                      width="resolve"
                      data-placeholder="Select an Options"
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
                    v-slot="{ errors }"
                    name="Passport Number"
                    rules="required_if:citizenship|max:20"
                  >
                    <input
                      id="passport_number"
                      v-model="passportNumber"
                      type="text"
                      name="passport_number"
                      class="field-input"
                      placeholder="Passport Number"
                    >
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
                    v-slot="{ errors }"
                    name="Father's Birthplace"
                    rules="address|max:200"
                  >
                    <input
                      id="father_birth_place"
                      v-model="fatherBirthPlace"
                      type="text"
                      name="father_birth_place"
                      class="field-input"
                      placeholder="Birth place"
                    >
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
                    v-slot="{ errors }"
                    name="Mother's Name"
                    rules="alpha_spaces|max:200"
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
                    v-slot="{ errors }"
                    name="Mother's Birthplace"
                    rules="address|max:200"
                  >
                    <input
                      id="mother_birth_place"
                      v-model="motherBirthPlace"
                      type="text"
                      name="mother_birth_place"
                      class="field-input"
                      placeholder="Birth place"
                    >
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
                  :user-emails="emails"
                  @email-details-updates="updateEmails"
                />
              </div>
            </div>

            <!-- Social media login credentials section -->
            <div class="row">
              <div class="col nopadding">
                <social-media-details
                  :user-socials="socialMediaDetails"
                  @social-media-details-updates="updateSocialMedia"
                />
              </div>
            </div>

            <!-- Employment Details section -->
            <div class="row">
              <div class="col nopadding">
                <employment-details
                  :user-employers="employmentDetails"
                  @employment-details-updated="updateEmploymentDetails"
                />
              </div>
            </div>

            <!-- Mark as complete button section -->
            <div class="field-group form-group-checkbox clearfix">
              <label for="chk_complete">
                <input
                  id="chk_complete"
                  v-model="isCompleted"
                  type="checkbox"
                  name="chk_complete"
                  :value="isCompleted"
                ><i /> <span>Mark as complete</span>
              </label>
            </div>

            <!-- Save and Continue button section -->
            <div class="field-group field-group__action clearfix">
              <input
                type="submit"
                class="field-submit btn-primary"
                value="Save and continue"
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
import PhoneDetails from './elements/PhoneDetails.vue';
import EmailDetails from './elements/EmailDetails.vue';
import HomeAddress from './elements/Address';
import SocialMediaDetails from './elements/SocialMediaDetails.vue';
import EmploymentDetails from './elements/EmploymentDetails.vue';
import { ValidationObserver, ValidationProvider } from 'vee-validate';

export default {
    components: {
        PhoneDetails,
        EmailDetails,
        SocialMediaDetails,
        EmploymentDetails,
        HomeAddress,
        Select2,
        ValidationObserver,
        ValidationProvider
    },
    data() {
        return {
            errors: [],
            legalName: "",
            nickName: "",
            address: [],
            phoneNumbers: [],
            dateOfBirth: "",
            citizenship: "",
            passportNumber: "",
            fatherName: "",
            fatherBirthPlace: "",
            motherName: "",
            motherBirthPlace: "",
            emails: [],
            socialMediaDetails: [],
            employmentDetails: [],
            citizenshipOptions: [],
            isCompleted: false,
            userId: 0,
            result2: '',
            submitted: false
        };
    },
    created() {
        this.getCountyList();
        this.getPersonalInfo();
    },
    methods: {
        async handleSubmit(e) {
            this.submitted = true;
            const isValid = await this.$refs.observer.validate();

            if (!isValid) {
                // Do Something
            } else {
                const formData = this.getFormData(e);

                console.log(formData);
 
                if (this.userId) {
                    axios
                        .post('/personal-info/' + this.userId + '/updatedata', formData)
                        .then(response => {
                            if (response.status == 200) {
                            // this.$router.push('/spouse-question');
                            }
                            //this.redirectToPage();
                        })
                        .catch(function() {});
                } else {
                    axios
                        .post('/personal-info/postdata', formData)
                        .then(response => {
                            if (response.status == 200) {
                            // this.$router.push('/spouse-question');
                            }
                        })
                        .catch(function() {});
                }
            }
        },
        async redirectToPage() {
            await axios.get('spouse/getmarriagestatus').then(response => {
                if (response.status == 200) {
                    if (response.data) {
                        console.log(response.data);
                        if (
                            (response.data.data && response.data.data.is_married == '0') ||
              (response.data.data && response.data.data.is_married == '2')
                        ) {
                            this.$router.push('/previous-spouse-question');
                        } else {
                            this.$router.push('/spouse');
                        }
                    }
                }
            });
        },
        getPersonalInfo() {
            axios.get('/getpersonalinfo').then(response => {
                if (response.status == 200) {
                    if (response.data.data[0]) {
                        this.personalDetail = JSON.parse(
                            JSON.stringify(response.data.data[0])
                        );
                        this.populateData(this.personalDetail);
                    } else {
                        this.populateNewForm();
                    }
                }
            });
        },
        getFormData(e) {
            const form = e.target;
            const formData = new FormData(form);

            formData.append('legal_name', this.legalName);
            formData.append('nickname', this.nickName);
            formData.append('home_address', this.address);
            formData.append('user_phones', this.phoneNumbers);
            formData.append('dob', this.dateOfBirth);
            formData.append('citizenship', this.citizenship);
            formData.append('passport_number', this.passportNumber);
            formData.append('father_name', this.fatherName);
            formData.append('father_birth_place', this.fatherBirthPlace);
            formData.append('mother_name', this.motherName);
            formData.append('mother_birth_place', this.motherBirthPlace);
            formData.append('emails', this.emails);
            formData.append('user_socail_media', this.socialMediaDetails);
            formData.append('user_employer', this.employmentDetails);
            formData.append('chk_complete', this.isCompleted);

            return formData;
        },
        populateNewForm () {
            this.legalName = "";
            this.nickName = "";
            this.address = [];
            this.phoneNumbers = [];
            this.dateOfBirth = "";
            this.citizenship = "";
            this.passportNumber = "";
            this.fatherName = "";
            this.fatherBirthPlace = "";
            this.motherName = "";
            this.motherBirthPlace = "";
            this.emails = [];
            this.socialMediaDetails = [];
            this.employmentDetails = [];
            this.isCompleted = false;
        },
        populateData (personalDetail) {
            this.userId = personalDetail.user_id;

            if(personalDetail.legal_name) {
                this.legalName = personalDetail.legal_name;
            }

            if(personalDetail.nickname) {
                this.nickName = personalDetail.nickname;
            }

            if(personalDetail.home_address) {
                this.address = personalDetail.home_address;
            }

            if (personalDetail.user_phone.length > 0) {
                this.phoneNumbers = personalDetail.user_phone;
            } else {
                this.phoneNumbers = [{ number: null }];
            }

            if(personalDetail.dob) {
                this.dateOfBirth = personalDetail.dob;
            }

            if(personalDetail.father_name) {
                this.fatherName = personalDetail.father_name;
            }

            if(personalDetail.father_birth_place) {
                this.fatherBirthPlace = personalDetail.father_birth_place;
            }

            if(personalDetail.mother_name) {
                this.motherName = personalDetail.mother_name;
            }

            if(personalDetail.mother_birth_place) {
                this.motherBirthPlace = personalDetail.mother_birth_place;
            }

            if(personalDetail.citizenship) {
                this.citizenship = personalDetail.citizenship;
            }

            if(personalDetail.passport_number) {
                this.passportNumber = personalDetail.passport_number;
            }

            if (personalDetail.user_email.length > 0) {
                this.emails = personalDetail.user_email;
            } else {
                this.emails = [{ email: null, password: null }];
            }

            if (personalDetail.user_socail_media.length > 0) {
                this.socialMediaDetails = personalDetail.user_socail_media;
            } else {
                this.socialMediaDetails = [{ social: null, username: null, password: null }];
            }

            if (personalDetail.user_employer.length > 0) {
                this.employmentDetails = personalDetail.user_employer;
            } else {
                this.employmentDetails = [
                    {
                        employer_name: null,
                        employer_phone: null,
                        employer_address: null,
                        computer_username: null,
                        computer_password: null,
                        address: null,
                        employeeBenefits: null
                    }
                ];
            }

            if(personalDetail.users_personal_details_completion.length > 0) {
                if (personalDetail.users_personal_details_completion[0].is_completed == 1) {
                    this.isCompleted = true;
                }
            } else {
                //this.completionStatus = { step_id: null, is_visited: null, is_filled: null, is_completed: null };
                this.isCompleted = false;
            }
        },
        getCountyList() {
            axios.get('/countrylist').then(response => {
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
            this.phoneNumbers = data;
        },
        updateEmails(data) {
            this.emails = data;
        },
        updateSocialMedia(data) {
            this.socialMediaDetails = data;
        },
        updateEmploymentDetails(data) {
            this.employmentDetails = data;
        },
        updateHomeAddress(data) {
            this.address = data;
        }
    }
};
</script>
