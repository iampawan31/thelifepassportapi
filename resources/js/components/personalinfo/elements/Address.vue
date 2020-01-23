<template>
    <div>
        <div class="row">
            <div class="col">
                <div class="field-group">
                    <label for="street_address_1">Street Address 1</label>
                    <ValidationProvider
                        name="Street Address 1"
                        rules="address|max:80"
                        v-slot="{ errors }"
                    >
                        <input
                            type="text"
                            name="street_address_2"
                            placeholder="Street Address 1"
                            v-model="address.streetAddress1"
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
                    <label for="street_address_2">Street Address 2</label>
                    <ValidationProvider
                        name="Street Address 2"
                        rules="address|max:80"
                        v-slot="{ errors }"
                    >
                        <input
                            type="text"
                            name="street_address_2"
                            placeholder="Street Address 2"
                            v-model="address.streetAddress2"
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
                    <label for="city">City</label>
                    <ValidationProvider
                        name="City"
                        rules="alpha_spaces|max:50"
                        v-slot="{ errors }"
                    >
                        <input
                            type="text"
                            name="city"
                            placeholder="City"
                            v-model="address.city"
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
                    <label for="state">State</label>
                    <ValidationProvider
                        name="State"
                        rules="alpha_spaces|max:50"
                        v-slot="{ errors }"
                    >
                        <input
                            type="text"
                            name="state"
                            placeholder="State"
                            v-model="address.state"
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
                    <label for="zipcode">Zipcode</label>
                    <ValidationProvider
                        name="Zipcode"
                        rules="alpha_spaces|max:50"
                        v-slot="{ errors }"
                    >
                        <input
                            type="text"
                            name="zipcode"
                            placeholder="Zipcode"
                            v-model="address.zipcode"
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
    props: ["homeAddress"],
    components: {
        ValidationProvider
    },
    data() {
        return {
            errors: [],
            paddingLeft: "",
            paddingRight: "",
            address: {
                streetAddress1: "",
                streetAddress2: "",
                city: "",
                state: "",
                zipcode: "",
                submitted: false
            }
        };
    },
    watch: {
        address: {
            handler() {
                this.$emit("home-address-update", this.address);
            },
            deep: true
        }
    },
    mounted() {
        this.address = this.homeAddress;

        if (this.padding !== undefined) {
            this.paddingLeft = "pl";
            this.paddingRight = "pr";
        }
    }
};
</script>
