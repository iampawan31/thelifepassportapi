<template>
    <div class="c">
        <div class="question-item" data-nextpage="questions/close-friends.php">
            <h3 class="heading3">Close family members</h3>

            <!--<div class="section-data">
                <div class="data__wrapper">
                    <div class="data">
                        <div class="item item__header clearfix">
                            <div class="item__name">Name</div>
                            <div class="item__relationship">Relationship</div>
                            <div class="item__phone">Primary phone</div>
                            <div class="item__email">Email address</div>
                            <div class="item__action"></div>
                        </div>
                        <div class="item clearfix">
                            <div class="item__name">
                                <strong>Kapil Jain</strong>
                            </div>
                            <div class="item__relationship">Younger Brother</div>
                            <div class="item__phone">(987) 144 5190</div>
                            <div class="item__email">hello@kapiljain.in</div>
                            <div class="item__action">
                                <a href="#" class="btn-edit">
                                    <i data-feather="edit"></i>
                                </a> &nbsp;
                                <a href="#" class="btn-delete">
                                    <i data-feather="trash-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="btn-wrapper">
                        <a
                            href="#"
                            class="btn-primary link-toogle"
                            data-toggle="add-member"
                        >Add member</a>
                        <a href="#" class="btn-primary btn-no">Continue</a>
                    </div>
                </div>
            </div>-->

            <div id="add-member" class="section-form">
                <!--<div class="success-message">
                    <div class="success-message__text">Member added successfully.</div>
                    <button class="success-message__close">
                        <i data-feather="x-square"></i>
                    </button>
                </div>-->

                <div class="form-wrapper form-family-member">
                    <h3 class="heading4 uppercase">Add family member</h3>
                    <div class="error-message"></div>
                    <form
                        id="frmFamilyMember"
                        name="frmFamilyMember"
                        action="#"
                        method="post"
                        class="custom-form"
                    >
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
                            <label for="relationship" class="input-label">Relationship</label>
                            <select
                                name="relationship"
                                id="relationship"
                                class="custom-select required"
                                data-placeholder="Relationship"
                            >
                                <option></option>
                                <option value="1">Brother</option>
                                <option value="2">Sister</option>
                                <option value="3">Son</option>
                                <option value="4">Daughter</option>
                                <option value="other">Other</option>
                            </select>
                            <input
                                type="text"
                                name="relatiionship_other"
                                id="relatiionship_other"
                                class="field-input hidden"
                                placeholder="Please specify relation"
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

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="field-group">
                                    <label for="date_of_birth" class="input-label">Date of Birth</label>
                                    <input
                                        type="text"
                                        name="date_of_birth"
                                        id="date_of_birth"
                                        class="field-datepicker field-input"
                                        placeholder="DD/MM/YYYY"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="field-group clearfix">
                            <input
                                type="submit"
                                class="field-submit btn-primary"
                                value="Add Member"
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
export default {};
</script>