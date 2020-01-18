<template>
    <ValidationProvider
        name="Phone Number"
        rules="is_phone"
        v-slot="{ errors }"
    >
        <div class="field-group">
            <div class="add-anohter-field">
                <div class="field-wrapper">
                    <input
                        type="text"
                        v-model="number"
                        numeric-keyboard-toggle
                        class="field-input input-mobile"
                        placeholder="Phone number"
                        value=""
                        name="phone[]"
                    />
                </div>
            </div>
            <span class="invalid-feedback d-block">{{ errors[0] }}</span>
        </div>
    </ValidationProvider>
</template>

<script>
import { ValidationProvider } from "vee-validate";

export default {
    components: {
        ValidationProvider
    },
    props: ["phoneNumber", "phoneKey"],
    data() {
        return {
            number: "",
            key: ""
        };
    },
    watch: {
        number() {
            this.$emit("phone-number-update", this.key, this.number);
        }
    },
    mounted() {
        this.number = this.phoneNumber;
        this.key = this.phoneKey;
    }
};
</script>
