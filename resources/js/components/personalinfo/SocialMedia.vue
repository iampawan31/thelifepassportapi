<template>
    <div class="row">
        <div class="field-group nopadding col-md-6 col-sm-12">
            <validation-provider
                name="Social Media Type"
                vid="social_media_type"
                v-slot="{ errors }"
            >
                <div class="col-md-5">
                    <Select2
                        width="resolve"
                        name="social_media_type[]"
                        placeholder="Select an Options"
                        :options="socialOptions"
                        v-model="social.social"
                    />
                </div>
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
        <div class="col-md-7 col-sm-12">
            <div class="fields-group clearfix">
                <validation-provider
                    name="Password"
                    :rules="'required_if:email|max:30'"
                    v-slot="{ errors }"
                >
                    <input
                        type="text"
                        name="social_username[]"
                        class="field-input"
                        placeholder="Username"
                        v-model="social.username"
                        value=""
                    />
                    <span
                        v-if="errors != undefined && errors"
                        class="invalid-feedback d-block"
                        >{{ errors[0] }}</span
                    > </validation-provider
                ><validation-provider
                    name="Password"
                    :rules="'required_if:email|max:30'"
                    v-slot="{ errors }"
                >
                    <input
                        type="password"
                        name="social_password[]"
                        class="field-input field-input__last"
                        placeholder="Password"
                        v-model="social.password"
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
    props: [
        "key",
        "socialMediaType",
        "socialMediaEmail",
        "socialMediaPassword"
    ],
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
