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
                                            v-model="legalName"
                                            type="text"
                                            name="legal_name"
                                            class="field-input required"
                                            placeholder="Legal Name"
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
                                            v-model="nickName"
                                            type="text"
                                            name="nickname"
                                            class="field-input"
                                            placeholder="Nickname or prior name"
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
                                            v-model="dateOfBirth"
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
                                            id="citizenship"
                                            :options="citizenshipOptions"
                                            v-model="countryId"
                                            name="citizenship"
                                            width="resolve"
                                            data-placeholder="Select an Options"
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
                                        rules="required_if:citizenship|max:20"
                                    >
                                        <input
                                            id="passport_number"
                                            v-model="passportNumber"
                                            type="text"
                                            name="passport_number"
                                            class="field-input"
                                            placeholder="Passport Number"
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
                                            v-model="fatherName"
                                            type="text"
                                            name="father_name"
                                            class="field-input"
                                            placeholder="Father's Name"
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
                                            v-model="fatherBirthPlace"
                                            type="text"
                                            name="father_birth_place"
                                            class="field-input"
                                            placeholder="Birth place"
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
                                            v-model="motherName"
                                            type="text"
                                            name="mother_name"
                                            class="field-input"
                                            placeholder="Mother's Name"
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
                                            v-model="motherBirthPlace"
                                            type="text"
                                            name="mother_birth_place"
                                            class="field-input"
                                            placeholder="Birth place"
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
        this.getCountyList();
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
                        .post(
                            "api/personal-info/" +
                                this.user.personal.id +
                                "?api_token=" +
                                this.user.api_token,
                            formData
                        )
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
                        .post(
                            "/api/personal-info" +
                                "?api_token=" +
                                this.user.api_token,
                            formData
                        )
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
            await axios.get("spouse/getmarriagestatus").then(response => {
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
            axios.get("/get-personal-info").then(response => {
                if (response.status == 200) {
                    if (response.data.data) {
                        console.log(response.data.data);
                        this.$store.dispatch(
                            "populateData",
                            response.data.data
                        );
                        this.populateData(response.data.data);
                    }
                }
            });
        },
        getFormData(e) {
            const form = e.target;
            const formData = new FormData(form);

            formData.append("legal_name", this.legalName);
            formData.append("nickname", this.nickName);
            formData.append("personal_address", JSON.stringify(this.address));
            formData.append("user_phones", JSON.stringify(this.phoneNumbers));
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
            this.address = {};
            this.phoneNumbers = [];
            this.dateOfBirth = "";
            this.countryId = "";
            this.passportNumber = "";
            this.fatherName = "";
            this.fatherBirthPlace = "";
            this.motherName = "";
            this.motherBirthPlace = "";
            this.emails = [];
            this.socialMediaDetails = [];
            this.employmentDetails = [];
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
            }

            if (userData.phones.length > 0) {
                this.phoneNumbers = userData.phones;
            } else {
                this.phoneNumbers = [{ number: null }];
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
                    { social: null, username: null, password: null }
                ];
            }

            if (userData.employers.length > 0) {
                this.employmentDetails = userData.employers;
            } else {
                this.employmentDetails = [
                    {
                        employer_name: null,
                        employer_phone: null,
                        employer_username: null,
                        employer_password: null,
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

            if (userData.step > 0) {
                if (userData.step.is_completed == 1) {
                    this.isCompleted = true;
                }
            } else {
                //this.completionStatus = { step_id: null, is_visited: null, is_filled: null, is_completed: null };
                this.isCompleted = false;
            }
        },
        getCountyList() {
            axios.get("/countrylist").then(response => {
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
