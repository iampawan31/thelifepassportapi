<template>
    <div class="c">
        <div class="question-item" data-nextpage="questions/estate-representative.php">
            <div class="section-form">
                <div class="form-wrapper form-family-member">
                    <form name="frmFamilyMember" action="#" method="post" class="custom-form" @submit.prevent="handleSubmit()">
                        <div class="staff-members-fields">
                            <div class="field-group">
                                <label for="txt_name" class="input-label">Name</label>
                                <input
                                    type="text"
                                    name="txt_name"
                                    id="txt_name"
                                    data-id="txt_name"
                                    class="field-input required"
                                    placeholder="Name"
                                    
                                />
                            </div>

                            <div class="field-group">
                                <label for="home_address">Home Address</label>
                                <textarea
                                    rows="2"
                                    name="home_address"
                                    id="home_address"
                                    class="field-input"
                                    placeholder="Street Address, Town, City, State, Zipcode and country"
                                ></textarea>
                            </div>

                            <div class="field-group">
                                <label for="phone_number">Phone Numbers</label>
                                <input
                                    type="text"
                                    name="phone_number"
                                    id="phone_number"
                                    class="field-input required input-mobile"
                                    placeholder="Primary contact number"
                                />
                                <div class="add-anohter-field">
                                    <div class="field-wrapper hidden">
                                        <input
                                            type="text"
                                            name="phone_number"
                                            id="phone_number"
                                            class="field-input required input-mobile"
                                            placeholder="Alternate contact number"
                                        />
                                        <a href="#" class="btn-remove">
                                            <i data-feather="minus-circle"></i>
                                        </a>
                                    </div>
                                    <div class="field-wrapper hidden">
                                        <input
                                            type="text"
                                            name="phone_number"
                                            id="phone_number"
                                            class="field-input required input-mobile"
                                            placeholder="Alternate contact number"
                                        />
                                        <a href="#" class="btn-remove">
                                            <i data-feather="minus-circle"></i>
                                        </a>
                                    </div>
                                    <div class="btn-add">
                                        <a href="#">
                                            <i data-feather="plus"></i> Add another
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="field-group">
                                <label for="user_email" class="input-label">Email</label>
                                <input
                                    type="text"
                                    name="user_email"
                                    id="user_email"
                                    class="field-input required email"
                                    placeholder="Email address"
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