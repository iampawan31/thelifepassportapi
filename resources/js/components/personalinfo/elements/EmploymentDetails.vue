<template>
    <div class="add-anohter-field">
        <h4 class="form-subhead">
            Current Employers including self employment
        </h4>
        <div
            class="field-wrapper"
            v-for="(employer, index) in localEmploymentDetails"
            v-bind:key="index"
        >
            <employment-detail :value="employer" :employment-detail-key="index">
            </employment-detail>
            <a
                href="javascript:void(0);"
                class="btn-remove"
                v-if="index != 0"
                @click="removeEmployers(index)"
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
        <div class="btn-add" @click="addEmployers">
            <a href="javascript:void(0);">
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
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Add another
            </a>
        </div>
    </div>
</template>
<script>
import EmploymentDetail from "./EmploymentDetail";
export default {
    components: {
        EmploymentDetail
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
        localEmploymentDetails: {
            get() {
                return this.value;
            },
            set(localEmploymentDetails) {
                this.$emit("input", localEmploymentDetails);
            }
        }
    },
    methods: {
        addEmployers() {
            this.localEmploymentDetails.push({
                employer_name: "",
                employer_phone: "",
                employer_address: [],
                computer_username: "",
                computer_password: "",
                employee_benefits: []
            });
        },
        removeEmployers(lineId) {
            if (!this.blockRemoval)
                this.localEmploymentDetails.splice(lineId, 1);
        }
    }
};
</script>
