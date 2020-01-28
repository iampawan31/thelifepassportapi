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
                        vid="employer_name_validation"
                        rules="alpha_spaces|max:50"
                        v-slot="{ errors }"
                    >
                        <input
                            type="text"
                            name="employer_name"
                            class="field-input"
                            placeholder="Employer Name"
                            v-model="employer.employer_name"
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
                        rules="required_if:employer_name_validation|is_phone"
                        v-slot="{ errors }"
                    >
                        <input
                            type="text"
                            name="employer_phone"
                            class="field-input"
                            placeholder="Phone number"
                            v-model="employer.employer_phone"
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

        <home-address
            v-bind:home-address="employer.address"
            address-type="employer"
        />

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
                            name="company_computer_username"
                            class="field-input"
                            placeholder="Username"
                            v-model="employer.computer_username"
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
                            name="company_computer_password"
                            class="field-input"
                            placeholder="Password"
                            v-model="employer.computer_password"
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
            <label for="benefits_used">Benefits used</label>
        </div>
        <div class="row">
            <div class="col">
                <div
                    v-for="benefit in employeeBenefitsOptions"
                    v-bind:key="benefit.id"
                >
                    <input
                        type="checkbox"
                        v-model="benefitSelected[benefit.id]"
                        :value="benefit.id"
                        name="benefit"
                    />
                    {{ benefit.title }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ValidationProvider } from "vee-validate";
import HomeAddress from "./Address";

export default {
    components: {
        ValidationProvider,
        HomeAddress
    },
    created() {
        this.getemployeraddress();
    },
    props: ["employer", "employmentDetailKey"],
    data() {
        return {
            employeeBenefitsOptions: []
        };
    },
    computed: {
        benefitSelected() {
            let benefits = this.employer.benefits;
            let employeeBenefitsOptions = this.employeeBenefitsOptions;
            let ret = {};
            for (let i = 0; i < benefits.length; i++) {
                for (let j = 0; j < employeeBenefitsOptions.length; j++) {
                    if (
                        employeeBenefitsOptions[j].id == benefits[i].benefit_id
                    ) {
                        ret[employeeBenefitsOptions[j].id] = true;
                    }
                }
            }
            return ret;
        }
    },
    watch: {
        benefits: {
            handler() {
                this.updateEmploymentDetails();
            },
            deep: true
        },
        computer_username() {
            this.updateEmploymentDetails();
        },
        computer_password() {
            this.updateEmploymentDetails();
        },
        employer_name() {
            this.updateEmploymentDetails();
        },
        employer_phone() {
            this.updateEmploymentDetails();
        }
    },
    methods: {
        updateEmploymentDetails() {
            this.$emit("employment-detail-updated", this.employmentDetailKey, {
                employer_name: this.employer_name,
                employer_phone: this.employer_phone,
                employer_address: this.employer_address,
                benefits: this.benefits,
                computer_username: this.computer_username,
                computer_password: this.computer_password
            });
        },
        updateHomeAddress(data) {
            this.employer_address = data;
            this.updateEmploymentDetails();
        },
        getemployeraddress() {
            axios.get("/getemployerbenefitslist").then(response => {
                if (response.status == 200) {
                    if (response.data) {
                        this.employeeBenefitsOptions = response.data.data;
                    }
                }
            });
        }
    }
};
</script>
