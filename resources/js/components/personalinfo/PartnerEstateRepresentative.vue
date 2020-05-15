<template>
    <div class="c">
        <div class="question-item" data-nextpage="questions/belong.php">
            <div class="section-form">
                <div class="form-wrapper form-family-member">
                    <ValidationObserver ref="observer" v-slot="{ invalid }">
                        <form
                            name="frmFamilyMember"
                            action="#"
                            method="post"
                            class="custom-form"
                            @submit.prevent="handleSubmit"
                        >
                            <div class="staff-members-fields">
                                <!-- Name Field -->
                                <div class="row">
                                    <div class="col">
                                        <div class="field-group">
                                            <label
                                                for="name"
                                                class="input-label"
                                                >Name</label
                                            >
                                            <ValidationProvider
                                                name="Name"
                                                rules="required|alpha_spaces|max:50"
                                                v-slot="{ errors }"
                                            >
                                                <input
                                                    type="text"
                                                    name="name"
                                                    id="name"
                                                    v-model="legalName"
                                                    data-id="name"
                                                    class="field-input required"
                                                    placeholder="Name"
                                                />
                                                <span
                                                    v-if="
                                                        errors != undefined &&
                                                            errors.length
                                                    "
                                                    class="invalid-feedback d-block"
                                                >
                                                    {{ errors[0] }}
                                                </span>
                                            </ValidationProvider>
                                        </div>
                                    </div>
                                </div>
                                <!-- Relationship Field -->
                                <div class="row">
                                    <div class="col">
                                        <div class="field-group">
                                            <label
                                                for="relationship"
                                                class="input-label"
                                                >Relationship</label
                                            >
                                            <ValidationProvider
                                                name="Relationship"
                                                rules="alpha_spaces|max:50"
                                                v-slot="{ errors }"
                                            >
                                                <input
                                                    type="text"
                                                    v-model="relationship"
                                                    name="relationship"
                                                    id="relationship"
                                                    data-id="relationship"
                                                    class="field-input required"
                                                    placeholder="Relationship"
                                                />
                                                <span
                                                    v-if="
                                                        errors != undefined &&
                                                            errors.length
                                                    "
                                                    class="invalid-feedback d-block"
                                                >
                                                    {{ errors[0] }}
                                                </span>
                                            </ValidationProvider>
                                        </div>
                                    </div>
                                </div>

                                <!-- Company Fields -->
                                <div class="row">
                                    <div class="col">
                                        <div class="field-group">
                                            <label
                                                for="txt_name"
                                                class="input-label"
                                                >Company</label
                                            >
                                            <ValidationProvider
                                                name="Company"
                                                rules="alpha_spaces|max:50"
                                                v-slot="{ errors }"
                                            >
                                                <input
                                                    type="text"
                                                    v-model="company"
                                                    name="company"
                                                    id="company"
                                                    data-id="company"
                                                    class="field-input required"
                                                    placeholder="Company"
                                                />
                                                <span
                                                    v-if="
                                                        errors != undefined &&
                                                            errors.length
                                                    "
                                                    class="invalid-feedback d-block"
                                                >
                                                    {{ errors[0] }}
                                                </span>
                                            </ValidationProvider>
                                        </div>
                                    </div>
                                </div>

                                <!-- Address Field -->
                                <home-address
                                    v-model="address"
                                    @input="
                                        newAddress => {
                                            address = newAddress;
                                        }
                                    "
                                    address-type="personal"
                                />

                                <!-- Phone Number Field -->
                                <div class="row">
                                    <div class="col">
                                        <div class="field-group">
                                            <label
                                                for="phone_number"
                                                class="input-label"
                                                >Phone Number</label
                                            >
                                            <ValidationProvider
                                                name="Phone Number"
                                                rules="is_phone"
                                                v-slot="{ errors }"
                                            >
                                                <input
                                                    type="text"
                                                    name="phone_number"
                                                    id="phone_number"
                                                    v-model="phoneNumber"
                                                    data-id="phone_number"
                                                    class="field-input required"
                                                    placeholder="Phone Number"
                                                />
                                                <span
                                                    v-if="
                                                        errors != undefined &&
                                                            errors.length
                                                    "
                                                    class="invalid-feedback d-block"
                                                >
                                                    {{ errors[0] }}
                                                </span>
                                            </ValidationProvider>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email address field -->
                                <div class="row">
                                    <div class="col">
                                        <div class="field-group">
                                            <label
                                                for="email_address"
                                                class="input-label"
                                                >Email</label
                                            >
                                            <ValidationProvider
                                                name="Email Address"
                                                rules="email"
                                                v-slot="{ errors }"
                                            >
                                                <input
                                                    type="text"
                                                    name="email_address"
                                                    id="email_address"
                                                    v-model="emailAddress"
                                                    data-id="email_address"
                                                    class="field-input required"
                                                    placeholder="Email"
                                                />
                                                <span
                                                    v-if="
                                                        errors != undefined &&
                                                            errors.length
                                                    "
                                                    class="invalid-feedback d-block"
                                                >
                                                    {{ errors[0] }}
                                                </span>
                                            </ValidationProvider>
                                        </div>
                                    </div>
                                </div>

                                <!-- Website field -->
                                <div class="row">
                                    <div class="col">
                                        <div class="field-group">
                                            <label
                                                for="website"
                                                class="input-label"
                                                >Website</label
                                            >
                                            <ValidationProvider
                                                name="Email Address"
                                                rules="website"
                                                v-slot="{ errors }"
                                            >
                                                <input
                                                    type="text"
                                                    name="website"
                                                    id="website"
                                                    v-model="website"
                                                    data-id="website"
                                                    class="field-input required"
                                                    placeholder="Website"
                                                />
                                                <span
                                                    v-if="
                                                        errors != undefined &&
                                                            errors.length
                                                    "
                                                    class="invalid-feedback d-block"
                                                >
                                                    {{ errors[0] }}
                                                </span>
                                            </ValidationProvider>
                                        </div>
                                    </div>
                                </div>
                                <!-- Mark as complete button section -->
                                <div
                                    class="field-group form-group-checkbox clearfix"
                                >
                                    <label for="chk_complete">
                                        <input
                                            id="chk_complete"
                                            v-model="isCompleted"
                                            type="checkbox"
                                            :checked="isCompleted"
                                            name="chk_complete"
                                            :value="isCompleted"
                                        /><i /> <span>Mark as complete</span>
                                    </label>
                                </div>
                            </div>

                            <div class="field-group clearfix">
                                <input
                                    type="submit"
                                    class="field-submit btn-primary"
                                    value="Save and continue"
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
import { ValidationObserver, ValidationProvider } from "vee-validate";
import HomeAddress from "./elements/Address";

export default {
    components: {
        ValidationObserver,
        ValidationProvider,
        HomeAddress
    },
    data() {
        return {
            legalName: "",
            relationship: "",
            company: "",
            address: {
                street_address1: "",
                street_address2: "",
                city: "",
                state: "",
                zip: ""
            },
            emailAddress: "",
            phoneNumber: "",
            website: "",
            isCompleted: false,
            estateRepId: ""
        };
    },
    created() {
        this.getEstateRepresentativeInformation();
    },
    methods: {
        async handleSubmit(e) {
            this.submitted = true;

            const isValid = await this.$refs.observer.validate();
            if (!isValid) {
                // Do Something
            } else {
                const formData = this.getFormData(e);

                if (this.estateRepId) {
                    formData.append("_method", "put");
                    axios
                        .post(
                            "/personal/spouse/estate/" + this.estateRepId,
                            formData
                        )
                        .then(response => {
                            console.log(response);
                            // this.$router.push(
                            //     "/spouse-estate-representative-question"
                            // );
                        })
                        .catch(function() {});
                } else {
                    axios
                        .post("/personal/spouse/estate", formData)
                        .then(response => {
                            console.log(response);
                            // this.$router.push(
                            //     "/spouse-estate-representative-question"
                            // );
                        })
                        .catch(function() {});
                }
            }
        },
        getEstateRepresentativeInformation() {
            axios.get("/personal/spouse/estate/").then(response => {
                if (response.status == 200) {
                    // console.log(response.data.data);
                    this.populateData(response.data.data);
                }
            });
        },
        populateData(data) {
            if (data !== null) {
                this.legalName = data.legal_name;
                this.relationship = data.relationship;
                this.company = data.company;
                this.emailAddress = data.email;
                this.phoneNumber = data.phone;
                this.website = data.website;
                this.isCompleted = data.is_completed;

                if (this.address) {
                    this.address = data.address;
                }
            }
        },
        getFormData(e) {
            const form = e.target;
            const formData = new FormData(form);

            formData.append("legal_name", this.legalName);
            formData.append("relationship", this.relationship);
            formData.append("company", this.company);
            formData.append("email", this.emailAddress);
            formData.append("phone", this.phoneNumber);
            formData.append("website", this.website);
            formData.append("address", JSON.stringify(this.address));
            formData.append("is_completed", this.isCompleted);

            return formData;
        }
    }
};
</script>
