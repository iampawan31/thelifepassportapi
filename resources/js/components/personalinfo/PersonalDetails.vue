<template>
    <div class="c">
        <div class="question-item">
            <h3 class="heading3">
                Enter your personal details:
            </h3>
            <div class="form-wrapper">
                <ValidationObserver ref="observer" v-slot="{ invalid }">
                    <form
                        id="formPersonalDetails"
                        name="frmPersonalDetails"
                        method="post"
                        class="custom-form"
                        @submit.prevent="handleSubmit"
                    >
                        <!-- Legal name and Nick name section -->
                        <div class="row">
                            <div class="col-md-6 col-sm-12 pr">
                                <div class="field-group">
                                    <label for="legal_name" class="input-label"
                                        >Legal Name</label
                                    >
                                    <ValidationProvider
                                        v-slot="{ errors }"
                                        name="Legal Name"
                                        rules="required|alpha_spaces|max:30"
                                    >
                                        <input
                                            id="legal_name"
                                            v-model.trim="legalName"
                                            type="text"
                                            name="legal_name"
                                            class="field-input required"
                                            placeholder="legal name"
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
                            <div class="col-md-6 col-sm-12 pl">
                                <div class="field-group">
                                    <label for="nickname" class="input-label"
                                        >Nickname or Prior Name</label
                                    >
                                    <ValidationProvider
                                        v-slot="{ errors }"
                                        name="Nick Name"
                                        rules="alpha_spaces|max:30"
                                    >
                                        <input
                                            id="nickname"
                                            v-model.trim="nickName"
                                            type="text"
                                            name="nickname"
                                            class="field-input"
                                            placeholder="nickname or prior name"
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

                        <!-- Home Address Section -->
                        <home-address
                            v-model="address"
                            @input="
                                newAddress => {
                                    address = newAddress;
                                }
                            "
                            address-type="personal"
                            class="padding"
                        />

                        <!-- Phone Number(s) section -->
                        <div class="row">
                            <div class="col nopadding">
                                <phone-details
                                    v-model="phoneNumbers"
                                    @input="
                                        newPhoneNumbers => {
                                            phoneNumbers = newPhoneNumbers;
                                        }
                                    "
                                />
                            </div>
                        </div>

                        <!-- Date of birth Section -->
                        <div class="row">
                            <div class="col nopadding">
                                <div class="field-group">
                                    <label for="dob" class="input-label"
                                        >Date of Birth</label
                                    >
                                    <ValidationProvider
                                        v-slot="{ errors }"
                                        name="Date of Birth"
                                        rules="date"
                                    >
                                        <input
                                            v-model.trim="dateOfBirth"
                                            v-mask="'##/##/####'"
                                            type="text"
                                            class="field-input"
                                            name="date"
                                            placeholder="mm/dd/yyyy"
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

                        <!-- Citizenship and Passport Number Section -->
                        <div class="row">
                            <div class="col-md-6 col-sm-12 nopadding">
                                <div class="field-group">
                                    <label for="citizenship" class="input-label"
                                        >Citizenship</label
                                    >
                                    <validation-provider
                                        v-slot="{ errors }"
                                        name="Citizenship"
                                        vid="citizenship"
                                    >
                                        <Select2
                                            id="country_id"
                                            :options="citizenshipOptions"
                                            v-model.trim="countryId"
                                            name="country_id"
                                            width="resolve"
                                            data-placeholder="Select an Options"
                                        >
                                            <option>
                                                value="0">Select Country</option
                                            >
                                        </Select2>
                                        <span
                                            v-if="
                                                errors != undefined &&
                                                    errors.length
                                            "
                                            class="invalid-feedback d-block"
                                        >
                                            {{ errors[0] }}
                                        </span>
                                    </validation-provider>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 nopadding">
                                <div class="field-group">
                                    <label
                                        for="passport_number"
                                        class="input-label"
                                        >Passport Number</label
                                    >
                                    <validation-provider
                                        v-slot="{ errors }"
                                        name="Passport Number"
                                        rules="required_if:country_id|max:20"
                                    >
                                        <input
                                            id="passport_number"
                                            v-model.trim="passportNumber"
                                            type="text"
                                            name="passport_number"
                                            class="field-input"
                                            placeholder="passport number"
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
                                    </validation-provider>
                                </div>
                            </div>
                        </div>

                        <!-- Father's name and birthplace section -->
                        <div class="row">
                            <div class="col-md-6 col-sm-12 clearfix nopadding">
                                <div class="field-group">
                                    <validation-provider
                                        v-slot="{ errors }"
                                        name="Father's Name"
                                        rules="alpha_spaces|max:50"
                                    >
                                        <label
                                            for="father_name"
                                            class="input-label"
                                            >Father's name</label
                                        >
                                        <input
                                            id="father_name"
                                            v-model.trim="fatherName"
                                            type="text"
                                            name="father_name"
                                            class="field-input"
                                            placeholder="father's Name"
                                        />
                                        <div
                                            v-if="
                                                errors != undefined &&
                                                    errors.length
                                            "
                                            class="invalid-feedback d-block"
                                        >
                                            {{ errors[0] }}
                                        </div>
                                    </validation-provider>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 nopadding">
                                <div class="field-group">
                                    <label
                                        for="father_birth_place"
                                        class="input-label"
                                        >Father's Birthplace</label
                                    >
                                    <validation-provider
                                        v-slot="{ errors }"
                                        name="Father's Birthplace"
                                        rules="address|max:200"
                                    >
                                        <input
                                            id="father_birth_place"
                                            v-model.trim="fatherBirthPlace"
                                            type="text"
                                            name="father_birth_place"
                                            class="field-input"
                                            placeholder="birth place"
                                        />
                                        <div
                                            v-if="
                                                errors != undefined &&
                                                    errors.length
                                            "
                                            class="invalid-feedback d-block"
                                        >
                                            {{ errors[0] }}
                                        </div>
                                    </validation-provider>
                                </div>
                            </div>
                        </div>

                        <!-- Mother's Name and birthplace section -->
                        <div class="row">
                            <div class="col-md-6 col-sm-12 nopadding">
                                <div class="field-group">
                                    <label for="mother_name" class="input-label"
                                        >Mother's Name</label
                                    >
                                    <validation-provider
                                        v-slot="{ errors }"
                                        name="Mother's Name"
                                        rules="alpha_spaces|max:200"
                                    >
                                        <input
                                            id="mother_name"
                                            v-model.trim="motherName"
                                            type="text"
                                            name="mother_name"
                                            class="field-input"
                                            placeholder="mother's Name"
                                        />
                                        <div
                                            v-if="
                                                errors != undefined &&
                                                    errors.length
                                            "
                                            class="invalid-feedback d-block"
                                        >
                                            {{ errors[0] }}
                                        </div>
                                    </validation-provider>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 nopadding">
                                <div class="field-group">
                                    <label
                                        for="mother_birth_place"
                                        class="input-label"
                                        >Mother's Birthplace</label
                                    >
                                    <validation-provider
                                        v-slot="{ errors }"
                                        name="Mother's Birthplace"
                                        rules="address|max:200"
                                    >
                                        <input
                                            id="mother_birth_place"
                                            v-model.trim="motherBirthPlace"
                                            type="text"
                                            name="mother_birth_place"
                                            class="field-input"
                                            placeholder="birth place"
                                        />
                                        <div
                                            v-if="
                                                errors != undefined &&
                                                    errors.length
                                            "
                                            class="invalid-feedback d-block"
                                        >
                                            {{ errors[0] }}
                                        </div>
                                    </validation-provider>
                                </div>
                            </div>
                        </div>

                        <!-- Email(s) credentials section -->
                        <div class="row">
                            <div class="col nopadding">
                                <email-details
                                    v-model="emails"
                                    @input="
                                        newEmails => {
                                            emails = newEmails;
                                        }
                                    "
                                />
                            </div>
                        </div>

                        <!-- Social media login credentials section -->
                        <div class="row">
                            <div class="col nopadding">
                                <social-media-details
                                    v-model="socialMediaDetails"
                                    @input="
                                        newSocials => {
                                            socialMediaDetails = newSocials;
                                        }
                                    "
                                />
                            </div>
                        </div>

                        <!-- Employment Details section -->
                        <div class="row">
                            <div class="col nopadding">
                                <employment-details
                                    v-model="employmentDetails"
                                    @input="
                                        newEmploymentDetails => {
                                            employmentDetails = newEmploymentDetails;
                                        }
                                    "
                                />
                            </div>
                        </div>

                        <!-- Mark as complete button section -->
                        <div class="field-group form-group-checkbox clearfix">
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

                        <!-- Save and Continue button section -->
                        <div class="field-group field-group__action clearfix">
                            <input
                                type="submit"
                                class="field-submit btn-primary"
                                :value="buttonText"
                            />
                        </div>
                    </form>
                </ValidationObserver>
                <div class="clearfix" />
            </div>
        </div>
    </div>
</template>
<script>
import Select2 from "v-select2-component";
import PhoneDetails from "./elements/PhoneDetails.vue";
import EmailDetails from "./elements/EmailDetails.vue";
import HomeAddress from "./elements/Address";
import SocialMediaDetails from "./elements/SocialMediaDetails.vue";
import EmploymentDetails from "./elements/EmploymentDetails.vue";
import { ValidationObserver, ValidationProvider } from "vee-validate";

export default {
    components: {
        EmailDetails,
        EmploymentDetails,
        HomeAddress,
        PhoneDetails,
        Select2,
        SocialMediaDetails,
        ValidationObserver,
        ValidationProvider
    },
    data() {
        return {
            address: {},
            citizenshipOptions: [],
            countryId: "",
            dateOfBirth: "",
            emails: [],
            employmentDetails: [],
            errors: [],
            fatherName: "",
            fatherBirthPlace: "",
            isCompleted: false,
            legalName: "",
            nickName: "",
            motherName: "",
            motherBirthPlace: "",
            passportNumber: "",
            phoneNumbers: [],
            socialMediaDetails: [],
            personalDetailId: "",
            result2: "",
            submitted: false,
            user: [],
            userId: ""
        };
    },
    computed: {
        buttonText() {
            return this.user.personal
                ? "Update and continue"
                : "Save and continue";
        }
    },
    created() {
        this.getPersonalInfo();
    },
    methods: {
        async handleSubmit(e) {
            this.submitted = true;
            const isValid = await this.$refs.observer.validate();

            if (!isValid) {
                // Do Something
            } else {
                const formData = this.getFormData(e);

                if (this.user.id && this.user.personal) {
                    formData.append("_method", "put");

                    axios
                        .post("/personal/" + this.user.personal.id, formData)
                        .then(response => {
                            if (response.status == 201) {
                                const Toast = this.$swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true
                                });

                                Toast.fire({
                                    icon: "success",
                                    title: "Information Saved"
                                });
                                this.$router.push("/spouse-question");
                            }
                        })
                        .catch(function() {});
                } else {
                    axios
                        .post("/personal", formData)
                        .then(response => {
                            if (response.status == 201) {
                                const Toast = this.$swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true
                                });

                                Toast.fire({
                                    icon: "success",
                                    title: "Information Updated"
                                });
                                this.$router.push("/spouse-question");
                            }
                        })
                        .catch(function() {});
                }
            }
        },
        async redirectToPage() {
            await axios.get("personal/marriage-status").then(response => {
                if (response.status == 200) {
                    if (response.data) {
                        // console.log(response.data);
                        if (
                            (response.data.data &&
                                response.data.data.is_married == "0") ||
                            (response.data.data &&
                                response.data.data.is_married == "2")
                        ) {
                            this.$router.push("/previous-spouse-question");
                        } else {
                            this.$router.push("/spouse");
                        }
                    }
                }
            });
        },
        getPersonalInfo() {
            axios.get("get-personal-info").then(response => {
                if (response.status == 200) {
                    if (response.data.data) {
                        this.isCompleted = response.data.is_completed;
                        this.populateData(response.data.data);
                    }
                    this.getCountyList();
                }
            });
        },
        getFormData(e) {
            const form = e.target;
            const formData = new FormData(form);

            formData.append("legal_name", this.legalName);
            formData.append("nickname", this.nickName);
            formData.append("personal_address", JSON.stringify(this.address));
            formData.append("phones", JSON.stringify(this.phoneNumbers));
            formData.append("dob", this.dateOfBirth);
            formData.append("country_id", this.countryId);
            formData.append("passport_number", this.passportNumber);
            formData.append("father_name", this.fatherName);
            formData.append("father_birth_place", this.fatherBirthPlace);
            formData.append("mother_name", this.motherName);
            formData.append("mother_birth_place", this.motherBirthPlace);
            formData.append("emails", JSON.stringify(this.emails));
            formData.append(
                "user_social_media",
                JSON.stringify(this.socialMediaDetails)
            );
            formData.append(
                "user_employer",
                JSON.stringify(this.employmentDetails)
            );
            formData.append("is_completed", this.isCompleted);

            return formData;
        },
        populateNewForm() {
            this.legalName = "";
            this.nickName = "";
            this.address = {
                street_address1: null,
                street_address2: null,
                city: null,
                state: null,
                zipcode: null
            };
            this.phoneNumbers = [{ phone: null }];
            this.dateOfBirth = "";
            this.countryId = "";
            this.passportNumber = "";
            this.fatherName = "";
            this.fatherBirthPlace = "";
            this.motherName = "";
            this.motherBirthPlace = "";
            this.emails = [{ email: null, password: null }];
            this.socialMediaDetails = [
                { social_id: null, username: null, password: null }
            ];
            this.employmentDetails = [
                {
                    employer_name: null,
                    employer_phone: null,
                    computer_username: null,
                    computer_password: null,
                    address: {
                        street_address1: null,
                        street_address2: null,
                        city: null,
                        state: null,
                        zipcode: null
                    },
                    benefits: []
                }
            ];
            this.isCompleted = false;
        },
        populateData(userData) {
            this.userId = userData.id;
            this.user = userData;

            const personalDetail = userData.personal;
            if (personalDetail) {
                this.legalName = personalDetail.legal_name;
                this.nickName = personalDetail.nickname;
                this.dateOfBirth = personalDetail.dob;
                this.fatherName = personalDetail.father_name;
                this.fatherBirthPlace = personalDetail.father_birth_place;
                this.motherName = personalDetail.mother_name;
                this.motherBirthPlace = personalDetail.mother_birth_place;
                this.countryId = personalDetail.country_id;
                this.passportNumber = personalDetail.passport_number;
            }

            if (userData.address) {
                this.address = userData.address;
            } else {
                this.address = {
                    street_address1: null,
                    street_address2: null,
                    city: null,
                    state: null,
                    zipcode: null
                };
            }

            if (userData.phones.length > 0) {
                this.phoneNumbers = userData.phones;
            } else {
                this.phoneNumbers = [{ phone: null }];
            }

            if (userData.emails.length > 0) {
                this.emails = userData.emails;
            } else {
                this.emails = [{ email: null, password: null }];
            }

            if (userData.socials.length > 0) {
                this.socialMediaDetails = userData.socials;
            } else {
                this.socialMediaDetails = [
                    { social_id: null, username: null, password: null }
                ];
            }

            if (userData.employers.length > 0) {
                this.employmentDetails = userData.employers;
            } else {
                this.employmentDetails = [
                    {
                        employer_name: null,
                        employer_phone: null,
                        computer_username: null,
                        computer_password: null,
                        address: {
                            street_address1: null,
                            street_address2: null,
                            city: null,
                            state: null,
                            zipcode: null
                        },
                        benefits: []
                    }
                ];
            }

            if (userData.steps) {
                if (userData.steps.is_completed) {
                    this.isCompleted = true;
                }
            } else {
                //this.completionStatus = { step_id: null, is_visited: null, is_filled: null, is_completed: null };
                this.isCompleted = false;
            }
        },
        getCountyList() {
            axios.get("/countries").then(response => {
                if (response.status == 200) {
                    this.citizenshipOptions = response.data.countries;
                }
            });
        },
        citizenshipChangeEvent(val) {
            console.log(val);
        },
        citizenshipSelectEvent({ id, text }) {
            console.log({
                id,
                text
            });
        }
    }
};
</script>
