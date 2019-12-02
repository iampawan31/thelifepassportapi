<template>
    <div class="c">
        <div class="question-item" data-nextpage="questions/partner-estate-representative.php">
            <div class="section-form">
                <div class="form-wrapper form-family-member">
                    <form
                        name="frmFamilyMember"
                        action="#"
                        method="post"
                        class="custom-form"
                        @submit.prevent="handleSubmit()"
                    >
                        <div class="staff-members-fields">
                            <div class="field-group">
                                <label for="txt_name" class="input-label">Member Name</label>
                                <input
                                    type="text"
                                    name="txt_name"
                                    id="txt_name"
                                    data-id="txt_name"
                                    class="field-input required"
                                    placeholder="Member Name"
                                    
                                />
                            </div>
                            <div class="field-group">
                                <label for="txt_name" class="input-label">Member Number</label>
                                <input
                                    type="text"
                                    name="txt_name"
                                    id="txt_name"
                                    data-id="txt_name"
                                    class="field-input required"
                                    placeholder="Member Number"
                                    
                                />
                            </div>
                            <div class="field-group">
                                <label for="txt_name" class="input-label">Organization</label>
                                <input
                                    type="text"
                                    name="txt_name"
                                    id="txt_name"
                                    data-id="txt_name"
                                    class="field-input required"
                                    placeholder="Organization"
                                    
                                />
                            </div>

                            <div class="field-group">
                                <label for="txt_name" class="input-label">Phone Number</label>
                                <input
                                    type="text"
                                    name="txt_name"
                                    id="txt_name"
                                    data-id="txt_name"
                                    class="field-input required"
                                    placeholder="Phone Number"
                                    
                                />
                            </div>
                            <div class="field-group">
                                <label for="txt_name" class="input-label">Email</label>
                                <input
                                    type="text"
                                    name="txt_name"
                                    id="txt_name"
                                    data-id="txt_name"
                                    class="field-input required"
                                    placeholder="Email"
                                    
                                />
                            </div>
                            <div class="field-group">
                                <label for="home_address">Positions/Duties</label>
                                <input
                                    type="text"
                                    name="home_address"
                                    id="home_address"
                                    class="field-input"
                                    placeholder="Positions/Duties"
                                />
                            </div>
                            <div class="field-group">
                                <label for="txt_name" class="input-label">Homors and Awards Received</label>
                                <textarea
                                    row="2"
                                    name="txt_name"
                                    id="txt_name"
                                    data-id="txt_name"
                                    class="field-input required"
                                    placeholder="Homors and Awards Received"
                                ></textarea>
                            </div>

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
            this.$router.push("/computer-passwords-question");
        }
    }
};
</script>