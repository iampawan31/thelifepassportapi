<template>
    <ValidationProvider rules="is_phone" v-slot="{ errors }">
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
import { extend } from "vee-validate";
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

extend("is_phone", value => {
    var phoneRegex = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
    if (value.match(phoneRegex)) {
        // return value >= 0;
    }
    return "Phone Number should be valid and should contain 10 digits";
});
</script>
