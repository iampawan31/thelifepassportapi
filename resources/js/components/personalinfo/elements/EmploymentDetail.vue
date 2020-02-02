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
                            v-model="localEmploymentDetail.employer_name"
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
                            v-model="localEmploymentDetail.employer_phone"
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
            v-model="localEmploymentDetail.address"
            @input="
                newAddress => {
                    address = newAddress;
                }
            "
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
                            v-model="localEmploymentDetail.computer_username"
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
                            v-model="localEmploymentDetail.computer_password"
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
        <employee-benefits
            v-model="localEmploymentDetail.benefits"
            :benefit-options="employeeBenefitsOptions"
        ></employee-benefits>
    </div>
</template>

<script>
import { ValidationProvider } from "vee-validate";
import HomeAddress from "./Address";
import EmployeeBenefits from "./Benefits";

export default {
    components: {
        ValidationProvider,
        HomeAddress,
        EmployeeBenefits
    },
    props: {
        value: {
            type: Object,
            required: false
        },
        employmentDetailKey: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            employeeBenefitsOptions: []
        };
    },
    computed: {
        localEmploymentDetail: {
            get() {
                return this.value;
            },
            set(localEmploymentDetail) {
                this.$emit("input", localEmploymentDetail);
            }
        }
    },
    methods: {
        getemployeraddress() {
            axios.get("/benefits").then(response => {
                if (response.status == 200) {
                    if (response.data) {
                        this.employeeBenefitsOptions = response.data.data;
                    }
                }
            });
        }
    },
    created() {
        if (this.localEmploymentDetail.address === null) {
            this.localEmploymentDetail.address = {
                street_address1: null,
                street_address2: null,
                city: null,
                state: null,
                zipcode: null
            };
        }
        this.getemployeraddress();
    }
};
</script>
