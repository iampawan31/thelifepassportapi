<template>
    <div class="row clearfix">
        <div class="field-group nopadding col-md-6 col-sm-12">
            <validation-provider
                name="Email Address"
                rules="email"
                vid="email"
                v-slot="{ errors }"
            >
                <input
                    type="text"
                    name="email[]"
                    class="field-input field-input__first email"
                    placeholder="email address"
                    v-model.trim="localEmail.email"
                    value=""
                />
                <span
                    v-if="errors != undefined && errors"
                    class="invalid-feedback d-block"
                    >{{ errors[0] }}</span
                >
            </validation-provider>
        </div>
        <div class="field-group nopadding col-md-6 col-sm-12">
            <validation-provider
                name="Password"
                :rules="'required_if:email|max:50'"
                v-slot="{ errors }"
            >
                <input
                    type="password"
                    name="email_password[]"
                    class="field-input field-input__last"
                    placeholder="password(optional)"
                    v-model.trim="localEmail.password"
                    value=""
                />
                <span
                    v-if="errors != undefined && errors"
                    class="invalid-feedback d-block"
                    >{{ errors[0] }}</span
                >
            </validation-provider>
        </div>
        <a
            href="javascript:void(0);"
            class="btn-remove"
            v-if="emailKey != 0"
            @click="removeEmail"
            ><svg
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
                <line x1="8" y1="12" x2="16" y2="12"></line></svg
        ></a>
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
            required: false
        },
        emailKey: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            errors: []
        };
    },
    computed: {
        localEmail: {
            get() {
                return this.value;
            },
            set(localEmail) {
                this.$emit("input", localEmail);
            }
        },
        emailRemoveText() {
            const text = this.email ? this.email : "this field";
            return "You want to remove " + "<strong>" + text + "</strong>?";
        }
    },
    methods: {
        removeEmail() {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    html: this.emailRemoveText,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                })
                .then(result => {
                    if (result.value) {
                        this.$emit("remove-email", this.key);
                        $swal.fire(
                            "Deleted!",
                            "Your email is removed",
                            "success"
                        );
                    }
                });
        }
    }
};
</script>

<style>
.nopadding {
    padding: 0 !important;
    margin: 0 !important;
}
</style>
