<template>
    <div class="form-subgroup">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="field-group">
                    <label for="employer_name" class="input-label"
                        >Employer Name</label
                    >
                    <ValidationProvider
                        name="Legal Name"
                        vid="employer_name"
                        rules="alpha_spaces|max:50"
                        v-slot="{ errors }"
                    >
                        <input
                            type="text"
                            name="employer_name[]"
                            class="field-input"
                            placeholder="Employer Name"
                            v-model="employmentDetail.employer_name"
                            value=""
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
            <div class="col-md-6 col-sm-12">
                <div class="field-group">
                    <label for="employer_phone" class="input-label"
                        >Employer Phone</label
                    >
                    <ValidationProvider
                        name="Employer Phone Number"
                        rules="required_if:employer_name|is_phone"
                        v-slot="{ errors }"
                    >
                        <input
                            type="text"
                            name="employer_phone[]"
                            class="field-input"
                            placeholder="Phone number"
                            v-model="employmentDetail.employer_phone"
                            value=""
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

        <div class="field-group">
            <label for="employer_address">Employer Address</label>
            <ValidationProvider
                name="Employer Address"
                rules="max:1000"
                v-slot="{ errors }"
            >
                <textarea
                    rows="2"
                    name="employer_address[]"
                    class="field-input"
                    placeholder="Street Address, Town, City, State, Zipcode and country"
                    v-model="employmentDetail.employer_address"
                    value=""
                ></textarea>
                <span
                    v-if="errors != undefined && errors.length"
                    class="invalid-feedback d-block"
                >
                    {{ errors[0] }}
                </span>
            </ValidationProvider>
        </div>

        <div class="field-group">
            <label for="company_computer_username"
                >Company computer user name and password</label
            >
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <ValidationProvider
                        name="Username"
                        vid="username"
                        rules="alpha_num|max:30"
                        v-slot="{ errors }"
                    >
                        <input
                            type="text"
                            name="company_computer_username[]"
                            class="field-input"
                            placeholder="Username"
                            v-model="employmentDetail.computer_username"
                            value=""
                        />
                        <span
                            v-if="errors != undefined && errors.length"
                            class="invalid-feedback d-block"
                        >
                            {{ errors[0] }}
                        </span>
                    </ValidationProvider>
                </div>
                <div class="col-md-6 col-sm-12">
                    <ValidationProvider
                        name="Password"
                        rules="required_if:username|max:30"
                        v-slot="{ errors }"
                    >
                        <input
                            type="text"
                            name="company_computer_password[]"
                            class="field-input"
                            placeholder="Password"
                            v-model="employmentDetail.computer_password"
                            value=""
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

        <div class="field-group field-group__last">
            <label for="employee_benifits">Benefits used</label>
            <ValidationProvider
                name="Benefits used"
                rules="max:400"
                v-slot="{ errors }"
            >
                <textarea
                    rows="2"
                    name="employee_benifits[]"
                    class="field-input"
                    placeholder="Benefits used"
                    v-model="employmentDetail.employee_benefits"
                    value=""
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
</template>

<script>
import { ValidationProvider } from "vee-validate";

export default {
    components: {
        ValidationProvider
    },
    props: ["employer", "employmentDetailKey"],
    data() {
        return { employmentDetail: [] };
    },
    watch: {
        employmentDetail: {
            handler() {
                this.$emit(
                    "employment-detail-updated",
                    this.employmentDetailKey,
                    this.employmentDetail
                );
            },
            deep: true
        }
    },
    mounted() {
        this.employmentDetail = this.employer;
    }
};
</script>
