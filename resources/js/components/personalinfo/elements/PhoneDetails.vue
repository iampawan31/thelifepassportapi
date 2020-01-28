<template>
    <div class="field-group clearfix">
        <label for="phone_nubmer">Phone Numbers</label>
        <div class="add-anohter-field">
            <div
                class="field-wrapper"
                v-for="(phone, index) in userPhones"
                v-bind:key="index"
            >
                <phone
                    v-on:phone-number-update="updatePhoneNumber"
                    v-on:remove-phone-number="removePhone"
                    :phone-key="index"
                    :phone-number="phone.phone"
                ></phone>
            </div>
            <div class="btn-add" v-show="singlePhoneNumberIsAdded">
                <a href="javascript:void(0);" @click="addPhone">
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
                        class="feather feather-plus"
                    >
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Add another
                </a>
            </div>
        </div>
    </div>
</template>
<script>
import Phone from "./Phone";

export default {
    components: {
        Phone
    },
    props: ["userPhones"],
    data() {
        return {
            blockRemoval: true
        };
    },
    computed: {
        singlePhoneNumberIsAdded() {
            return this.userPhones !== undefined && this.userPhones.length > 0;
        }
    },
    watch: {
        phones() {
            this.blockRemoval = this.userPhones.length <= 1;
        }
    },
    methods: {
        addPhone() {
            this.userPhones.push({ phone: null });
        },
        updatePhoneNumber(index, phone) {
            this.userPhones[index].phone = phone;
            this.$emit("phone-details-updates", this.userPhones);
        },
        removePhone(lineId) {
            this.userPhones.splice(lineId, 1);
        }
    }
};
</script>
