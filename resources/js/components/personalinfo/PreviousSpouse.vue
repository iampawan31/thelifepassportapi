<template>
<div class="c">
    <div class="question-item" data-nextpage="questions/family-members.php">
        <h3 class="heading3">Former spouse details</h3>

        <div class="section-form">
            <div class="form-wrapper form-family-member">
                <div class="error-message"></div>
                <ValidationObserver ref="observer" v-slot="{ invalid }">
                <form
                    id="frmFormarSpouse"
                    name="frmFormarSpouse"
                    method="post"
                    class="custom-form"
                    enctype="multipart/form-data"
                    @submit.prevent="handleSubmit"
                >
                    <div class="field-group">
                        <label for="former_spouse_name" class="input-label">Former Spouse Name</label>
                        <ValidationProvider name="Legal Name" rules="required" v-slot="{ errors }">
                        <input
                            type="text"
                            name="legal_name"
                            id="legal_name"
                            class="field-input required"
                            placeholder="Former Spouse Name"
                            v-model="spouseDetails.legal_name"
                        />
                        <div class="invalid-feedback d-block" v-for="(error, index) in errors" v-bind:key="index">{{ error }}</div>
                        </ValidationProvider>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="field-group">
                                <label for="marriage_date" class="input-label">Marriage Date</label>
                                <datepicker 
                                    name="marriage_date" 
                                    format="MM/d/yyyy" 
                                    placeholder="MM/DD/YYYY" 
                                    v-model="spouseDetails.marriage_date"
                                    class="field-datepicker field-input">
                                </datepicker>
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
                                    v-model="spouseDetails.marriage_location"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="field-group">
                                <label for="divorce_date" class="input-label">Divorce Date</label>
                                <datepicker 
                                    name="divorce_date" 
                                    format="MM/d/yyyy" 
                                    placeholder="MM/DD/YYYY" 
                                    v-model="spouseDetails.divorce_date"
                                    class="field-datepicker field-input">
                                </datepicker>
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
                                    v-model="spouseDetails.divorce_location"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="current_address">current Address</label>
                        <textarea
                            rows="2"
                            name="address"
                            id="address"
                            class="field-input"
                            placeholder="Street Address, Town, City, State, Zipcode and country"
                            v-model="spouseDetails.address"
                        ></textarea>
                    </div>

                    <phone :user-phones="phones" v-if="phones.length > 0"></phone>

                    <div class="field-group">
                        <label for="email" class="input-label">Email</label>
                        <input
                            type="text"
                            name="email"
                            id="email"
                            class="field-input required email"
                            placeholder="Email address"
                            v-model="spouseDetails.email"
                        />
                    </div>

                    <div class="switch-wrapper clearfix">
                        <div class="field-group can-toggle can-toggle--size-small">
                            <input
                                id="owe_alimony"
                                name="owe_alimony"
                                type="checkbox"
                                class="toggle-fields"
                                :value="isAlimonyPaid"
                                data-toggle-fields="alimony_details"
                                v-model="isAlimonyPaid"
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
                        
                        <div id="alimony_details" v-if="isAlimonyPaid">
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="field-group">
                                        <label for="alimony_agreement" class="input-label">Agreement</label>
                                        <div class="input-file-wrapper clearfix">
                                            <div class="input-browse" v-if="divorceDoc.length == 0">
                                                <span class="btn-link">Add file</span>
                                                <input
                                                    type="file"
                                                    id="alimony_agreement"
                                                    name="alimony_agreement"
                                                    @change="handleFileUpload"
                                                />
                                            </div>
                                            
                                            <div class="input-file-name" v-if="divorceDoc.title">
                                                <span><a :href="divorceDoc.url">{{ divorceDoc.title }}</a></span>
                                                <a href="javascript:void(0);" @click="removeDivorceFile()" class="removefile">&times;</a>
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
                                            v-model="spouseDetails.alimony_amount"
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
                </ValidationObserver>
                <div class="clearfix"></div>
            </div>
        </div>
    </div></div>
</template>
<script>
import Select2 from 'v-select2-component';
import Datepicker from 'vuejs-datepicker';
import Phone from './Phone.vue';
import Email from './Email.vue';
import Social from './Social.vue';
import Employee from './Employee.vue';
import { ValidationObserver, ValidationProvider } from "vee-validate";

export default {
    components:{
        Phone,
        Email,
        Datepicker,
        Social,
        Employee,
        Select2,
        ValidationObserver,
		ValidationProvider
    },
    data() {
        return {
            spouseDetails: [],
            phones: [],
            emails: [],
            socials: [],
            employers:[],
            userId: 0,
            submitted: false,
            citizenshipOptions: [],
            file: '',
            isAlimonyPaid: false,
            divorceDoc: []
        };
    },
    created() {
        axios.get('/getprevspouseinfo').then((response) => {
            if (response.status == 200) {
                console.log(response.data);
                if (response.data.data[0]) {
                    this.spouseDetails = JSON.parse(JSON.stringify(response.data.data[0]));
                    this.userId = this.spouseDetails.user_id;

                    if (this.spouseDetails.is_alimony_paid == '1') {
                        this.isAlimonyPaid = true;
                    }

                    if (this.spouseDetails.previous_spouse_phone.length > 0) {
                        this.phones = this.spouseDetails.previous_spouse_phone;
                    } else {
                        this.phones = [{number: null}];
                    }
                    
                    if (this.spouseDetails.divorce_doc.length > 0) {
                        this.divorceDoc = this.spouseDetails.divorce_doc[0];
                    }
                } else {
                    this.phones = [{number: null}];
                }
            }
        });
    },
    mounted() {},
    methods: {
        handleFileUpload(e){
            this.file = e.target.files;
        },
        async handleSubmit(e) {
            //this.$router.push("/family-members-question");
            this.submitted = true;
            const isValid = await this.$refs.observer.validate();
            if(!isValid){

            }else{
                let form = e.target;
                let formData = new FormData(form);
                formData.append('file', this.file);

                if (this.userId) {
                    axios.post('/previousspouse/'+this.userId+'/updatedata', formData, {headers: {'Content-Type': 'multipart/form-data'}})
                        .then((response) => {
                            this.$router.push("/family-members-question");
                        })
                        .catch(function(){

                        });
                } else {
                    axios.post('/previousspouse/postdata', formData)
                        .then((response) => {
                            this.$router.push("/family-members-question");
                        })
                        .catch(function(){

                        });
                }
			}
        },
        removeDivorceFile() {
            axios.post('/removedivorcefile')
            .then((response) => { 
                if (response.status == 200) {
                    this.divorceDoc = [];
                }
            })
            .catch(function () {

            });
        }
    }
};
</script>