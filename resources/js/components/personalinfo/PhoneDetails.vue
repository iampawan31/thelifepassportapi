<template>
    <div class="field-group clearfix">
        <label for="phone_nubmer">Phone Numbers</label>
        <div class="add-anohter-field">
            <div
                class="field-wrapper"
                v-for="(phone, index) in phones"
                v-bind:key="index"
            >
                <phone
                    v-on:phone-number-update="updatePhoneNumber"
                    v-on:remove-phone-number="removePhone"
                    :phone-key="index"
                    :phone-number="phone.number"
                ></phone>
            </div>
            <div class="btn-add">
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
            phones: [],
            blockRemoval: true
        };
    },
    watch: {
        phones() {
            this.blockRemoval = this.phones.length <= 1;
        }
    },
    methods: {
        addPhone() {
            this.phones.push({ number: "" });
        },
        updatePhoneNumber(index, number) {
            this.phones[index] = number;
            this.$emit("phone-details-updates", this.phones);
        },
        populatePhone() {
            if (this.userPhones.length > 0) {
                this.userPhones.forEach(data => {
                    this.phones.push({ number: data.phone });
                });
            } else {
                this.phones.push({ number: null });
            }
        },
        removePhone(lineId) {
            if (!this.blockRemoval) this.phones.splice(lineId, 1);
        }
    },
    mounted() {
        this.$nextTick(() => {
            //this.addPhone()
            console.log(this.userPhones);
            this.populatePhone();
        });
    }
};
</script>
