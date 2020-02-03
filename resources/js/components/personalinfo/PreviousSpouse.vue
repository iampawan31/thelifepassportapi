<template>
    <div class="c">
        <div class="question-item" data-nextpage="questions/family-members.php">
            <h3 class="heading3">Former spouse details</h3>

            <div class="section-form">
                <div class="form-wrapper form-family-member">
                    <div class="error-message"></div>
                    <ValidationObserver ref="observer" v-slot="{ invalid }">
                        <form
                            id="frmFormarSpouse"
                            name="frmFormarSpouse"
                            method="post"
                            class="custom-form"
                            enctype="multipart/form-data"
                            @submit.prevent="handleSubmit"
                        >
                            <!-- Former spouse's name section -->
                            <div class="padding">
                                <div class="row">
                                    <div class="col">
                                        <div class="field-group">
                                            <label
                                                for="former_spouse_name"
                                                class="input-label"
                                                >Former Spouse Name</label
                                            >
                                            <ValidationProvider
                                                name="Legal Name"
                                                rules="required|alpha_spaces|max:50"
                                                v-slot="{ errors }"
                                            >
                                                <input
                                                    type="text"
                                                    name="legal_name"
                                                    id="legal_name"
                                                    class="field-input required"
                                                    placeholder="Former Spouse Name"
                                                    v-model="
                                                        spouseDetails.legal_name
                                                    "
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
                            </div>

                            <!-- Marriage date and location Section -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12 pr">
                                    <div class="field-group">
                                        <label
                                            for="marriage_date"
                                            class="input-label"
                                            >Marriage Date</label
                                        >
                                        <ValidationProvider
                                            v-slot="{ errors }"
                                            name="Marriage Date"
                                            rules="date"
                                        >
                                            <input
                                                v-model="
                                                    spouseDetails.marriage_date
                                                "
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
                                <div class="col-md-6 col-sm-12 pl">
                                    <div class="field-group">
                                        <label
                                            for="marriage_location"
                                            class="input-label"
                                            >Marriage Location</label
                                        >
                                        <validation-provider
                                            name="Marriage Location"
                                            rules="required|address|max:200"
                                            v-slot="{ errors }"
                                        >
                                            <input
                                                type="text"
                                                name="marriage_location"
                                                id="marriage_location"
                                                class="field-input required"
                                                placeholder="Marriage Location"
                                                v-model="
                                                    spouseDetails.marriage_location
                                                "
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

                            <!-- Divorce Date and location section -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12 pr">
                                    <div class="field-group">
                                        <label
                                            for="divorce_date"
                                            class="input-label"
                                            >Divorce Date</label
                                        >
                                        <validation-provider
                                            name="Divorce Date"
                                            rules="required"
                                            v-slot="{ errors }"
                                        >
                                            <datepicker
                                                name="divorce_date"
                                                placeholder="M/dd/YYYY"
                                                :format="'M/dd/yyyy'"
                                                :disabled-dates="disabledDates"
                                                v-model="
                                                    spouseDetails.divorce_date
                                                "
                                                class="field-datepicker field-input"
                                            >
                                            </datepicker>
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
                                <div class="col-md-6 col-sm-12 pl">
                                    <div class="field-group">
                                        <label
                                            for="divorce_location"
                                            class="input-label"
                                            >Divorce Location</label
                                        >
                                        <validation-provider
                                            name="Divorce Location"
                                            rules="required|address|max:200"
                                            v-slot="{ errors }"
                                        >
                                            <input
                                                type="text"
                                                name="divorce_location"
                                                id="divorce_location"
                                                class="field-input required"
                                                placeholder="Divorce Location"
                                                v-model="
                                                    spouseDetails.divorce_location
                                                "
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
                            <!-- Former spouse's current address -->
                            <home-address
                                v-model="address"
                                @input="
                                    newAddress => {
                                        address = newAddress;
                                    }
                                "
                                address-type="previousspouse"
                                class="padding"
                            />

                            <!-- Former spouse's Phone number(s) section -->
                            <div class="row">
                                <div class="col nopadding">
                                    <phone-details
                                        v-model="phones"
                                        @input="
                                            newPhoneNumbers => {
                                                phoneNumbers = newPhoneNumbers;
                                            }
                                        "
                                    />
                                </div>
                            </div>

                            <!-- Former spouse's Email address section -->
                            <div class="padding">
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
                                                    v-model="spouseDetails.email"
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

                            <!-- Alimony section -->
                            <div class="switch-wrapper clearfix">
                                <div
                                    class="field-group can-toggle can-toggle--size-small"
                                >
                                    <input
                                        id="owe_alimony"
                                        name="owe_alimony"
                                        type="checkbox"
                                        class="toggle-fields"
                                        :value="isAlimonyPaid"
                                        data-toggle-fields="alimony_details"
                                        v-model="isAlimonyPaid"
                                    />
                                    <label for="owe_alimony">
                                        <div class="can-toggle__label-text">
                                            Do you owe alimony to this previous
                                            spouse?
                                        </div>
                                        <div
                                            class="can-toggle__switch"
                                            data-checked="Yes"
                                            data-unchecked="No"
                                        ></div>
                                    </label>
                                </div>

                                <div id="alimony_details" v-if="isAlimonyPaid">
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <div class="field-group">
                                                <label
                                                    for="alimony_agreement"
                                                    class="input-label"
                                                    >Agreement</label
                                                >
                                                <div
                                                    class="input-file-wrapper clearfix"
                                                >
                                                    <div
                                                        class="input-browse"
                                                        v-if="
                                                            !isDivorceDocumentUploaded
                                                        "
                                                    >
                                                        <span class="btn-link"
                                                            >Add file</span
                                                        >
                                                        <ValidationProvider
                                                            name="Divorce Document"
                                                            rules="ext:pdf,docx,doc,txt,jpeg,png|size:5000"
                                                            v-slot="{
                                                                errors,
                                                                validate
                                                            }"
                                                        >
                                                            <input
                                                                type="file"
                                                                id="alimony_agreement"
                                                                name="alimony_agreement"
                                                                @change="
                                                                    handleFileUpload
                                                                "
                                                            />
                                                            <span
                                                                v-if="
                                                                    errors !=
                                                                        undefined &&
                                                                        errors.length
                                                                "
                                                                class="invalid-feedback d-block"
                                                            >
                                                                {{ errors[0] }}
                                                            </span>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div v-else>
                                                        <div class="btn-group">
                                                            <a
                                                                :href="
                                                                    divorceDoc.url
                                                                "
                                                                target="_blank"
                                                                class="btn btn-success btn"
                                                                >View</a
                                                            >
                                                            <a
                                                                href="javascript:void(0);"
                                                                @click="
                                                                    removeDivorceFile()
                                                                "
                                                                class="btn btn-danger btn"
                                                                >Remove</a
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="field-group">
                                                <label
                                                    for="alimony_amount"
                                                    class="input-label"
                                                    >Amount</label
                                                >
                                                <ValidationProvider
                                                    name="Alimony amount"
                                                    :rules="{
                                                        regex: /^[0-9]*(\.[0-9]{0,2})?$/
                                                    }"
                                                    v-slot="{ errors }"
                                                >
                                                    <input
                                                        type="text"
                                                        name="alimony_amount"
                                                        id="alimony_amount"
                                                        class="field-input required"
                                                        placeholder="Amount"
                                                        v-model="
                                                            spouseDetails.alimony_amount
                                                        "
                                                    />
                                                    <span
                                                        v-if="
                                                            errors !=
                                                                undefined &&
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

                                <!-- Child Suppport section -->
                                <div class="switch-wrapper clearfix">
                                    <div
                                        class="field-group can-toggle can-toggle--size-small"
                                    >
                                        <input
                                            id="owe_child_support"
                                            name="owe_child_support"
                                            type="checkbox"
                                            class="toggle-fields"
                                            :value="isChildSupportPaid"
                                            data-toggle-fields="alimony_details"
                                            v-model="isChildSupportPaid"
                                        />
                                        <label for="owe_child_support">
                                            <div class="can-toggle__label-text">
                                                Do you owe child support to this
                                                previous spouse?
                                            </div>
                                            <div
                                                class="can-toggle__switch"
                                                data-checked="Yes"
                                                data-unchecked="No"
                                            ></div>
                                        </label>
                                    </div>
                                </div>

                                <div
                                    id="child_support_details"
                                    v-if="isChildSupportPaid"
                                >
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <div class="field-group">
                                                <label
                                                    for="child_support_agreement"
                                                    class="input-label"
                                                    >Agreement</label
                                                >
                                                <div
                                                    class="input-file-wrapper clearfix"
                                                >
                                                    <div
                                                        class="input-browse"
                                                        v-if="!isChildSupportDocumentUploaded"
                                                    >
                                                        <span class="btn-link"
                                                            >Add file</span
                                                        >
                                                        <ValidationProvider
                                                            name="Child Support Document"
                                                            rules="ext:pdf,docx,doc,txt,jpeg,png|size:5000"
                                                            v-slot="{
                                                                errors,
                                                                validate
                                                            }"
                                                        >
                                                            <input
                                                                type="file"
                                                                id="child_support_agreement"
                                                                name="child_support_agreement"
                                                                @change="
                                                                    handleFileUpload
                                                                "
                                                            />
                                                            <span
                                                                v-if="
                                                                    errors !=
                                                                        undefined &&
                                                                        errors.length
                                                                "
                                                                class="invalid-feedback d-block"
                                                            >
                                                                {{ errors[0] }}
                                                            </span>
                                                        </ValidationProvider>
                                                    </div>
                                                    <div v-else>
                                                        <div class="btn-group">
                                                            <a
                                                                :href="
                                                                    childSupportDoc.url
                                                                "
                                                                target="_blank"
                                                                class="btn btn-success btn"
                                                                >View</a
                                                            >
                                                            <a
                                                                href="javascript:void(0);"
                                                                @click="
                                                                    removeChildSupportFile()
                                                                "
                                                                class="btn btn-danger btn"
                                                                >Remove</a
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="field-group">
                                                <label
                                                    for="child_support_amount"
                                                    class="input-label"
                                                    >Amount</label
                                                >
                                                <ValidationProvider
                                                    name="Child support amount"
                                                    :rules="{
                                                        regex: /^[0-9]*(\.[0-9]{0,2})?$/
                                                    }"
                                                    v-slot="{ errors }"
                                                >
                                                    <input
                                                        type="text"
                                                        name="child_support_amount"
                                                        id="child_support_amount"
                                                        class="field-input required"
                                                        placeholder="Amount"
                                                        v-model="
                                                            spouseDetails.child_support_amount
                                                        "
                                                    />
                                                    <span
                                                        v-if="
                                                            errors !=
                                                                undefined &&
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

                                <!-- Mark as complete button section -->
                                <div
                                    class="field-group form-group-checkbox clearfix"
                                >
                                    <label for="chk_complete">
                                        <input
                                            type="checkbox"
                                            name="chk_complete"
                                            id="chk_complete"
                                            v-model="is_completed"
                                            :value="is_completed"
                                        /><i></i> <span>Mark as complete</span>
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
import Select2 from "v-select2-component";
import Datepicker from "vuejs-datepicker";
import PhoneDetails from "./elements/PhoneDetails.vue";
import HomeAddress from "./elements/Address";
import Email from "./elements/Email.vue";
import SocialMediaDetails from "./elements/SocialMediaDetails.vue";
import EmploymentDetails from "./elements/EmploymentDetails.vue";
import { ValidationObserver, ValidationProvider } from "vee-validate";

export default {
    components: {
        PhoneDetails,
        Email,
        Datepicker,
        HomeAddress,
        SocialMediaDetails,
        EmploymentDetails,
        Select2,
        ValidationObserver,
        ValidationProvider
    },
    data() {
        return {
            spouseDetails: [],
            phones: [],
            address: {},
            userId: 0,
            submitted: false,
            citizenshipOptions: [],
            file: "",
            isAlimonyPaid: false,
            isChildSupportPaid: false,
            childSupportDoc: [],
            divorceDoc: [],
            is_completed: false
        };
    },
    computed: {
        disabledDates() {
            return { from: new Date() };
        },
        isDivorceDocumentUploaded() {
            return (
                this.divorceDoc !== undefined &&
                this.divorceDoc.title !== undefined
            );
        },
        isChildSupportDocumentUploaded() {
            return (
                this.childSupportDoc !== undefined &&
                this.childSupportDoc.title !== undefined
            );
        }
    },
    created() {
        axios.get("/getprevspouseinfo").then(response => {
            if (response.status == 200) {
                console.log(response.data);
                if (response.data.data[0]) {
                    this.spouseDetails = JSON.parse(
                        JSON.stringify(response.data.data[0])
                    );
                    this.userId = this.spouseDetails.user_id;

                    if (this.spouseDetails.is_alimony_paid == "1") {
                        this.isAlimonyPaid = true;
                    }

                    if (this.spouseDetails.is_child_support == "1") {
                        this.isChildSupportPaid = true;
                    }

                    if (this.spouseDetails.address) {
                        this.address = this.spouseDetails.address;
                    }

                    if (this.spouseDetails.phones.length > 0) {
                        this.phones = this.spouseDetails.phones;
                    } else {
                        this.phones = [{ phone: null }];
                    }
                    
                    if (this.spouseDetails.documents) {
                        this.divorceDoc = this.spouseDetails.documents;
                    }

                    if (this.spouseDetails.childsupportdoc) {
                        this.childSupportDoc = this.spouseDetails.childsupportdoc;
                    }

                    if (
                        this.spouseDetails.users_personal_details_completion
                            .length > 0
                    ) {
                        if (
                            this.spouseDetails
                                .users_personal_details_completion[0]
                                .is_completed == 1
                        ) {
                            this.is_completed = true;
                        }
                    } else {
                        //this.completionStatus = { step_id: null, is_visited: null, is_filled: null, is_completed: null };
                        this.is_completed = false;
                    }
                } else {
                    this.phones = [{ phone: null }];
                    this.is_completed = false;
                }
            }
        });
    },
    mounted() {},
    methods: {
        handleFileUpload(e) {
            this.file = e.target.files;
        },
        async handleSubmit(e) {
            //this.$router.push("/family-members-question");
            this.submitted = true;
            const isValid = await this.$refs.observer.validate(e);
            if (!isValid) {
                // Do Something
            } else {
                let form = e.target;
                let formData = new FormData(form);
                formData.append("previousspouse_address", JSON.stringify(this.address));
                formData.append("previousspouse_phones", JSON.stringify(this.phones));
                formData.append("file", this.file);

                if (this.userId) {
                    axios
                        .post(
                            "/previousspouse/" + this.userId + "/updatedata",
                            formData,
                            {
                                headers: {
                                    "Content-Type": "multipart/form-data"
                                }
                            }
                        )
                        .then(response => {
                            this.$router.push("/family-members-question");
                        })
                        .catch(function() {});
                } else {
                    axios
                        .post("/previousspouse/postdata", formData)
                        .then(response => {
                            if (response.status == 200) {
                                this.$router.push("/family-members-question");
                            }
                        })
                        .catch(function() {});
                }
            }
        },
        removeDivorceFile() {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "Remove Agreement Document?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                })
                .then(result => {
                    if (result.value) {
                        axios
                            .post("/removedivorcefile")
                            .then(response => {
                                if (response.status == 200) {
                                    this.divorceDoc = [];
                                    this.$swal.fire(
                                        "Deleted!",
                                        "Document is removed",
                                        "success"
                                    );
                                }
                            })
                            .catch(function() {});
                    }
                });
        },
        removeChildSupportFile() {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "Remove Child Support Agreement Document?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                })
                .then(result => {
                    if (result.value) {
                        axios
                            .post("/removechildsupportfile")
                            .then(response => {
                                if (response.status == 200) {
                                    this.childSupportDoc = [];
                                    this.$swal.fire(
                                        "Deleted!",
                                        "Document is removed",
                                        "success"
                                    );
                                }
                            })
                            .catch(function() {});
                    }
                });
        },
        updateHomeAddress(data) {
            this.address = data;
        }
    }
};
</script>
