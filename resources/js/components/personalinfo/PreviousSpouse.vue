<template>
<div class="c">
    <div class="question-item" data-nextpage="questions/family-members.php">
        <h3 class="heading3">Former spouse details</h3>

        <div class="section-form">
            <div class="form-wrapper form-family-member">
                <div class="error-message"></div>
                <form
                    id="frmFormarSpouse"
                    name="frmFormarSpouse"
                    method="post"
                    class="custom-form"
                    action="#"
                    @submit.prevent="handleSubmit()"
                >
                    <div class="field-group">
                        <label for="former_spouse_name" class="input-label">Former Spouse Name</label>
                        <input
                            type="text"
                            name="former_spouse_name"
                            id="former_spouse_name"
                            class="field-input required"
                            placeholder="Name"
                        />
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="field-group">
                                <label for="marriage_date" class="input-label">Marriage Date</label>
                                <input
                                    type="text"
                                    name="marriage_date"
                                    id="marriage_date"
                                    class="field-datepicker field-input"
                                    placeholder="DD/MM/YYYY"
                                />
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="field-group">
                                <label for="marriage_location" class="input-label">Marriage Location</label>
                                <input
                                    type="text"
                                    name="marriage_location"
                                    id="marriage_location"
                                    class="field-input required"
                                    placeholder="Marriage Location"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="field-group">
                                <label for="divorce_date" class="input-label">Divorce Date</label>
                                <input
                                    type="text"
                                    name="divorce_date"
                                    id="divorce_date"
                                    class="field-datepicker field-input"
                                    placeholder="DD/MM/YYYY"
                                />
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="field-group">
                                <label for="divorce_location" class="input-label">Divorce Location</label>
                                <input
                                    type="text"
                                    name="divorce_location"
                                    id="divorce_location"
                                    class="field-input required"
                                    placeholder="Divorce Location"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="current_address">current Address</label>
                        <textarea
                            rows="2"
                            name="current_address"
                            id="current_address"
                            class="field-input"
                            placeholder="Street Address, Town, City, State, Zipcode and country"
                        ></textarea>
                    </div>

                    <div class="field-group">
                        <label for="phone_number">Primary Phone Number</label>
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

                    <div class="switch-wrapper clearfix">
                        <div class="field-group can-toggle can-toggle--size-small">
                            <input
                                id="owe_alimony"
                                name="owe_alimony"
                                type="checkbox"
                                value="1"
                                class="toggle-fields"
                                data-toggle-fields="alimony_details"
                            />
                            <label for="owe_alimony">
                                <div
                                    class="can-toggle__label-text"
                                >Do you owe alimony to this previous spouse?</div>
                                <div
                                    class="can-toggle__switch"
                                    data-checked="Yes"
                                    data-unchecked="No"
                                ></div>
                            </label>
                        </div>

                        <div id="alimony_details" class="hidden">
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="field-group">
                                        <label for="alimony_agreement" class="input-label">Agreement</label>
                                        <div class="input-file-wrapper clearfix">
                                            <div class="input-browse">
                                                <span class="btn-link">Add file</span>
                                                <input
                                                    type="file"
                                                    id="alimony_agreement"
                                                    name="alimony_agreement"
                                                />
                                            </div>
                                            <div class="input-file-name">
                                                <span></span>
                                                <button class="removefile">&times;</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="field-group">
                                        <label for="alimony_amount" class="input-label">Amount</label>
                                        <input
                                            type="text"
                                            name="alimony_amount"
                                            id="alimony_amount"
                                            class="field-input required"
                                            placeholder="Amount"
                                        />
                                    </div>
                                </div>
                            </div>
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
    </div></div>
</template>
<script>
export default {
    data() {
        return {};
    },
    mounted() {},
    methods: {
        handleSubmit(e) {
            this.$router.push("/family-members-question");
        }
    }
};
</script>