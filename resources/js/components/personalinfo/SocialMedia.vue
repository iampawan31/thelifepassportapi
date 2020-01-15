<template>
  <div class="row">
    <div class="col-md-4 col-sm-12">
      <validation-provider
        name="Social Media Type"
        vid="social_media_type"
        v-slot="{ errors }"
      >
        <Select2
          width="resolve"
          name="social_media_type[]"
          placeholder="Select an Options"
          :options="socialMediaOptions"
          v-model="tempSocialMediaType"
        />
        <span
          v-if="errors != undefined && errors"
          class="invalid-feedback d-block"
        >{{ errors[0] }}</span>
      </validation-provider>
    </div>
    <div class="col-md-4 col-sm-12 nopadding">
      <validation-provider
        name="Username"
        vid="social_media_username"
        :rules="'required_if:social_media_type|max:30'"
        v-slot="{ errors }"
      >
        <input
          type="text"
          name="social_username[]"
          class="field-input"
          placeholder="Username"
          v-model="tempUsername"
          value=""
        />
        <span
          v-if="errors != undefined && errors"
          class="invalid-feedback d-block"
        >{{ errors[0] }}</span> </validation-provider>
    </div>
    <div class="col-md-4 col-sm-12 nopadding">
      <validation-provider
        name="Password"
        :rules="'required_if:social_media_username|max:30'"
        v-slot="{ errors }"
      >
        <input
          type="password"
          name="social_password[]"
          class="field-input field-input__last"
          placeholder="Password"
          v-model="tempPassword"
          value=""
        />
        <span
          v-if="errors != undefined && errors"
          class="invalid-feedback d-block"
        >{{ errors[0] }}</span>
      </validation-provider>
    </div>
  </div>
</template>

<script>
import Select2 from "v-select2-component";
import { ValidationProvider } from "vee-validate";
import { extend } from "vee-validate";
import { required_if, alpha_num, max } from "vee-validate/dist/rules";
export default {
  components: {
    ValidationProvider,
    Select2
  },
  props: [
    "socialMediaKey",
    "socialMediaOptions",
    "socialMediaType",
    "socialMediaUsername",
    "socialMediaPassword"
  ],
  data() {
    return {
      errors: [],
      tempSocialMediaType: "",
      tempUsername: "",
      tempPassword: ""
    };
  },
  watch: {
    tempSocialMediaType() {
      this.$emit(
        "social-media-update",
        this.socialMediaKey,
        this.tempSocialMediaType,
        this.tempUsername,
        this.tempPassword
      );
    },
    tempUsername() {
      this.$emit(
        "social-media-update",
        this.socialMediaKey,
        this.tempSocialMediaType,
        this.tempUsername,
        this.tempPassword
      );
    },
    tempPassword() {
      this.$emit(
        "social-media-update",
        this.socialMediaKey,
        this.tempSocialMediaType,
        this.tempUsername,
        this.tempPassword
      );
    }
  },
  mounted() {
    this.tempSocialMediaType = this.socialMediaType;
    this.tempUsername = this.socialMediaUsername;
    this.tempPassword = this.socialMediaPassword;
  }
};

extend("max", max);
extend("required_if", required_if);
</script>

<style>
.nopadding {
  padding: 0 !important;
  margin: 0 !important;
}
</style>
