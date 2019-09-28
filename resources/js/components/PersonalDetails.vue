<template>
    <div id="questions-wrapper">
        <div class="question-item open">
            <div class="question-item__content" data-nextpage="spouse.php">
                <div class="container clearfix">
                    <div class="question-header">
                        <h3>Please enter your personal details below:</h3>
                    </div>
                    <div class="question-content">
                        <div class="success-message">
                            <div class="success-message__text"></div>
                            <button class="success-message__close"><i data-feather="x-square"></i></button>
                        </div>
                        <div class="form-wrapper">
                            <div class="error-message"></div>
                            <form id="personal-details-form" name="personal-details-form" method="post" class="custom-form" @submit.prevent="handleSubmit">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="field-group">
                                            <label for="legal_name" class="input-label">Legal Name</label>
                                            <input 
                                                type="text" 
                                                v-model="user.legal_name" 
                                                name="legal_name" 
                                                id="legal_name" 
                                                class="field-input"
                                                :class="{ 'input-error': submitted && $v.user.legal_name.$error }" 
                                                placeholder="Legal Name" />
                                            <span v-if="submitted && !$v.user.legal_name.required" class="invalid-feedback">
                                                Legal name is required
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="field-group">
                                            <label for="nick_name" class="input-label">Nickname or Prior Name</label>
                                            <input 
                                                type="text" 
                                                v-model="user.nick_name" 
                                                :class="{ 'input-error': submitted && $v.user.nick_name.$error }" 
                                                name="nick_name" 
                                                id="nick_name" 
                                                class="field-input" 
                                                placeholder="Nickname or prior name" 
                                                />
                                            <span v-if="submitted && !$v.user.nick_name.required" class="invalid-feedback">
                                                Nick name is required
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="field-group">
                                    <label for="home_address">Home Address</label>
                                    <textarea 
                                        rows="2" 
                                        v-model="user.home_address" 
                                        :class="{ 'input-error': submitted && $v.user.home_address.$error }"  
                                        name="home_address" 
                                        id="home_address" 
                                        class="field-input" 
                                        placeholder="Street Address, Town, City, State, Zipcode and country" 
                                        ></textarea>
                                    <span v-if="submitted && !$v.user.home_address.required" class="invalid-feedback">
                                        Home address is required
                                    </span>
                                </div>
                                <div class="field-group">
                                    <label for="phone_nubmer">Phone Numbers</label>
                                    <input 
                                        type="text" 
                                        v-model="user.phone_nubmer" 
                                        :class="{ 'input-error': submitted && $v.user.phone_nubmer.$error }"  
                                        name="phone_nubmer" 
                                        id="phone_nubmer" 
                                        class="field-input input-mobile" 
                                        placeholder="Primary phone number"/>
                                    <span v-if="submitted && !$v.user.phone_nubmer.required" class="invalid-feedback">
                                        Phone number is required
                                    </span>
                                </div>
                                <div class="field-group">
                                    <label for="dob" class="input-label">Date of Birth</label>
                                    <input 
                                        type="text" 
                                        v-model="user.dob" 
                                        :class="{ 'input-error': submitted && $v.user.dob.$error }"
                                        name="dob" 
                                        id="dob" 
                                        class="field-datepicker field-input" 
                                        placeholder="DD/MM/YYYY"/>
                                    <span v-if="submitted && !$v.user.dob.required" class="invalid-feedback">
                                        DOB is required
                                    </span>
                                </div>
                                <h4 class="form-subhead">Email Addresses</h4>
                                <div class="field-group">
                                    <input 
                                        type="text" 
                                        v-model="user.email" 
                                        :class="{ 'input-error': submitted && $v.user.email.$error }"
                                        name="email" 
                                        id="email" 
                                        class="field-input field-input__first email" 
                                        placeholder="Email address"/>
                                    <span v-if="submitted && !$v.user.email.required" class="invalid-feedback">
                                        Email is required
                                    </span>
                                    <span v-if="!$v.user.email.email" class="invalid-feedback">Email is invalid</span>
                                </div>
                                <div class="field-group field-group__action clearfix">
                                    <input type="submit" class="field-submit btn-primary" value="Save and continue"/>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { required, email, minLength } from "vuelidate/lib/validators";
    export default {
        data(){
            return {
                user: {
                    legal_name: '',
                    nick_name: '',
                    home_address: '',
                    phone_nubmer: '',
                    dob: '',
                    email: ''
                },
                submitted: false
            };
        },
        validations: {
            user: {
                legal_name: { required },
                nick_name: { required },
                home_address: { required, minLength: minLength(500) },
                phone_nubmer: { required, minLength: minLength(10) },
                dob: { required, minLength: minLength(10) },
                email: { required, email },
            }
        },
        mounted() {
            
        },
        methods:{
            handleSubmit(e) {
                this.submitted = true;
                // stop here if form is invalid
                this.$v.$touch();
                console.log(this.$v.user.legal_name.$error);
                console.log(this.$v.user.legal_name.required);
                if (this.$v.$invalid) {
                    console.log("invalid");
                    return;
                }

                alert("SUCCESS!! :-)\n\n" + JSON.stringify(this.user));
            }
        },
    }
</script>