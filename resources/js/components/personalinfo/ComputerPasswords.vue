<template>
    <div class="c">
        <div class="question-item" data-nextpage="questions/medical-providers.php">
            <div class="section-form">
                <div class="form-wrapper form-family-member">
                    <form name="frmFamilyMember" action="#" method="post" class="custom-form" @submit.prevent="handleSubmit()">
                        <div class="staff-members-fields">
                            <div class="field-group">
                                <label for="txt_name" class="input-label">Computer/Device</label>
                                <input
                                    type="text"
                                    name="txt_name"
                                    id="txt_name"
                                    data-id="txt_name"
                                    class="field-input required"
                                    placeholder="Computer/Device"
                                    
                                />
                            </div>

                            <div class="field-group">
                                <label for="txt_name" class="input-label">User Name</label>
                                <input
                                    type="text"
                                    name="txt_name"
                                    id="txt_name"
                                    data-id="txt_name"
                                    class="field-input required"
                                    placeholder="User Name"
                                    
                                />
                            </div>

                            <div class="field-group">
                                <label for="txt_name" class="input-label">Password</label>
                                <input
                                    type="text"
                                    name="txt_name"
                                    id="txt_name"
                                    data-id="txt_name"
                                    class="field-input required"
                                    placeholder="Password"
                                    
                                />
                            </div>

                            <div class="btn-add"><a href="#"><i data-feather="plus"></i> Add More </a></div>
                        </div>

                        <div class="field-group clearfix">
                            <input
                                type="submit"
                                class="field-submit btn-primary"
                                value="Save and continue"
                            />
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
    data() {
        return {};
    },
    mounted() {},
    methods: {
        handleSubmit(e) {
            this.$router.push("/medical-providers-question");
        }
    }
};
</script>