<template>
    <div class="c">
        <div class="question-item" data-nextpage="questions/close-friends.php">
            <h3 class="heading3">Close family members</h3>
            <div id="add-member" class="section-form">
                <!-- Add Family member section -->
                <div class="form-wrapper form-family-member">
                    <h3 class="heading4 uppercase">Add family member</h3>
                    <div class="error-message"></div>
                    <ValidationObserver ref="observer" v-slot="{ invalid }">
                        <form
                            id="frmFamilyMember"
                            name="frmFamilyMember"
                            method="post"
                            class="custom-form"
                            @submit.prevent="handleSubmit"
                        >
                            <!-- Name section -->
                            <div class="row">
                                <div class="col">
                                    <div class="field-group">
                                        <label
                                            for="legal_name"
                                            class="input-label"
                                            >Name</label
                                        >
                                        <ValidationProvider
                                            name="Name"
                                            rules="required|max:50"
                                            v-slot="{ errors }"
                                        >
                                            <input
                                                type="text"
                                                name="legal_name"
                                                id="legal_name"
                                                class="field-input required"
                                                placeholder="Name"
                                                v-model="memberDetails.legal_name"
                                            />
                                            <div
                                                class="invalid-feedback d-block"
                                                v-for="(error, index) in errors"
                                                v-bind:key="index"
                                            >
                                                {{ error }}
                                            </div>
                                        </ValidationProvider>
                                    </div>
                                </div>
                            </div>

                            <!-- Relationship section -->
                            <div class="row">
                                <div class="col">
                                    <div class="field-group">
                                        <label
                                            for="relationship"
                                            class="input-label"
                                            >Relationship</label
                                        >
                                        <validation-provider
                                            vid="relationship_selection"
                                            v-slot="{ errors }"
                                        >
                                            <Select2
                                                name="relationship"
                                                id="relationship"
                                                placeholder="Relationship"
                                                width="resolve"
                                                v-model="memberDetails.relationship_id"
                                                :options="relationshipOptions"
                                                @change="
                                                    relationshipChangeEvent(
                                                        $event
                                                    )
                                                "
                                                @select="
                                                    relationshipSelectEvent(
                                                        $event
                                                    )
                                                "
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
                                <div class="col" v-show="isOtherSelected">
                                    <div class="field-group">
                                        <label
                                            for="relationship"
                                            class="input-label"
                                            >Relationship</label
                                        >
                                        <validation-provider
                                            rules="required_if:relationship_selection,5"
                                            v-slot="{ errors }"
                                        >
                                            <input
                                                type="text"
                                                name="relatiionship_other"
                                                id="relatiionship_other"
                                                class="field-input"
                                                placeholder="Please specify relation"
                                                v-model="memberDetails.others"
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

                            <!-- Home addresss section -->
                            <div class="row">
                                <div class="col">
                                    <div class="field-group">
                                        <label for="address"
                                            >Home Address</label
                                        >
                                        <ValidationProvider
                                            name="Home Address"
                                            rules="max:1000"
                                            v-slot="{ errors }"
                                        >
                                            <textarea
                                                rows="2"
                                                name="address"
                                                id="address"
                                                v-model="memberDetails.address"
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

                            <!-- Phone number(s) section -->
                            <div class="row">
                                <div class="col">
                                    <phone-details
                                        v-on:phone-details-updates="updatePhoneNumbers"
                                        :user-phones="phoneNumbers"
                                    ></phone-details>
                                </div>
                            </div>

                            <!-- Former spouse's Email address section -->
                            <div class="row">
                                <div class="col">
                                    <div class="field-group">
                                        <label for="email" class="input-label"
                                            >Email</label
                                        >
                                        <ValidationProvider
                                            name="Email address"
                                            rules="email"
                                            v-slot="{ errors }"
                                        >
                                            <input
                                                type="text"
                                                name="email"
                                                id="email"
                                                class="field-input required email"
                                                placeholder="Email address"
                                                v-model="memberDetails.email"
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

                            <!-- Date of birth Section -->
                            <div class="row">
                                <div class="col">
                                    <div class="field-group">
                                        <label for="dob" class="input-label"
                                            >Date of Birth</label
                                        >
                                        <date-picker
                                            name="dob"
                                            :disabled-dates="disabledDates"
                                            placeholder="M/dd/YYYY"
                                            :format="'M/dd/yyyy'"
                                            v-model="memberDetails.dob"
                                            class="field-datepicker field-input"
                                        >
                                        </date-picker>
                                    </div>
                                </div>
                            </div>
                            <div class="field-group clearfix">
                                <input
                                    type="submit"
                                    class="field-submit btn-primary"
                                    value="Add Member"
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
import Select2 from "v-select2-component";
import DatePicker from "vuejs-datepicker";
import PhoneDetails from "./PhoneDetails.vue";
import Email from "./Email.vue";
import { ValidationObserver, ValidationProvider } from "vee-validate";

export default {
    components: {
        PhoneDetails,
        Email,
        DatePicker,
        Select2,
        ValidationObserver,
        ValidationProvider
    },
    computed: {
        isOtherSelected() {
            return this.relationship === "5" ? true : false;
        },
        disabledDates() {
            return { from: new Date() };
        }
    },
    data() {
        return {
            name: "",
            relationship: "",
            homeAddress: "",
            phoneNumbers: [],
            emailAddress: "",
            dateOfBirth: "",
            memberDetails: [],
            relationshipOptions: [],
            relationId: 0,
            submitted: false,
        };
    },
    mounted() {
        
    },
    created() {
        this.relationId = this.$route.params.id;
        this.getFamilyRelations();
        this.getFamilyMemberInfo();
    },
    methods: {
        async handleSubmit(e) {
            this.submitted = true;

            const isValid = await this.$refs.observer.validate();
            if (!isValid) {

            } else {
                const form = e.target;
                const formData = new FormData(form);

                if (this.relationId) {
                    axios.post("/familyinfo/" + this.relationId + "/updatedata", formData)
                        .then(response => {
                            this.$router.push("/family-members-question");
                        })
                        .catch(function() {});
                } else {
                    axios.post("/familyinfo/postdata", formData)
                        .then(response => {
                            this.$router.push("/family-members-question");
                        })
                        .catch(function() {});
                }
            }

            //this.$router.push("/close-friends-question");
        },
        relationshipChangeEvent(event) {
            console.log(event);
        },
        relationshipSelectEvent(event) {
            console.log(event);
        },
        updatePhoneNumbers(data) {
            this.phoneNumbers = data;
        },
        getFamilyRelations() {
            axios.get("/familyrelations").then(response => {
                if (response.status == 200) {
                    this.relationshipOptions = response.data.relation;
                }
            });
        },
        getFamilyMemberInfo() {
            if (this.relationId) {
                axios.get("/familyinfo/" + this.relationId + "/getfamilymemberinfo").then(response => {
                    if (response.status == 200) {
                        this.memberDetails = JSON.parse(JSON.stringify(response.data.data[0]));
                        if (this.memberDetails.family_phone.length > 0) {
                            this.phoneNumbers = this.memberDetails.family_phone;
                            console.log("phone number");
                            console.log(this.phoneNumbers);
                        }
                    }
                });
            }
        }
    }
};
</script>
