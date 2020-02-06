<template>
    <div class="c">
        <div v-if="showSpouseEstateRepresentativeDetails">
            <h3 class="heading3">
                Your Estate representative details
            </h3>
            <div class="spouse-details">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                            <h4 class="item__title">
                                Legal Name
                            </h4>
                            <div class="item__content">
                                {{ spouseEstateDetails.legal_name }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                            <h4 class="item__title">
                                Relationship
                            </h4>
                            <div class="item__content">
                                {{ spouseEstateDetails.relationship }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                            <h4 class="item__title">
                                Company
                            </h4>
                            <div class="item__content">
                                {{ spouseEstateDetails.company }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                            <h4 class="item__title">
                                Phone Number
                            </h4>
                            <div class="item__content">
                                {{ spouseEstateDetails.phone }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                            <h4 class="item__title">
                                Email
                            </h4>
                            <div class="item__content">
                                {{ spouseEstateDetails.email }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                            <h4 class="item__title">
                                Website
                            </h4>
                            <div class="item__content">
                                {{ spouseEstateDetails.website }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item__actions">
                    <router-link to="/spouse" class="btn-primary btn-editinfo">
                        Edit Information
                    </router-link>
                    <a
                        href="javascript:voi();"
                        class="btn-primary btn-danger delete-item"
                        @click="removeEstate()"
                        >Delete</a
                    >
                </div>
            </div>
        </div>
        <div
            v-if="!showSpouseEstateRepresentativeDetails"
            class="question-item"
            data-nextpage="questions/partner-estate-representative.php"
            data-viewpage="views/estate-representative.php"
        >
            <div class="question-header">
                <h3>
                    Does your spouse/life partner/signifcant other have a
                    personal representative of their estate?
                </h3>
                <div class="yesno">
                    <a
                        href="javascript:void(0)"
                        class="btn-yes"
                        @click.prevent="updateEstateStatus(1)"
                        >Yes</a
                    >
                    <a
                        href="javascript:void(0)"
                        class="btn-yes"
                        @click.prevent="updateEstateStatus(0)"
                        >No</a
                    >
                </div>
            </div>
            <a
                href="javascript:void(0)"
                class="btn-skip"
                @click.prevent="updateEstateStatus(2)"
                >Skip</a
            >
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            userId: "",
            spouseEstateDetails: [],
            showSpouseEstateRepresentativeDetails: false
        };
    },
    created() {
        this.getEstateInfo();
        this.updateStepInfo();
    },
    methods: {
        getEstateInfo() {
            axios.get("/personal/spouse/estate").then(response => {
                if (response.status == 200) {
                    if (response.data.data) {
                        this.spouseEstateDetails = JSON.parse(
                            JSON.stringify(response.data.data)
                        );
                        this.userId = this.spouseEstateDetails.user_id;
                        if (this.userId) {
                            this.showEstateRepresentativeDetails = true;
                        }
                    }
                }
            });
        },
        updateStepInfo() {
            let data = { step_id: 8, is_visited: "1" };
            axios
                .post("/steps", data)
                .then(response => {
                    console.log(response);
                })
                .catch(function() {});
        },
        updateEstateStatus(status) {
            if (status == 0) {
                this.formData = { has_spouse_estate: "0" };
            } else if (status == 1) {
                this.formData = { has_spouse_estate: "1" };
            } else if (status == 2) {
                this.formData = { has_spouse_estate: "2" };
            }

            axios
                .post("personal/spouse/estate/status", this.formData)
                .then(response => {
                    if (response.status == 201) {
                        if (status == "1") {
                            this.$router.push("/spouse-estate-representative");
                        } else {
                            // this.$router.push("/previous-spouse-question");
                        }
                    }
                })
                .catch(function() {});
        },
        removeEstate() {}
    }
};
</script>
