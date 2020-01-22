<template>
    <div>
        <div class="row">
            <div class="col nopadding">
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
            <div class="col nopadding">
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
            <div class="col nopadding">
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
            <div class="col nopadding">
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
            <div class="col nopadding">
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
    components: {
        ValidationProvider
    },
    data() {
        return {
            errors: [],
            streetAddress1: "",
            streetAddress2: "",
            city: "",
            state: "",
            zipcode: "",
            submitted: false
        };
    }
};
</script>
