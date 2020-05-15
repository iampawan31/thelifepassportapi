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
                            placeholder="street address 1"
                            v-model.trim="localAddress.street_address1"
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
                            placeholder="street address 2"
                            v-model.trim="localAddress.street_address2"
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
                            placeholder="city"
                            v-model.trim="localAddress.city"
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
                            placeholder="state"
                            v-model.trim="localAddress.state"
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
                            placeholder="zipcode"
                            v-model.trim="localAddress.zipcode"
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
    props: {
        value: {
            type: Object,
            required: true
        },
        addressType: {
            type: String,
            required: true
        }
    },
    computed: {
        localAddress: {
            get() {
                return this.value;
            },
            set(localAddress) {
                this.$emit("input", localAddress);
            }
        }
    },
    data() {
        return {
            errors: [],
            paddingLeft: "",
            paddingRight: "",
            submitted: false
        };
    }
};
</script>
