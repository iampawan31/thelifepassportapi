<template>
    <div class="c">
        <div v-if="showFamilyDetails">
            <h3 class="heading3">
                Close family members
            </h3>
            <div class="data">
                <div class="item item__header clearfix">
                    <div class="item__name">
                        Name
                    </div>
                    <div class="item__relationship">
                        Relationship
                    </div>
                    <div class="item__email">
                        Email
                    </div>
                    <div class="item__phone" />
                    <div class="item__action" />
                </div>
                <div
                    v-for="(family, index) in familyDetails"
                    :key="index"
                    class="item clearfix"
                >
                    <div class="item__name">
                        <strong>{{ family.legal_name }}</strong>
                    </div>
                    <div class="item__relationship">
                        {{ family.relation.title }}
                    </div>
                    <div class="item__email">
                        {{ family.email }}
                    </div>
                    <div class="item__phone" />
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
                                />
                                <path
                                    d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"
                                />
                            </svg> </router-link
                        >&nbsp;
                        <a
                            href="javascript:void();"
                            class="btn-delete"
                            @click="removeFamilyMember(family.id)"
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
                                <polyline points="3 6 5 6 21 6" />
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                                />
                                <line x1="10" y1="11" x2="10" y2="17" />
                                <line x1="14" y1="11" x2="14" y2="17" />
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
                    <label for="has_family_member">
                        <input
                            id="has_family_member"
                            v-model="isCompleted"
                            type="checkbox"
                            name="has_family_member"
                            :value="isCompleted"
                        /><i /> <span>Mark as complete</span>
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
                    >
                        Add Member
                    </router-link>
                </div>
            </form>
        </div>
        <div v-if="!showFamilyDetails" class="question-item">
            <div class="question-header">
                <h3>
                    Would you like to add close family members including
                    children?
                </h3>
                <div class="yesno">
                    <a
                        href="javascript:void(0)"
                        class="btn-yes"
                        @click.prevent="familymemberstatus(1)"
                        >Yes</a
                    >
                    <a
                        href="javascript:void(0)"
                        class="btn-no"
                        @click.prevent="familymemberstatus(0)"
                        >No</a
                    >
                </div>
            </div>
            <a
                href="javascript:void(0)"
                class="btn-skip"
                @click.prevent="familymemberstatus(2)"
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
            isCompleted: false
        };
    },
    mounted() {
        this.updateStepinfo();
        this.getFamilyMemberInfo();
    },
    methods: {
        async handleSubmit(e) {
            const form = e.target;
            const formData = new FormData(form);
            formData.append("has_family_member", this.isCompleted);

            axios
                .post("/personal/family/status", formData)
                .then(response => {
                    if (response.status == 201) {
                        this.$router.push("/close-friends-question");
                    }
                })
                .catch(function() {});
        },
        updateStepinfo() {
            let data = { step_id: 4, is_visited: 1 };
            axios
                .post("/steps", data)
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
                .post("/personal/family/status", this.formData)
                .then(response => {
                    console.log(response);
                    if (status == "1") {
                        this.$router.push("/family-members");
                    } else {
                        this.$router.push("/close-friends-question");
                    }
                })
                .catch(function() {});
        },
        getFamilyMemberInfo() {
            axios.get("/personal/family").then(response => {
                if (response.status == 200) {
                    if (response.data.data[0]) {
                        this.familyDetails = JSON.parse(
                            JSON.stringify(response.data.data)
                        );
                        this.userId = this.familyDetails[0].user_id;
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
                            .delete("personal/family/" + id)
                            .then(response => {
                                if (response.status == 201) {
                                    this.$swal.fire({
                                        title: "Deleted!",
                                        text:
                                            "Family member information is deleted",
                                        icon: "success"
                                    });

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
