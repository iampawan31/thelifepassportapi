<template>
    <div class="c">
        <div
            class="question-item"
            data-nextpage="questions/estate-representative.php"
        >
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
                            <!-- Person or asset cared for -->
                            <div class="row">
                                <div class="col nopadding">
                                    <div class="staff-members-fields">
                                        <div class="field-group">
                                            <label
                                                for="person_asset_cared"
                                                class="input-label"
                                                >Person or asset cared
                                                for</label
                                            >
                                            <ValidationProvider
                                                name="Person or asset cared for"
                                                rules="required|alpha_spaces|max:50"
                                                v-slot="{ errors }"
                                            >
                                                <input
                                                    type="text"
                                                    name="person_asset_cared"
                                                    id="person_asset_cared"
                                                    v-model="personAssetCared"
                                                    data-id="person_asset_cared"
                                                    class="field-input required"
                                                    placeholder="Person or asset cared for"
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

                            <!-- Provider name -->
                            <div class="row">
                                <div class="col nopadding">
                                    <div class="field-group">
                                        <label
                                            for="provider_name"
                                            class="input-label"
                                            >Provider Name</label
                                        >
                                        <ValidationProvider
                                            name="Provider Name"
                                            rules="required|alpha_spaces|max:50"
                                            v-slot="{ errors }"
                                        >
                                            <input
                                                type="text"
                                                name="provider_name"
                                                v-model="providerName"
                                                id="provider_name"
                                                data-id="provider_name"
                                                class="field-input required"
                                                placeholder="Provider Name"
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

                            <!-- Home addresss section -->
                            <!-- Home addresss section -->
                            <home-address
                                v-model="address"
                                @input="
                                    newAddress => {
                                        address = newAddress;
                                    }
                                "
                                address-type="homeassistant"
                                class="padding"
                            />

                            <!-- Day and Time of care received section -->
                            <div class="row">
                                <div class="col nopadding">
                                    <div class="field-group">
                                        <label
                                            for="relationship"
                                            class="input-label"
                                            >Home Assistant Care
                                            Frequency</label
                                        >
                                        <validation-provider
                                            vid="care_day_time"
                                            v-slot="{ errors }"
                                        >
                                            <Select2
                                                name="care_day_time"
                                                id="care_day_time"
                                                placeholder="Relationship"
                                                width="resolve"
                                                v-model="careDayTimeFrequency"
                                                :options="careDayTimeOptions"
                                                @change="
                                                    careDayTimeChangeEvent(
                                                        $event
                                                    )
                                                "
                                                @select="
                                                    careDayTimeSelectEvent(
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
                            </div>
                            <div class="row" v-if="dayCareFrequencySelected">
                                <div class="col nopadding">
                                    <div class="field-group">
                                        <label for="dob" class="input-label"
                                            >Care Day</label
                                        >
                                        <ValidationProvider
                                            v-slot="{ errors }"
                                            name="Care Day"
                                            rules="date|required_if:care_day_time"
                                        >
                                            <input
                                                v-model="careDay"
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
                                <div class="col nopadding">
                                    <div class="field-group">
                                        <label for="dob" class="input-label"
                                            >Care Time</label
                                        >
                                        <vue-timepicker
                                            v-model="careTime"
                                            input-width="100%"
                                            class="field-datepicker field-input"
                                        ></vue-timepicker>
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
import DatePicker from "vuejs-datepicker";
import VueTimepicker from "vue2-timepicker";
import HomeAddress from "./elements/Address";
import "vue2-timepicker/dist/VueTimepicker.css";
import Select2 from "v-select2-component";
import { ValidationObserver, ValidationProvider } from "vee-validate";

export default {
    components: {
        ValidationObserver,
        ValidationProvider,
        Select2,
        HomeAddress,
        DatePicker,
        VueTimepicker
    },
    data() {
        return {
            personAssetCared: "",
            homeAddress: "",
            errors: [],
            address: {},
            homeAssistantDetails : [],
            providerName: "",
            dayCareFrequencySelected: false,
            careDayTimeFrequency: "",
            careTime: "",
            careDay: "",
            careDayTimeOptions: [
                { id: 1, text: "One Time" },
                { id: 2, text: "Daily" },
                { id: 3, text: "Weekly" },
                { id: 4, text: "Monthly" },
                { id: 5, text: "Quaterly" },
                { id: 6, text: "Half Yearly" },
                { id: 7, text: "Yearly" }
            ],
            submitted: false,
            assistantId: 0
        };
    },
    mounted() {},
    created() {
        this.assistantId = this.$route.params.id;
        this.getHomeAssistantInfo();
    },
    methods: {
        async handleSubmit(e) {
            this.submitted = true;

            const isValid = await this.$refs.observer.validate();

            this.$router.push("/estate-representative-question");
            if (!isValid) {
                // Do Something
            } else {
                const form = e.target;
                const formData = new FormData(form);
                formData.append("homeassistant_address", JSON.stringify(this.address));

                if (this.assistantId) {
                    axios
                        .post(
                            "/homeassistants/" + this.friendId + "/updatedata",
                            formData
                        )
                        .then(response => {
                            console.log(response);
                            this.$router.push("/estate-representative-question");
                        })
                        .catch(function() {});
                } else {
                    axios
                        .post("/homeassistants/postdata", formData)
                        .then(response => {
                            this.$router.push("/estate-representative-question");
                        })
                        .catch(function() {});
                }
            }

            //this.$router.push("/close-friends-question");
        },
        careDayTimeChangeEvent($event) {
            console.log($event);
            this.dayCareFrequencySelected = true;
        },
        careDayTimeSelectEvent($event) {
            console.log($event);
            this.dayCareFrequencySelected = true;
        },
        updateHomeAddress(data) {
            this.address = data;
        },
        getHomeAssistantInfo() {
            if (this.assistantId) {
                axios
                    .get("/homeassistants/" + this.friendId + "/gethomeassistantinfo")
                    .then(response => {
                        if (response.status == 200) {
                            this.homeAssistantDetails = JSON.parse(
                                JSON.stringify(response.data.data[0])
                            );

                            if (this.homeAssistantDetails.address) {
                                this.address = this.homeAssistantDetails.address;
                            }
                        }
                    });
            }
        }
    }
};
</script>

<style>
.vue__time-picker input.display-time {
    padding: 0;
    line-height: 18px;
    height: 1em;
}
</style>
