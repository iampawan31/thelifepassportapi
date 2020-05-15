<template>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <validation-provider
                name="Social Media Type"
                vid="social_media_type"
                v-slot="{ errors }"
            >
                <Select2
                    width="resolve"
                    name="social_media_type[]"
                    placeholder="Select an Options"
                    :options="socialMediaOptions"
                    v-model.trim="localSocial.social_id"
                />
                <span
                    v-if="errors != undefined && errors"
                    class="invalid-feedback d-block"
                    >{{ errors[0] }}</span
                >
            </validation-provider>
        </div>
        <div class="col-md-4 col-sm-12 nopadding">
            <validation-provider
                name="Username"
                vid="social_media_username"
                :rules="'required_if:social_media_type|max:30'"
                v-slot="{ errors }"
            >
                <input
                    type="text"
                    name="social_username[]"
                    class="field-input"
                    placeholder="Username"
                    v-model.trim="localSocial.username"
                    value=""
                />
                <span
                    v-if="errors != undefined && errors"
                    class="invalid-feedback d-block"
                    >{{ errors[0] }}</span
                >
            </validation-provider>
        </div>
        <div class="col-md-4 col-sm-12 nopadding">
            <validation-provider
                name="Password"
                :rules="'required_if:social_media_username|max:30'"
                v-slot="{ errors }"
            >
                <input
                    type="password"
                    name="social_password[]"
                    class="field-input field-input__last"
                    placeholder="Password"
                    v-model.trim="localSocial.password"
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
            v-if="socialMediaKey != 0"
            @click="removeSocialMedia"
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
                <circle cx="12" cy="12" r="10" />
                <line x1="8" y1="12" x2="16" y2="12" />
            </svg>
        </a>
    </div>
</template>

<script>
import Select2 from "v-select2-component";
import { ValidationProvider } from "vee-validate";

export default {
    components: {
        ValidationProvider,
        Select2
    },
    props: {
        value: {
            type: Object,
            required: false
        },
        socialMediaOptions: {
            type: Array,
            required: true
        },
        socialMediaKey: {
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
        localSocial: {
            get() {
                return this.value;
            },
            set(localSocial) {
                this.$emit("input", localSocial);
            }
        },
        socialMediaRemoveText() {
            const text = this.localSocial.social_id
                ? this.socialMediaOptions[this.localSocial.social_id - 1].text
                : "this field";

            return (
                "You want to remove " +
                "<strong>" +
                text +
                "</strong>" +
                " credentials?"
            );
        }
    },
    methods: {
        removeSocialMedia() {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    html: this.socialMediaRemoveText,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                })
                .then(result => {
                    if (result.value) {
                        this.$emit("social-media-removal", this.socialMediaKey);
                        this.$swal.fire(
                            "Deleted!",
                            "Selected Social Media Credentials Removed!",
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
