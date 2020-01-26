<template>
    <div class="add-anohter-field">
        <h4 class="form-subhead">
            Current Employers including self employment
        </h4>
        <div
            class="field-wrapper"
            v-for="(employer, index) in employers"
            v-bind:key="index"
        >
            <employment-detail
                v-on:employment-detail-updated="updateEmploymentDetail"
                :employment-detail-key="index"
                :employer="employer"
            >
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
    props: ["userEmployers"],
    data() {
        return {
            employers: [],
            blockRemoval: true
        };
    },
    watch: {
        employers() {
            this.blockRemoval = this.employers.length <= 1;
        }
    },
    methods: {
        addEmployers() {
            this.employers.push({
                employer_name: null,
                employer_phone: null,
                employer_address: null,
                computer_username: null,
                computer_password: null,
                employee_benefits: null
            });
        },
        populateEmployers() {
            if (this.userEmployers.length > 0) {
                this.userEmployers.forEach(data => {
                    this.employers.push({
                        employer_name: data.employer_name,
                        employer_phone: data.employer_phone,
                        employer_address: data.employer_address,
                        computer_username: data.computer_username,
                        computer_password: data.computer_password,
                        employee_benefits: data.benefits_used
                    });
                });
            } else {
                this.employers.push({
                    employer_name: null,
                    employer_phone: null,
                    employer_address: null,
                    computer_username: null,
                    computer_password: null,
                    employee_benefits: []
                });
            }
        },
        removeEmployers(lineId) {
            if (!this.blockRemoval) this.employers.splice(lineId, 1);
        },
        updateEmploymentDetail(index, data) {
            this.employers[index].employer_name = data.employer_name;
            this.employers[index].employer_phone = data.employer_phone;
            this.employers[index].employer_address = data.address;
            this.employers[index].computer_username = data.computer_username;
            this.employers[index].computer_password = data.computer_password;
            this.employers[index].employee_benefits = data.employee_benefits;

            this.$emit("employment-details-updated", this.employers);
        }
    },
    mounted() {
        this.$nextTick(() => {
            //this.addEmployers();
            this.populateEmployers();
        });
    }
};
</script>
