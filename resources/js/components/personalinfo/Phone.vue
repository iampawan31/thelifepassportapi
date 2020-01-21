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
        <a
            href="javascript:void(0);"
            v-if="key != 0"
            class="btn-remove"
            @click="removePhone"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="feather feather-minus-circle"
            >
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="8" y1="12" x2="16" y2="12"></line>
            </svg>
        </a>
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
    computed: {
        phoneRemoveText() {
            return (
                "You want to remove " + "<strong>" + this.number + "</strong>?"
            );
        }
    },
    methods: {
        removePhone() {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    html: this.phoneRemoveText,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                })
                .then(result => {
                    if (result.value) {
                        this.$emit("remove-phone-number", this.key);
                        $swal.fire(
                            "Deleted!",
                            "Your phone number is deleted",
                            "success"
                        );
                    }
                });
        }
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
