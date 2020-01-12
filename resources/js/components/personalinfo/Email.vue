<template>
    <div class="row clearfix">
        <div class="field-group nopadding col-md-6 col-sm-12">
            <validation-provider
                name="Email"
                rules="email"
                vid="email"
                v-slot="{ errors }"
            >
                <input
                    type="text"
                    name="email[]"
                    class="field-input field-input__first email"
                    placeholder="Email address"
                    v-model="tempEmail"
                    value=""
                />
                <span
                    v-if="errors != undefined && errors"
                    class="invalid-feedback d-block"
                    >{{ errors[0] }}</span
                >
            </validation-provider>
        </div>
        <div class="field-group nopadding col-md-6 col-sm-12">
            <validation-provider
                name="Password"
                :rules="'required_if:email|max:30'"
                v-slot="{ errors }"
            >
                <input
                    type="password"
                    name="email_password[]"
                    class="field-input field-input__last"
                    placeholder="password"
                    v-model="tempPassword"
                    value=""
                />
                <span
                    v-if="errors != undefined && errors"
                    class="invalid-feedback d-block"
                    >{{ errors[0] }}</span
                >
            </validation-provider>
        </div>
    </div>
</template>

<script>
import { ValidationProvider } from "vee-validate";
import { extend } from "vee-validate";
import { email, required_if, alpha_num, max } from "vee-validate/dist/rules";
export default {
    components: {
        ValidationProvider
    },
    props: ["email", "password", "emailKey"],
    data() {
        return {
            errors: [],
            tempEmail: "",
            tempPassword: "",
            key: ""
        };
    },
    watch: {
        email() {
            this.$emit(
                "email-update",
                this.key,
                this.tempEmail,
                this.tempPassword
            );
        }
    },
    mounted() {
        this.tempEmail = this.email;
        this.tempPassword = this.password;
        this.key = this.emailKey;
    }
};

extend("email", email);
extend("max", max);
extend("required_if", required_if);
</script>

<style>
.nopadding {
    padding: 0 !important;
    margin: 0 !important;
}
</style>
