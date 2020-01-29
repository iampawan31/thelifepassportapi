<template>
    <div class="field-group">
        <div class="add-anohter-field">
            <h4 class="form-subhead">
                Email Addresses
            </h4>
            <div
                class="field-wrapper"
                v-for="(email, index) in localEmails"
                v-bind:key="index"
            >
                <email
                    :value="email"
                    @remove-email="removeEmail"
                    :email-key="index"
                ></email>
            </div>
            <div class="btn-add" v-show="singleEmailIsAdded">
                <a href="javascript:void(0);" @click="addEmail"
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
                        class="feather feather-plus"
                    >
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Add another</a
                >
            </div>
        </div>
    </div>
</template>
<script>
import Email from "./Email";

export default {
    components: {
        Email
    },
    props: {
        value: {
            type: Array,
            required: true
        }
    },
    computed: {
        localEmails: {
            get() {
                return this.value;
            },
            set(localEmails) {
                this.$emit("input", localEmails);
            }
        },
        singleEmailIsAdded() {
            return (
                this.localEmails !== undefined && this.localEmails.length > 0
            );
        }
    },
    methods: {
        addEmail() {
            this.localEmails.push({ email: null, password: null });
        },
        removeEmail(lineId) {
            this.localEmails.splice(lineId, 1);
        }
    }
};
</script>
