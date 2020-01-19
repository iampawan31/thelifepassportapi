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
                            @submit.prevent="handleSubmit()"
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
                                                    v-model="name"
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
                                <div class="row">
                                    <div class="col">
                                        <div class="field-group">
                                            <label for="home_address"
                                                >Address</label
                                            >
                                            <ValidationProvider
                                                name="Address"
                                                rules="address|max:200"
                                                v-slot="{ errors }"
                                            >
                                                <textarea
                                                    rows="2"
                                                    v-model="address"
                                                    name="home_address"
                                                    id="home_address"
                                                    class="field-input"
                                                    placeholder="Street Address, Town, City, State, Zipcode and country"
                                                ></textarea>
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

export default {
    components: {
        ValidationObserver,
        ValidationProvider
    },
    data() {
        return {
            name: "",
            relationship: "",
            company: "",
            address: "",
            emailAddress: "",
            phoneNumber: "",
            website: ""
        };
    },
    mounted() {},
    methods: {
        handleSubmit(e) {
            this.$router.push("/belong-question");
        }
    }
};
</script>
