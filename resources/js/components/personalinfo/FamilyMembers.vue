<template>
  <div class="c">
    <div
      class="question-item"
      data-nextpage="questions/close-friends.php"
    >
      <h3 class="heading3">Close family members</h3>
      <div
        id="add-member"
        class="section-form"
      >

        <!-- Add Family member section -->
        <div class="form-wrapper form-family-member">
          <h3 class="heading4 uppercase">Add family member</h3>
          <div class="error-message"></div>
          <ValidationObserver
            ref="observer"
            v-slot="{ invalid }"
          >
            <form
              id="frmFamilyMember"
              name="frmFamilyMember"
              action="#"
              method="post"
              class="custom-form"
              @submit.prevent="handleSubmit()"
            >

              <!-- Name section -->
              <div class="row">
                <div class="col">
                  <div class="field-group">
                    <label
                      for="txt_name"
                      class="input-label"
                    >Name</label>
                    <ValidationProvider
                      name="Name"
                      rules="required|alpha_spaces"
                      v-slot="{ errors }"
                    >
                      <input
                        type="text"
                        name="txt_name"
                        id="txt_name"
                        data-id="txt_name"
                        class="field-input required"
                        placeholder="Name"
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
              </div>

              <!-- Relationship section -->
              <div class="row">
                <div class="col">
                  <div class="field-group">
                    <label
                      for="relationship"
                      class="input-label"
                    >Relationship</label>
                    <validation-provider
                      vid="relationship_selection"
                      v-slot="{ errors }"
                    >
                      <Select2
                        name="relationship"
                        id="relationship"
                        data-placeholder="Relationship"
                        width="resolve"
                        v-model="relationship"
                        :options="relationshipOptions"
                        @change="relationshipChangeEvent($event)"
                        @select="relationshipSelectEvent($event)"
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
                <div
                  class="col"
                  v-show="isOtherSelected"
                >
                  <div class="field-group">
                    <label
                      for="relationship"
                      class="input-label"
                    >Relationship</label>
                    <validation-provider
                      rules="required_if:relationship_selection,5"
                      v-slot="{ errors }"
                    >
                      <input
                        type="text"
                        name="relatiionship_other"
                        id="relatiionship_other"
                        class="field-input"
                        placeholder="Please specify relation"
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

              <!-- Home addresss section -->
              <div class="row">
                <div class="col">
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

              <!-- Phone number(s) section -->
              <div class="row">
                <div class="col">
                  <phone-details
                    v-on:phone-details-updates="updatePhoneNumbers"
                    :user-phones="phoneNumbers"
                  ></phone-details>
                </div>
              </div>

              <!-- Former spouse's Email address section -->
              <div class="row">
                <div class="col">
                  <div class="field-group">
                    <label
                      for="email"
                      class="input-label"
                    >Email</label>
                    <ValidationProvider
                      name="Email address"
                      rules="email"
                      v-slot="{ errors }"
                    >
                      <input
                        type="text"
                        name="user_email"
                        id="user_email"
                        class="field-input required email"
                        placeholder="Email address"
                        v-model="emailAddress"
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

              <!-- Date of birth Section -->
              <div class="row">
                <div class="col">
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
                      v-model="dateOfBirth"
                      class="field-datepicker field-input"
                    >
                    </date-picker>
                  </div>
                </div>
              </div>
              <div class="field-group clearfix">
                <input
                  type="submit"
                  class="field-submit btn-primary"
                  value="Add Member"
                />
              </div>
            </form>
          </ValidationObserver>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Select2 from "v-select2-component";
import DatePicker from "vuejs-datepicker";
import PhoneDetails from "./PhoneDetails.vue";
import Email from "./Email.vue";
import { ValidationObserver, ValidationProvider } from "vee-validate";
import { extend } from "vee-validate";
import {
  email,
  required_if,
  alpha_spaces,
  alpha_num,
  max,
  regex
} from "vee-validate/dist/rules";

export default {
  components: {
    PhoneDetails,
    Email,
    DatePicker,
    Select2,
    ValidationObserver,
    ValidationProvider
  },
  computed: {
    isOtherSelected() {
      return this.relationship === "5" ? true : false;
    },
    disabledDates() {
      return { from: new Date() };
    }
  },
  data() {
    return {
      name: "",
      relationship: "",
      homeAddress: "",
      phoneNumbers: [],
      emailAddress: "",
      dateOfBirth: "",
      relationshipOptions: [
        { id: 1, text: "Brother" },
        { id: 2, text: "Sister" },
        { id: 3, text: "Son" },
        { id: 4, text: "Daughter" },
        { id: 5, text: "Other" }
      ]
    };
  },
  mounted() {},
  methods: {
    handleSubmit(e) {
      this.$router.push("/close-friends-question");
    },
    relationshipChangeEvent(event) {
      console.log(event);
    },
    relationshipSelectEvent(event) {
      console.log(event);
    },
    updatePhoneNumbers(data) {
      this.phoneNumbers = data;
    }
  }
};

extend("email", email);
extend("max", max);
extend("regex", regex);
extend("alpha_num", alpha_num);
extend("alpha_spaces", alpha_spaces);
extend("required_if", required_if);
</script>
