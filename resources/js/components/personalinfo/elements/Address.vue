<template>
    <div>
        <div class="row">
            <div class="col">
                <div class="field-group">
                    <label v-bind:for="addressType + '_street_address_1'"
                        >Street Address 1</label
                    >
                    <ValidationProvider
                        name="Street Address 1"
                        rules="address|max:80"
                        v-slot="{ errors }"
                    >
                        <input
                            type="text"
                            v-bind:name="addressType + '_street_address_1'"
                            placeholder="Street Address 1"
                            v-model="streetAddress1"
                            class="field-input"
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
        <div class="row">
            <div class="col">
                <div class="field-group">
                    <label v-bind:for="addressType + '_street_address_2'"
                        >Street Address 2</label
                    >
                    <ValidationProvider
                        name="Street Address 2"
                        rules="address|max:80"
                        v-slot="{ errors }"
                    >
                        <input
                            type="text"
                            v-bind:name="addressType + '_street_address_2'"
                            placeholder="Street Address 2"
                            v-model="streetAddress2"
                            class="field-input"
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
        <div class="row">
            <div class="col">
                <div class="field-group">
                    <label v-bind:for="addressType + '_city'">City</label>
                    <ValidationProvider
                        name="City"
                        rules="alpha_spaces|max:50"
                        v-slot="{ errors }"
                    >
                        <input
                            type="text"
                            v-bind:name="addressType + '_city'"
                            placeholder="City"
                            v-model="city"
                            class="field-input"
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
        <div class="row">
            <div class="col">
                <div class="field-group">
                    <label v-bind:for="addressType + '_state'">State</label>
                    <ValidationProvider
                        name="State"
                        rules="alpha_spaces|max:50"
                        v-slot="{ errors }"
                    >
                        <input
                            type="text"
                            v-bind:name="addressType + '_state'"
                            placeholder="State"
                            v-model="state"
                            class="field-input"
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
        <div class="row">
            <div class="col">
                <div class="field-group">
                    <label v-bind:for="addressType + '_zipcode'">Zipcode</label>
                    <ValidationProvider
                        name="Zipcode"
                        rules="max:6"
                        v-slot="{ errors }"
                    >
                        <input
                            type="text"
                            v-bind:name="addressType + '_zipcode'"
                            placeholder="Zipcode"
                            v-model="zipcode"
                            class="field-input"
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
    </div>
</template>

<script>
import { ValidationProvider } from "vee-validate";
export default {
    props: ["homeAddress", "addressType"],
    components: {
        ValidationProvider
    },
    data() {
        return {
            errors: [],
            paddingLeft: "",
            paddingRight: "",
            streetAddress1: "",
            streetAddress2: "",
            city: "",
            state: "",
            zipcode: "",
            submitted: false
        };
    },
    computed: {
        address() {
            return {
                street_address1: this.streetAddress1,
                street_address2: this.streetAddress2,
                city: this.city,
                state: this.state,
                zipcode: this.zipcode
            };
        }
    },
    watch: {
        streetAddress1() {
            this.updateData();
        },
        streetAddress2() {
            this.updateData();
        },
        city() {
            this.updateData();
        },
        state() {
            this.updateData();
        },
        zipcode() {
            this.updateData();
        }
    },
    methods: {
        updateData() {
            this.$emit("home-address-update", this.address);
        }
    },
    mounted() {
        if (typeof this.homeAddress == "undefined") {
            console.log(this.homeAddress);
        } else {
            this.streetAddress1 = this.homeAddress.streetAddress1;
            this.streetAddress2 = this.homeAddress.streetAddress2;
            this.city = this.homeAddress.city;
            this.state = this.homeAddress.state;
            this.zipcode = this.homeAddress.zipcode;
        }

        if (this.padding !== undefined) {
            this.paddingLeft = "pl";
            this.paddingRight = "pr";
        }
    }
};
</script>
