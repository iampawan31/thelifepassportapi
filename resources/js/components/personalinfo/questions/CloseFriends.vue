<template>
    <div class="c">
        <div v-if="showFriendsDetails">
            <h3 class="heading3">Close friends</h3>
            <div class="data">
                <div class="item item__header clearfix">
                    <div class="item__name">Name</div>
                    <div class="item__relationship">Email</div>
                    <div class="item__email"></div>
                    <div class="item__phone"></div>
                    <div class="item__action"></div>
                </div>
                <div
                    class="item clearfix"
                    v-for="(friend, index) in friendsDetails"
                    v-bind:key="index"
                >
                    <div class="item__name">
                        <strong>{{ friend.legal_name }}</strong>
                    </div>
                    <div class="item__email">{{ friend.email }}</div>
                    <div class="item__phone"></div>
                    <div class="item__action">
                        <router-link
                            :to="{ path: '/close-friends/' + friend.id }"
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
                            @click="removeFriend(friend.id)"
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
                id="frmFriendsSection"
                name="frmFriendsSection"
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
                        to="/close-friends"
                        class="btn-primary btn-editinfo"
                        >Add Member</router-link
                    >
                </div>
            </form>
        </div>
        <div class="question-item" v-if="!showFriendsDetails">
            <div class="question-header">
                <h3>Would you like any close friends contacted?</h3>
                <div class="yesno">
                    <a
                        href="javascript:void(0)"
                        @click.prevent="friendsstatus(1)"
                        class="btn-yes"
                        >Yes</a
                    >
                    <a
                        href="javascript:void(0)"
                        @click.prevent="friendsstatus(0)"
                        class="btn-no"
                        >No</a
                    >
                </div>
            </div>
            <a
                href="javascript:void(0)"
                @click.prevent="friendsstatus(2)"
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
            showFriendsDetails: false,
            friendsDetails: [],
            userId: "",
            is_completed: false
        };
    },
    mounted() {
        this.updatestepinfo();
        this.getFriendsInfo();
    },
    methods: {
        async handleSubmit(e) {
            const form = e.target;
            const formData = new FormData(form);

            axios
                .post("/friendsinfo/updatestatus", formData)
                .then(response => {
                    if (response.status == 200) {
                        this.$router.push("/home-assistants-question");
                    }
                })
                .catch(function() {});
        },
        updatestepinfo() {
            let data = { step_id: 5, is_visited: "1" };
            axios
                .post("/steps", data)
                .then(response => {
                    console.log(response);
                })
                .catch(function() {});
        },
        friendsstatus(status) {
            if (status == 0) {
                this.formData = { has_friends: "0" };
            } else if (status == 1) {
                this.formData = { has_friends: "1" };
            } else if (status == 2) {
                this.formData = { has_friends: "2" };
            }

            axios
                .post("friendsinfo/updatefriendsstatus", this.formData)
                .then(response => {
                    if (status == "1") {
                        this.$router.push("/close-friends");
                    } else {
                        this.$router.push("/home-assistants-question");
                    }
                })
                .catch(function() {});
        },
        getFriendsInfo() {
            axios.get("/friendsinfo/getfriendsinfo").then(response => {
                if (response.status == 200) {
                    if (response.data.data[0]) {
                        this.friendsDetails = JSON.parse(
                            JSON.stringify(response.data.data)
                        );
                        this.userId = this.friendsDetails.user_id;
                        this.showFriendsDetails = true;
                    } else {
                        this.showFriendsDetails = false;
                    }
                }
            });
        },
        removeFriend(id) {
            axios
                .delete("friendsinfo/" + id + "/removefriends")
                .then(response => {
                    if (response.status == 200) {
                        this.getFriendsInfo();
                    }
                })
                .catch(function() {});
        }
    }
};
</script>
