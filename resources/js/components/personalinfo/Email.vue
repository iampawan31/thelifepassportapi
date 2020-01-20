<template>
    <div class="row clearfix">
        <div class="field-group nopadding col-md-6 col-sm-12">
            <validation-provider
                name="Email Address"
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
                :rules="'required_if:email|max:50'"
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
        <a
            href="javascript:void(0);"
            class="btn-remove"
            v-if="key != 0"
            @click="removeEmail"
            ><svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="feather feather-minus-circle"
            >
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="8" y1="12" x2="16" y2="12"></line></svg
        ></a>
    </div>
</template>

<script>
import { ValidationProvider } from "vee-validate";
import { extend } from "vee-validate";

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
    methods: {
        removeEmail() {
            this.$emit("remove-email", this.key);
        }
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
</script>

<style>
.nopadding {
    padding: 0 !important;
    margin: 0 !important;
}
</style>
