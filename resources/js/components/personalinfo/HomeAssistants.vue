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
                            @submit.prevent="handleSubmit()"
                        >
                            <!-- Person or asset cared for -->
                            <div class="row">
                                <div class="col">
                                    <div class="staff-members-fields">
                                        <div class="field-group">
                                            <label
                                                for="txt_name"
                                                class="input-label"
                                                >Person or asset cared
                                                for</label
                                            >
                                            <ValidationProvider
                                                name="Person or asset cared for"
                                                rules="required|alpha_spaces"
                                                v-slot="{ errors }"
                                            >
                                                <input
                                                    type="text"
                                                    name="txt_name"
                                                    id="txt_name"
                                                    v-model="personAssetCared"
                                                    data-id="txt_name"
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
                                <div class="col">
                                    <div class="field-group">
                                        <label
                                            for="txt_name"
                                            class="input-label"
                                            >Provider Name</label
                                        >
                                        <ValidationProvider
                                            name="Provider Name"
                                            rules="required|alpha_spaces"
                                            v-slot="{ errors }"
                                        >
                                            <input
                                                type="text"
                                                name="txt_name"
                                                v-model="providerName"
                                                id="txt_name"
                                                data-id="txt_name"
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
                            <div class="row">
                                <div class="col">
                                    <div class="field-group">
                                        <label for="home_address"
                                            >Home Address</label
                                        >
                                        <ValidationProvider
                                            name="Home Address"
                                            rules="max:200"
                                            v-slot="{ errors }"
                                        >
                                            <textarea
                                                rows="2"
                                                name="home_address"
                                                id="home_address"
                                                v-model="homeAddress"
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

                            <!-- Day and Time of care received section -->
                            <div class="row">
                                <div class="col">
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
                                                v-model="careDayTime"
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

                            <div class="row">
                                <div class="col">
                                    <div class="field-group">
                                        <label for="phone_number"
                                            >Day and Time of care
                                            received</label
                                        >
                                        <vue-datetime-picker
                                            class="vue-picker1"
                                            name="picker1"
                                        >
                                        </vue-datetime-picker>

                                        <!-- <input
                                            type="text"
                                            name="phone_number"
                                            id="phone_number"
                                            class="field-input required input-mobile"
                                            placeholder="Day and Time of care received"
                                        /> -->
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="field-group">
                                        <label for="phone_number"
                                            >Day and Time of care
                                            received</label
                                        >
                                        <vue-timepicker
                                            v-model="careTime"
                                            format="hh:mm A"
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
import VueDatetimePicker from "vue-datetime-picker";
import "vue2-timepicker/dist/VueTimepicker.css";
import Select2 from "v-select2-component";
import { ValidationObserver, ValidationProvider } from "vee-validate";

export default {
    components: {
        ValidationObserver,
        ValidationProvider,
        DatePicker,
        VueTimepicker,
        Select2,
        VueDatetimePicker
    },
    data() {
        return {
            personAssetCared: "",
            homeAddress: "",
            errors: [],
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
            ]
        };
    },
    computed: {
        isCareDayTimeSelected() {
            return this.careDayTimeFrequency === "" ? false : true;
        }
    },
    mounted() {},
    methods: {
        handleSubmit(e) {
            this.$router.push("/estate-representative-question");
        }
    }
};
</script>
