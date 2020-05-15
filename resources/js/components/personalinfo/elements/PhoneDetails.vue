<template>
    <div class="field-group clearfix">
        <label for="phone_nubmer">Phone Numbers</label>
        <div class="add-anohter-field">
            <div
                class="field-wrapper"
                v-for="(phone, index) in localPhones"
                v-bind:key="index"
            >
                <phone
                    v-model="phone.phone"
                    v-on:remove-phone-number="removePhone"
                    :phone-key="index"
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
    props: {
        value: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            blockRemoval: true
        };
    },
    computed: {
        localPhones: {
            get() {
                return this.value;
            },
            set(localPhones) {
                this.$emit("input", localPhones);
            }
        },
        singlePhoneNumberIsAdded() {
            return (
                this.localPhones !== undefined && this.localPhones.length > 0
            );
        }
    },
    methods: {
        addPhone() {
            this.localPhones.push({ phone: null });
        },
        removePhone(lineId) {
            this.localPhones.splice(lineId, 1);
        }
    }
};
</script>
