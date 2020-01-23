<template>
    <div class="c">
        <div
            class="question-item"
            data-nextpage="questions/home-assistants.php"
        >
            <!-- Add Close friends section -->
            <div class="form-wrapper form-friends">
                <h3 class="heading4 uppercase">Add friend details</h3>
                <div class="error-message"></div>
                <ValidationObserver ref="observer" v-slot="{ invalid }">
                    <form
                        id="frmFriends"
                        name="frmFriends"
                        method="post"
                        class="custom-form"
                        @submit.prevent="handleSubmit"
                    >
                        <!-- Name section -->
                        <div class="row">
                            <div class="col">
                                <div class="field-group">
                                    <label for="legal_name" class="input-label"
                                        >Name</label
                                    >
                                    <ValidationProvider
                                        name="Friend Name"
                                        rules="required|max:50"
                                        v-slot="{ errors }"
                                    >
                                        <input
                                            type="text"
                                            name="legal_name"
                                            id="legal_name"
                                            class="field-input required"
                                            placeholder="Name"
                                            v-model="friendsDetails.legal_name"
                                        />
                                        <div
                                            class="invalid-feedback d-block"
                                            v-for="(error, index) in errors"
                                            v-bind:key="index"
                                        >
                                            {{ error }}
                                        </div>
                                    </ValidationProvider>
                                </div>
                            </div>
                        </div>

                        <!-- Home addresss section -->
                        <!-- Home Address Section -->
                        <home-address
                            :home-address="address"
                            @home-address-update="updateHomeAddress"
                        />

                        <!-- Phone number(s) section -->
                        <div class="row">
                            <div class="col">
                                <phone-details
                                    v-on:phone-details-updates="
                                        updatePhoneNumbers
                                    "
                                    :user-phones="phoneNumbers"
                                    v-if="phoneNumbers.length > 0"
                                ></phone-details>
                            </div>
                        </div>

                        <!-- Former spouse's Email address section -->
                        <div class="row">
                            <div class="col">
                                <div class="field-group">
                                    <label for="email" class="input-label"
                                        >Email</label
                                    >
                                    <ValidationProvider
                                        name="Email address"
                                        rules="email"
                                        v-slot="{ errors }"
                                    >
                                        <input
                                            type="text"
                                            name="email"
                                            id="email"
                                            class="field-input required email"
                                            placeholder="Email address"
                                            v-model="friendsDetails.email"
                                        />
                                        <span
                                            v-if="
                                                errors != undefined &&
                                                    errors.length
                                            "
                                            class="invalid-feedback d-block"
                                        >
                                            {{ errors[0] }}
                                        </span>
                                    </ValidationProvider>
                                </div>
                            </div>
                        </div>

                        <div class="field-group clearfix">
                            <input
                                type="submit"
                                class="field-submit btn-primary"
                                value="Add Friend"
                            />
                        </div>
                    </form>
                </ValidationObserver>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</template>
<script>
import PhoneDetails from "./elements/PhoneDetails.vue";
import Email from "./elements/Email.vue";
import HomeAddress from "./elements/Address";
import { ValidationObserver, ValidationProvider } from "vee-validate";
export default {
    components: {
        PhoneDetails,
        HomeAddress,
        Email,
        ValidationObserver,
        ValidationProvider
    },
    computed: {
        isOtherSelected() {
            return this.relationship === "5" ? true : false;
        },
        disabledDates() {
            return { from: new Date() };
        }
    },
    data() {
        return {
            name: "",
            relationship: "",
            address: "",
            phoneNumbers: [],
            emailAddress: "",
            dateOfBirth: "",
            relationshipOptions: [
                { id: 1, text: "Brother" },
                { id: 2, text: "Sister" },
                { id: 3, text: "Son" },
                { id: 4, text: "Daughter" },
                { id: 5, text: "Other" }
            ],
            friendsDetails: [],
            submitted: false,
            friendId: 0
        };
    },
    mounted() {},
    created() {
        this.friendId = this.$route.params.id;
        this.getFriendsInfo();
    },
    methods: {
        async handleSubmit(e) {
            this.submitted = true;

            const isValid = await this.$refs.observer.validate();
            if (!isValid) {
                // Do Something
            } else {
                const form = e.target;
                const formData = new FormData(form);

                if (this.friendId) {
                    axios
                        .post(
                            "/friendsinfo/" + this.friendId + "/updatedata",
                            formData
                        )
                        .then(response => {
                            console.log(response);
                            this.$router.push("/close-friends-question");
                        })
                        .catch(function() {});
                } else {
                    axios
                        .post("/friendsinfo/postdata", formData)
                        .then(response => {
                            console.log(response);
                            this.$router.push("/close-friends-question");
                        })
                        .catch(function() {});
                }
            }

            //this.$router.push("/close-friends-question");
        },
        updatePhoneNumbers(data) {
            this.phoneNumbers = data;
        },
        getFriendsInfo() {
            if (this.friendId) {
                axios
                    .get("/friendsinfo/" + this.friendId + "/getfriendsinfo")
                    .then(response => {
                        if (response.status == 200) {
                            this.friendsDetails = JSON.parse(
                                JSON.stringify(response.data.data[0])
                            );
                            if (this.friendsDetails.friends_phone.length > 0) {
                                this.phoneNumbers = this.friendsDetails.friends_phone;
                            } else {
                                this.phoneNumbers = [{ number: null }];
                            }
                        }
                    });
            }
        },
        updateHomeAddress(data) {
            this.address = data;
        }
    }
};
</script>
