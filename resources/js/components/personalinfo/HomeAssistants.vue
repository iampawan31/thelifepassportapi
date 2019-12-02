<template>
    <div class="c">
        <div class="question-item" data-nextpage="questions/estate-representative.php">
            <div class="section-form">
                <div class="form-wrapper form-family-member">
                    <form name="frmFamilyMember" action="#" method="post" class="custom-form" @submit.prevent="handleSubmit()">
                        <div class="staff-members-fields">
                            <div class="field-group">
                                <label for="txt_name" class="input-label">Person or asset cared for</label>
                                <input
                                    type="text"
                                    name="txt_name"
                                    id="txt_name"
                                    data-id="txt_name"
                                    class="field-input required"
                                    placeholder="Person or asset cared for"
                                    
                                />
                            </div>

                            <div class="field-group">
                                <label for="txt_name" class="input-label">Provider Name</label>
                                <input
                                    type="text"
                                    name="txt_name"
                                    id="txt_name"
                                    data-id="txt_name"
                                    class="field-input required"
                                    placeholder="Provider Name"
                                    
                                />
                            </div>

                            <div class="field-group">
                                <label for="home_address">Provider Address</label>
                                <textarea
                                    rows="2"
                                    name="home_address"
                                    id="home_address"
                                    class="field-input"
                                    placeholder="Street Address, Town, City, State, Zipcode and country"
                                ></textarea>
                            </div>

                            <div class="field-group">
                                <label for="phone_number">Day and Time of care received</label>
                                <input
                                    type="text"
                                    name="phone_number"
                                    id="phone_number"
                                    class="field-input required input-mobile"
                                    placeholder="Day and Time of care received"
                                />
                            </div>

                            <div class="field-group clearfix">
                                <input
                                    type="submit"
                                    class="field-submit btn-primary"
                                    value="Save and continue"
                                />
                            </div>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {}
    },
    mounted() {},
    methods: {
        handleSubmit(e) {
            this.$router.push("/estate-representative-question");
        }
    }

}
</script>