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

        <home-address
            :home-address="employmentDetail.address"
            @home-address-update="updateHomeAddress"
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

        <div class="field-group">
            <label for="benefits_used">Benefits used</label>
        </div>
        <div class="row">
            <div class="col">
                <input type="checkbox" name="vehicle" value="Bike" />
                Health Insurance <br />
                <input type="checkbox" name="vehicle" value="Bike" /> Dental
                Insurance <br />
                <input type="checkbox" name="vehicle" value="Bike" /> Dependent
                Care Spending Account <br />
                <input type="checkbox" name="vehicle" value="Bike" /> Healthcare
                Flexible Spending Account <br />
                <input type="checkbox" name="vehicle" value="Bike" /> Life
                Insurance - Basic <br />
                <input type="checkbox" name="vehicle" value="Bike" /> Life
                Insurance - Optional <br />
                <input type="checkbox" name="vehicle" value="Bike" /> AD&D
                Insurance <br />
                <input type="checkbox" name="vehicle" value="Bike" /> Depending
                Life Spouse Insurance <br />
                <input type="checkbox" name="vehicle" value="Bike" /> Dependent
                Life Child Insurance <br />
                <input type="checkbox" name="vehicle" value="Bike" /> Short-Term
                Disability Insurance <br />
                <input type="checkbox" name="vehicle" value="Bike" /> Long-Term
                Disability Insurance <br />
                <input type="checkbox" name="vehicle" value="Bike" /> Group
                Legal Benefit <br />
                <input type="checkbox" name="vehicle" value="Bike" /> Group
                Auto/Home Insurance <br />
                <input type="checkbox" name="vehicle" value="Bike" /> Pet
                Insurance <br />
                <input type="checkbox" name="vehicle" value="Bike" /> 401K or
                Other Retirement Savings plan via employer <br />
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
    created () {
        this.getemployeraddress();
    },
    props: ["employer", "employmentDetailKey"],
    data() {
        return { employmentDetail: [], address: [] };
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
    methods: {
        updateHomeAddress(data) {
            this.address = data;
        },
        getemployeraddress() {
            axios.get('/getemployeraddress').then(response => {
                if (response.status == 200) {
                    if (response.data) {
                        console.log(response.data);
                    }
                }
            });
        }
    },
    mounted() {
        this.employmentDetail = this.employer;
    }
};
</script>