<template>
    <div class="c">
        <div v-if="showPreviousSpouseDetails">
            <h3 class="heading3">Former spouse details</h3>
            <div class="spouse-details">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                            <h4 class="item__title">Legal Name</h4>
                            <div class="item__content">
                                {{ spouseDetails.legal_name }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                            <h4 class="item__title">Marriage Date</h4>
                            <div class="item__content">
                                {{ spouseDetails.marriage_date }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                            <h4 class="item__title">Marriage Location</h4>
                            <div class="item__content">
                                {{ spouseDetails.marriage_location }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                            <h4 class="item__title">Divorce Date</h4>
                            <div class="item__content">
                                {{ spouseDetails.divorce_date }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                            <h4 class="item__title">Divorce Location</h4>
                            <div class="item__content">
                                {{ spouseDetails.divorce_location }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                            <h4 class="item__title">Current Address</h4>
                            <div class="item__content">
                                {{ spouseDetails.address.street_address1 }}, {{ spouseDetails.address.street_address2 }}, {{ spouseDetails.address.city }}, {{ spouseDetails.address.state }}<br />
                                {{ spouseDetails.address.zipcode }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                            <h4 class="item__title">Phone Numbers</h4>
                            <div class="item__content">
                                <span
                                    v-for="(phone,
                                    index) in spouseDetails.phones"
                                    v-bind:key="index"
                                >
                                    {{ phone.phone }}<br />
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="item">
                            <h4 class="item__title">Email Addresses</h4>
                            <div class="item__content">
                                <span> {{ spouseDetails.email }}<br /> </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item__actions">
                    <router-link
                        to="/previous-spouse"
                        class="btn-primary btn-editinfo"
                        >Edit Information</router-link
                    >
                    <a
                        href="javascript:voi();"
                        @click="removePreviousSpouse()"
                        class="btn-primary btn-danger delete-item"
                        >Delete</a
                    >
                </div>
            </div>
        </div>

        <div class="question-item" v-if="!showPreviousSpouseDetails">
            <div class="question-header">
                <h3>Were you previously married?</h3>
                <div class="yesno">
                    <a
                        href="javascript:void(0)"
                        @click.prevent="prevmarriagestatus(1)"
                        class="btn-yes"
                        >Yes</a
                    >
                    <a
                        href="javascript:void(0)"
                        @click.prevent="prevmarriagestatus(0)"
                        class="btn-no"
                        >No</a
                    >
                </div>
            </div>
            <a
                href="javascript:void(0)"
                @click.prevent="prevmarriagestatus(2)"
                class="btn-skip"
                >Skip</a
            >
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            formData: [],
            showPreviousSpouseDetails: false,
            spouseDetails: [],
            userId: ""
        };
    },
    mounted() {
        this.updatestepinfo();
        this.getPreviousSpouseInfo();
    },
    methods: {
        prevmarriagestatus(status) {
            if (status == 0) {
                this.formData = { is_married: "0" };
            } else if (status == 1) {
                this.formData = { is_married: "1" };
            } else if (status == 2) {
                this.formData = { is_married: "2" };
            }
            console.log(this.formData);
            axios
                .post("personal/marriage-status", this.formData)
                .then(response => {
                    if (response.status == 201) {
                        if (status == "1") {
                            this.$router.push("/previous-spouse");
                        } else {
                            this.$router.push("/family-members-question");
                        }
                    }
                })
                .catch(function() {});
        },
        updatestepinfo() {
            let data = { step_id: 3, is_visited: "1" };
            axios
                .post("/steps", data)
                .then(response => {
                    console.log(response);
                })
                .catch(function() {});
        },
        getPreviousSpouseInfo() {
            axios.get("/getprevspouseinfo").then(response => {
                if (response.status == 200) {
                    if (response.data.data[0]) {
                        this.spouseDetails = JSON.parse(
                            JSON.stringify(response.data.data[0])
                        );
                        //console.log(this.spouseDetails);
                        this.userId = this.spouseDetails.user_id;
                        this.showPreviousSpouseDetails = true;
                    }
                }
            });
        },
        removePreviousSpouse() {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "Delete previous spouse information?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                })
                .then(result => {
                    if (result.value) {
                        axios
                            .delete(
                                "previousspouse/" +
                                    this.userId +
                                    "/removespouse"
                            )
                            .then(response => {
                                this.$swal.fire(
                                    "Deleted!",
                                    "Previous spouse information is deleted",
                                    "success"
                                );
                                this.showPreviousSpouseDetails = false;
                            })
                            .catch(function() {});
                    }
                });
        }
    }
};
</script>
