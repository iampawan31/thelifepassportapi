<template>
    <div>
        <div class="field-group">
            <label for="benefits_used">Benefits used</label>
        </div>
        <div class="row">
            <div class="col">
                <div v-for="benefit in benefitOptions" v-bind:key="benefit.id">
                    <input
                        type="checkbox"
                        v-model="localBenefits"
                        :value="benefit"
                        name="benefit"
                    />
                    {{ benefit.title }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            type: Array,
            required: false
        },
        benefitOptions: {
            type: Array,
            required: true
        }
    },
    computed: {
        localBenefits: {
            get() {
                return this.value;
            },
            set(localBenefits) {
                this.$emit("input", localBenefits);
            }
        }
        // localBenefits: {
        //     get() {
        //         let benefits = this.localEmploymentDetail.benefits;
        //         let employeeBenefitsOptions = this.employeeBenefitsOptions;
        //         let ret = {};
        //         for (let i = 0; i < benefits.length; i++) {
        //             for (let j = 0; j < employeeBenefitsOptions.length; j++) {
        //                 if (
        //                     employeeBenefitsOptions[j].id ==
        //                     benefits[i].benefit_id
        //                 ) {
        //                     ret[employeeBenefitsOptions[j].id] = true;
        //                 }
        //             }
        //         }
        //         return ret;
        //     },
        //     set() {}
        // }
    }
};
</script>

<style></style>
