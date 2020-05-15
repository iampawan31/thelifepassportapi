<template>
    <div>
        <!-- <div class="field-group form-group-checkbox clearfix vertical">
             <div
                    v-for="benefit in selectedBenefits"
                    v-bind:key="benefit.id"
                >
                    <label for="benefit">
                        <input
                            type="checkbox"
                            :id="benefit.id"
                            :checked="benefit.checked"
                            :value="benefit.id"
                            @click="check($event)"
                            name="benefit"
                        /><i /> <span>{{ benefit.title }}</span>
                        
                    </label>
            </div>
        </div> -->
        <div class="field-group">
            <label for="benefits_used">Benefits used</label>
        </div>
        <div class="row">
            <div class="col">
                <div
                    v-for="benefit in selectedBenefits"
                    v-bind:key="benefit.id"
                >
                    <input
                        type="checkbox"
                        :id="benefit.id"
                        :checked="benefit.checked"
                        :value="benefit.id"
                        @click="check($event)"
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
        },
        selectedBenefits() {
            var checkedIds = [];
            var results = [];
            for (var i = 0; i < this.localBenefits.length; i++) {
                checkedIds.push(this.localBenefits[i].id);
            }
            for (var j = 0; j < this.benefitOptions.length; j++) {
                var item = this.benefitOptions[j];
                if (checkedIds.includes(this.benefitOptions[j].id)) {
                    item.checked = true;
                } else {
                    item.checked = false;
                }
                results.push(item);
            }
            return results;
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
    },
    methods: {
        check(e) {
            if (e.target.checked) {
                var newCat = {
                    "0": e.target.value,
                    id: e.target.value
                };
                this.localBenefits.push(newCat);
            } else {
                for (var i = 0; i < this.localBenefits.length; i++) {
                    if (this.localBenefits[i].id == e.target.value) {
                        this.localBenefits.splice(i, 1);
                    }
                }
            }
        }
    }
};
</script>

<style></style>
