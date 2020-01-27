<template>
    <div class="field-group">
        <div class="add-anohter-field">
            <h4 class="form-subhead">
                Email Addresses
            </h4>
            <div
                class="field-wrapper"
                v-for="(email, index) in userEmails"
                v-bind:key="index"
            >
                <email
                    @email-update="updateEmails"
                    @remove-email="removeEmail"
                    :email-key="index"
                    :email="email.email"
                    :password="email.password"
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
    props: ["userEmails"],
    computed: {
        singleEmailIsAdded() {
            return this.userEmails !== undefined && this.userEmails.length > 0;
        }
    },
    watch: {
        emails() {
            this.blockRemoval = this.emails.length <= 1;
        }
    },
    methods: {
        addEmail() {
            this.userEmails.push({ email: null, password: null });
        },
        populateEmail() {
            if (this.userEmails.length > 0) {
                this.userEmails.forEach(data => {
                    this.emails.push({
                        email: data.email,
                        password: data.password
                    });
                });
            } else {
                this.userEmails.push({ email: null, password: null });
            }
        },
        removeEmail(lineId) {
            this.userEmails.splice(lineId, 1);
        },
        updateEmails(index, email, password) {
            this.userEmails[index].email = email;
            this.userEmails[index].password = password;
            this.$emit("email-details-updates", this.userEmails);
        }
    },
    mounted() {
        this.$nextTick(() => {
            this.populateEmail();
        });
    }
};
</script>
