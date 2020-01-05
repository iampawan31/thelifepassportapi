<template>
    <div class="c">
        <div v-if="showSpouseDetails">
            <h3 class="heading3">Your spouse details</h3>
            <div class="spouse-details">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                        <h4 class="item__title">Legal Name</h4>
                        <div class="item__content">{{ spouseDetails.legal_name }}</div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                        <h4 class="item__title">Nickname or Prior Name</h4>
                        <div class="item__content">{{ spouseDetails.nickname }}</div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                        <h4 class="item__title">Date of Birth</h4>
                        <div class="item__content">{{ spouseDetails.dob }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                        <h4 class="item__title">Home Address</h4>
                        <div class="item__content">{{ spouseDetails.home_address }}</div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                        <h4 class="item__title">Citizenship</h4>
                        <div class="item__content">{{ spouseDetails.countries.country_name }}</div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                        <h4 class="item__title">Passport Number</h4>
                        <div class="item__content">{{ spouseDetails.passport_number }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                        <h4 class="item__title">Phone Numbers</h4>
                        <div class="item__content">
                            <span v-for="(phone, index) in spouseDetails.spouse_phone" v-bind:key="index">
                                {{ phone.phone }}<br>
                            </span>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                        <h4 class="item__title">Email Addresses</h4>
                        <div class="item__content">
                            <span v-for="(email, index) in spouseDetails.spouse_email" v-bind:key="index">
                                {{ email.email }}<br>
                            </span>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="item__actions">
                    <router-link to="/spouse" class="btn-primary btn-editinfo">Edit Information</router-link>
                    <a href="javascript:voi();" @click="removeSpouse()" class="btn-primary btn-danger delete-item">Delete</a>
                </div>
            </div>
        </div>
        <div class="question-item" v-if="!showSpouseDetails">
            <div class="question-header">
                <h3>Are you married?</h3>
                <div class="yesno">
                    <a href="javascript:void(0)" @click.prevent="marriagestatus(1)" class="btn-yes">Yes</a>
                    <a href="javascript:void(0)" @click.prevent="marriagestatus(0)" class="btn-no">No</a>
                </div>
            </div>
            <a href="javascript:void(0)" @click.prevent="marriagestatus(2)" class="btn-skip">Skip</a>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            spouseDetails: [],
            formData: [],
            userId: '',
            showSpouseDetails: false,
        }
    },
    created () {
        this.getSpouseInfo();
        this.updatestepinfo();
    },
    mounted() {

    },
    methods: {
        getSpouseInfo () {
            axios.get('/getspouseinfo').then((response) => {
                if (response.status == 200) {
                    if (response.data.data[0]) {
                        this.spouseDetails = JSON.parse(JSON.stringify(response.data.data[0]));
                        this.userId = this.spouseDetails.user_id;
                        if (this.userId) {
                            this.showSpouseDetails = true;
                        }
                    }
                }
            });
        },
        marriagestatus(status) {
            if (status == 0) {
                this.formData = {is_married: "0"}
            } else if (status == 1) {
                this.formData = {is_married: "1"}
            } else if (status == 2) {
                this.formData = {is_married: "2"}
            }
            
            axios.post('spouse/updatemarriagestatus', this.formData)
                .then((response) => {
                    if (status == '1') {
                        this.$router.push('/spouse');
                    } else {
                        this.$router.push('/previous-spouse');
                    }
                })
                .catch(function(){

                });
        },
        updatestepinfo() {
            let data = {'step_id':2, 'is_visited': '1', 'is_filled' : '0', 'is_completed' : '0'}
            axios.post('/updatepersonalstep', data)
                .then((response) => {
                    
                })
                .catch(function(){

                });
        },
        removeSpouse () {
            axios.delete('spouse/'+this.userId+'/removespouse')
                .then((response) => {
                   console.log(response);
                   this.showSpouseDetails = false;
                })
                .catch(function(){

                });
        }
    }
};
</script>