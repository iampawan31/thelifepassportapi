<template>
    <div class="c">
        <div v-if="showFamilyDetails">
            <h3 class="heading3">Close family members</h3>
            <div class="data">
                <div class="item item__header clearfix">
                    <div class="item__name">Name</div>
                    <div class="item__relationship">Relationship</div>
                    <div class="item__email">Email</div>
                    <div class="item__phone"></div>
                    <div class="item__action"></div>
                </div>
                <div
                    class="item clearfix"
                    v-for="(family, index) in familyDetails"
                    v-bind:key="index"
                >
                    <div class="item__name">
                        <strong>{{ family.legal_name }}</strong>
                    </div>
                    <div class="item__relationship">
                        {{ family.family_relation.title }}
                    </div>
                    <div class="item__email">{{ family.email }}</div>
                    <div class="item__phone"></div>
                    <div class="item__action">
                        <router-link
                            :to="{ path: '/family-members/' + family.id }"
                            class="btn-edit"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-edit"
                            >
                                <path
                                    d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                                ></path>
                                <path
                                    d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"
                                ></path>
                            </svg> </router-link
                        >&nbsp;
                        <a
                            href="javascript:void();"
                            @click="removeFamilyMember(family.id)"
                            class="btn-delete"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-trash-2"
                            >
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                                ></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <form
                id="frmFamilyMemberSection"
                name="frmFamilyMemberSection"
                method="post"
                class="custom-form"
                @submit.prevent="handleSubmit"
            >
                <div class="field-group form-group-checkbox clearfix">
                    <label for="chk_complete">
                        <input
                            type="checkbox"
                            name="chk_complete"
                            id="chk_complete"
                            v-model="is_completed"
                            :value="is_completed"
                        /><i></i> <span>Mark as complete</span>
                    </label>
                </div>
                <div class="field-group clearfix">
                    <input
                        type="submit"
                        class="field-submit btn-primary"
                        value="Save and Continue"
                    />
                    <router-link
                        to="/family-members"
                        class="btn-primary btn-editinfo"
                        >Add Member</router-link
                    >
                </div>
            </form>
        </div>
        <div class="question-item" v-if="!showFamilyDetails">
            <div class="question-header">
                <h3>
                    Would you like to add close family members including
                    children?
                </h3>
                <div class="yesno">
                    <a
                        href="javascript:void(0)"
                        @click.prevent="familymemberstatus(1)"
                        class="btn-yes"
                        >Yes</a
                    >
                    <a
                        href="javascript:void(0)"
                        @click.prevent="familymemberstatus(0)"
                        class="btn-no"
                        >No</a
                    >
                </div>
            </div>
            <a
                href="javascript:void(0)"
                @click.prevent="familymemberstatus(2)"
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
            showFamilyDetails: false,
            familyDetails: [],
            userId: "",
            is_completed: false
        };
    },
    mounted() {
        this.updatestepinfo();
        this.getFamilyMemberInfo();
    },
    methods: {
        async handleSubmit(e) {
            const form = e.target;
            const formData = new FormData(form);

            axios
                .post("/familyinfo/updatestatus", formData)
                .then(response => {
                    if (response.status == 200) {
                        this.$router.push("/close-friends-question");
                    }
                })
                .catch(function() {});
        },
        updatestepinfo() {
            let data = { step_id: 4, is_visited: "1" };
            axios
                .post("/updatepersonalstep", data)
                .then(response => {
                    console.log(response);
                })
                .catch(function() {});
        },
        familymemberstatus(status) {
            if (status == 0) {
                this.formData = { has_family_member: "0" };
            } else if (status == 1) {
                this.formData = { has_family_member: "1" };
            } else if (status == 2) {
                this.formData = { has_family_member: "2" };
            }

            axios
                .post("familyinfo/updatefamilystatus", this.formData)
                .then(response => {
                    if (status == "1") {
                        this.$router.push("/family-members");
                    } else {
                        this.$router.push("/close-friends-question");
                    }
                })
                .catch(function() {});
        },
        getFamilyMemberInfo() {
            axios.get("/familyinfo/getfamilymembersinfo").then(response => {
                if (response.status == 200) {
                    if (response.data.data[0]) {
                        this.familyDetails = JSON.parse(
                            JSON.stringify(response.data.data)
                        );
                        this.userId = this.familyDetails.user_id;
                        this.showFamilyDetails = true;
                    } else {
                        this.showFamilyDetails = false;
                    }
                }
            });
        },
        removeFamilyMember(id) {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "Delete family member information?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                })
                .then(result => {
                    if (result.value) {
                        axios
                            .delete("familyinfo/" + id + "/removefamilymember")
                            .then(response => {
                                if (response.status == 200) {
                                    this.$swal.fire(
                                        "Deleted!",
                                        "Family member information is deleted",
                                        "success"
                                    );
                                    this.getFamilyMemberInfo();
                                }
                            })
                            .catch(function() {});
                    }
                });
        }
    }
};
</script>
