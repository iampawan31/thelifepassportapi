<template>
  <div class="c">
    <div class="question-item" data-nextpage="questions/spouse.php" data-prevpage>
      <h3 class="heading3">Enter your personal details:</h3>
      <div class="form-wrapper">
        <div class="error-message"></div>
        <form
          id="frmPersonalDetails"
          name="frmPersonalDetails"
          action="#"
          method="post"
          class="custom-form"
        >
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <div class="field-group">
                <label for="legal_name" class="input-label">Legal Name</label>
                <input
                  type="text"
                  name="legal_name"
                  id="legal_name"
                  class="field-input required"
                  placeholder="Legal Name"
                />
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="field-group">
                <label for="nickname" class="input-label">Nickname or Prior Name</label>
                <input
                  type="text"
                  name="nickname"
                  id="nickname"
                  class="field-input"
                  placeholder="Nickname or prior name"
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
              class="field-input"
              placeholder="Street Address, Town, City, State, Zipcode and country"
            ></textarea>
          </div>
          <phone></phone>
          <div class="field-group">
            <label for="dob" class="input-label">Date of Birth</label>
            <date-picker 
                v-model="dob" 
                valueType="format" 
                :first-day-of-week="1" 
                :lang="lang"
                format="MM/DD/YYYY"
                placeholder="MM/DD/YYYY"
                width="100%"
                class="field-datepicker field-input">
            </date-picker>
          </div>

          <div class="row">
            <div class="col-md-6 col-sm-12">
              <div class="field-group">
                <label for="citizenship" class="input-label">Citizenship</label>
                <!-- <select
                  name="citizenship"
                  id="citizenship"
                  class="custom-select"
                  data-placeholder="Citizenship"
                >
                  <option></option>
                  <option value="1">Brother</option>
                  <option value="2">Sister</option>
                  <option value="3">Son</option>
                  <option value="4">Daughter</option>
                  <option value="5">Other</option>
                </select> -->

                <vue-select class="custom-select" name="citizenship"
                        :options="citizenship" :model.sync="result2"
                        :searchable="true" language="en-US">
                </vue-select>

              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="field-group">
                <label for="passport_number" class="input-label">Passport Number</label>
                <input
                  type="text"
                  name="passport_number"
                  id="passport_number"
                  class="field-input"
                  placeholder="Passport Number"
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
              />
              <input
                type="text"
                name="father_birth_place"
                id="father_birth_place"
                class="field-input field-input__last"
                placeholder="Birth place"
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
              />
              <input
                type="text"
                name="mother_birth_place"
                id="mother_birth_place"
                class="field-input field-input__last"
                placeholder="Birth place"
              />
            </div>
          </div>

          <h4 class="form-subhead">Email Addresses</h4>
          <div class="field-group">
            <div class="fields-group clearfix">
              <input
                type="text"
                name="primary_email"
                id="primary_email"
                class="field-input field-input__first email"
                placeholder="Email address"
              />
              <input
                type="password"
                name="primary_email_pwd"
                id="primary_email_pwd"
                class="field-input field-input__last"
                placeholder="password"
              />
            </div>
            <!-- <div class="add-anohter-field">
              <div class="field-wrapper hidden">
                <div class="fields-group clearfix">
                  <input
                    type="text"
                    name="spouse_email"
                    id="spouse_email"
                    class="field-input field-input__first email"
                    placeholder="Email address"
                  />
                  <input
                    type="password"
                    name="spouse_email_pwd"
                    id="spouse_email_pwd"
                    class="field-input field-input__last"
                    placeholder="password"
                  />
                </div>
                <a href="#" class="btn-remove"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg></a>
              </div>
              <div class="btn-add">
                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Add another</a>
              </div>
            </div> -->
          </div>

          <h4 class="form-subhead">Social Media</h4>
          <div class="field-group">
            <div class="row">
              <div class="col-md-5">
                <select
                  name="social_media_type"
                  id="social_media_type"
                  class="custom-select"
                  data-placeholder="Social Media Account"
                >
                  <option></option>
                  <option value="1">Facebook</option>
                  <option value="2">Twitter</option>
                  <option value="3">Instagram</option>
                  <option value="4">LinkedIn</option>
                  <option value="5">YouTube</option>
                  <option value="6">Other</option>
                </select>
              </div>
              <div class="col-md-7 col-sm-12">
                <div class="fields-group clearfix">
                  <input
                    type="text"
                    name="social_username"
                    id="social_username"
                    class="field-input"
                    placeholder="Username"
                  />
                  <input
                    type="password"
                    name="social_password"
                    id="social_password"
                    class="field-input field-input__last"
                    placeholder="Password"
                  />
                </div>
              </div>
            </div>
            <!-- <div class="add-anohter-field">
              <div class="field-wrapper hidden">
                <div class="row">
                  <div class="col-md-5">
                    <select
                      name="social_media_type<?php echo $i?>"
                      id="social_media_type<?php echo $i?>"
                      class="custom-select"
                      data-placeholder="Social Media Account"
                    >
                      <option></option>
                      <option value="1">Facebook</option>
                      <option value="2">Twitter</option>
                      <option value="3">Instagram</option>
                      <option value="4">LinkedIn</option>
                      <option value="5">YouTube</option>
                      <option value="6">Other</option>
                    </select>
                  </div>
                  <div class="col-md-7 col-sm-12">
                    <div class="fields-group clearfix">
                      <input
                        type="text"
                        name="social_username"
                        id="social_username"
                        class="field-input"
                        placeholder="Username"
                      />
                      <input
                        type="password"
                        name="social_password"
                        id="social_password"
                        class="field-input field-input__last"
                        placeholder="Password"
                      />
                    </div>
                  </div>
                </div>
                <a href="#" class="btn-remove"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg></a>
              </div>
              <div class="btn-add">
                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Add another</a>
              </div>
            </div> -->
          </div>

          <h4 class="form-subhead">Current Employers including self employment</h4>
          <div class="add-anohter-field">
            <div class="field-wrapper hidden">
              <div class="form-subgroup">
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="field-group">
                      <label for="spouse_employer_name" class="input-label">Employer Name</label>
                      <input
                        type="text"
                        name="spouse_employer_name"
                        id="spouse_employer_name"
                        class="field-input"
                        placeholder="Employer Name"
                      />
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="field-group">
                      <label for="spouse_employer_phone" class="input-label">Employer Phone</label>
                      <input
                        type="text"
                        name="spouse_employer_phone"
                        id="spouse_employer_phone"
                        class="field-input"
                        placeholder="Phone number"
                      />
                    </div>
                  </div>
                </div>

                <div class="field-group">
                  <label for="spouse_employer_address">Employer Address</label>
                  <textarea
                    rows="2"
                    name="spouse_employer_address"
                    id="spouse_employer_address"
                    class="field-input"
                    placeholder="Street Address, Town, City, State, Zipcode and country"
                  ></textarea>
                </div>

                <div class="field-group">
                  <label for="spouse_company_computer">Company computer user name and password</label>
                  <div class="row">
                    <div class="col-md-6 col-sm-12">
                      <input
                        type="text"
                        name="spouse_company_computer_un"
                        id="spouse_company_computer_un"
                        class="field-input"
                        placeholder="Username"
                      />
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <input
                        type="text"
                        name="spouse_company_computer_pwd"
                        id="spouse_company_computer_pwd"
                        class="field-input"
                        placeholder="Password"
                      />
                    </div>
                  </div>
                </div>

                <div class="field-group field-group__last">
                  <label for="spouse_employer_benefits">Benefits used</label>
                  <textarea
                    rows="2"
                    name="spouse_employer_benefits"
                    id="spouse_employer_benefits"
                    class="field-input"
                    placeholder="Benefits used"
                  ></textarea>
                </div>
              </div>
              <a href="#" class="btn-remove"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg></a>
            </div>
            <div class="btn-add">
                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Add another</a>
            </div>
          </div>

          <div class="field-group field-group__action clearfix">
            <input type="submit" class="field-submit btn-primary" value="Save and continue" />
          </div>
        </form>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</template>
<script>
import DatePicker from 'vue2-datepicker';
import VueSelect from 'vue-select';
import phone from './Phone.vue';

import { required, email, minLength } from "vuelidate/lib/validators";
export default {
 components: {
    phone,
    DatePicker,
    VueSelect
  },
  data() {
    return {
        dob: "",
        citizenship: [
            {
                text: "India",
                value: "IN"
            }, 
            {
                text: "United State",
                value: "US"
            }, 
            {
                text: "United Kingdom",
                value: "UK"
            }
        ],
        result2: "",
        lang: {
            days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            pickers: ['next 7 days', 'next 30 days', 'previous 7 days', 'previous 30 days'],
            placeholder: {
            date: 'Select Date',
            dateRange: 'Select Date Range'
            }
        },
        user: {
            legal_name: "",
            nick_name: "",
            home_address: "",
            phone_nubmer: "",
            dob: "",
            email: ""
        },
        submitted: false
    };
  },
  validations: {
    user: {
      legal_name: { required },
      nick_name: { required },
      home_address: { required, minLength: minLength(500) },
      phone_nubmer: { required, minLength: minLength(10) },
      dob: { required, minLength: minLength(10) },
      email: { required, email }
    }
  },
  mounted() {},
  methods: {
    handleSubmit(e) {
      this.submitted = true;
      // stop here if form is invalid
      this.$v.$touch();
      console.log(this.$v.user.legal_name.$error);
      console.log(this.$v.user.legal_name.required);
      if (this.$v.$invalid) {
        console.log("invalid");
        return;
      }

      alert("SUCCESS!! :-)\n\n" + JSON.stringify(this.user));
    }
  }
};
</script>