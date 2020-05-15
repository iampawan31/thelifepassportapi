<template>
    <div id="b">
        <nav>
            <div class="questions-list">

                <div :class="getClass('/', '/personal-info', personalDetails.is_filled, personalDetails.is_completed)">
                    <span class="item__status" v-if="$route.path == '/' || $route.path == '/personal-info'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </span>

                    <span class="item__status" v-else-if="personalDetails.is_filled == 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </span>

                    <span class="item__status" v-else-if="personalDetails.is_completed == 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                    </span>

                    <span class="item__status" v-else-if="personalDetails.is_completed == 1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </span>

                    <h3><router-link to="/" exact>Your personal details</router-link></h3>
                    <div class="item__meta" v-if="personalDetails.is_filled">
                        <span class="item__last-updated">Last Updated: {{ personalDetails.updated_at }}</span> &nbsp;/&nbsp;
                        <router-link to="/">Edit</router-link>
                    </div>
                </div>

                <div :class="getClass('/spouse-question', '/spouse', spouse.is_filled, spouse.is_completed)">
                    <span class="item__status" v-if="$route.path == '/spouse-question' || $route.path == '/spouse'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </span>
                    <span class="item__status" v-else-if="spouse.is_filled == 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </span>
                    <span class="item__status" v-else-if="spouse.is_completed == 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                    </span>
                    <span class="item__status" v-else-if="spouse.is_completed == 1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </span>

                    <h3><router-link :event="disableRouter(personalDetails.is_filled)" to="/spouse-question" exact>Are you married?</router-link></h3>

                    <div class="item__meta" v-if="spouse.is_visited != '0'">
                        <span v-if="marriageStatus && marriageStatus.is_married == '0'">You answered: <strong>No</strong></span>
                        <span v-else-if="marriageStatus && marriageStatus.is_married == '1'">You answered: <strong>YES</strong></span>
                        <span v-else-if="marriageStatus && marriageStatus.is_married == '2'">You answered: <strong>SKIPPED</strong></span>
                        <span v-else>You answered: <strong>NONE</strong></span><br>

                        <span class="item__last-updated" v-if="spouse.updated_at != ''">Last Updated: {{ spouse.updated_at }}</span> &nbsp;/&nbsp;

                        <!-- <router-link v-if="marriageStatus && marriageStatus.is_married == '0'" to="/spouse-question">Edit</router-link>
                        <router-link v-else-if="marriageStatus && marriageStatus.is_married == '2'" to="/spouse-question">Edit</router-link>
                        <router-link v-else to="/spouse">Edit</router-link> -->
                        <router-link to="/spouse-question">Edit</router-link>
                    </div>
                    <div class="item__meta" v-else>
                        <span class="item__last-updated">Not Visited</span>
                    </div>
                </div>

                <div :class="getClass('/previous-spouse-question', '/previous-spouse', previousSpouse.is_filled, previousSpouse.is_completed)">
                    <span class="item__status" v-if="$route.path == '/previous-spouse-question' || $route.path == '/previous-spouse'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </span>
                    <span class="item__status" v-else-if="previousSpouse.is_filled == 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </span>
                    <span class="item__status" v-else-if="previousSpouse.is_completed == 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                    </span>
                    <span class="item__status" v-else-if="previousSpouse.is_completed == 1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </span>

                    <h3><router-link :event="disableRouter(spouse.is_filled)"  to="/previous-spouse-question">Were you previously married?</router-link></h3>

                    <div class="item__meta" v-if="previousSpouse.is_visited != '0'">
                        <span v-if="previousMarriageStatus && previousMarriageStatus.is_previously_married == '0'">You answered: <strong>No</strong></span>
                        <span v-else-if="previousMarriageStatus && previousMarriageStatus.is_previously_married == '1'">You answered: <strong>YES</strong></span>
                        <span v-else-if="previousMarriageStatus && previousMarriageStatus.is_previously_married == '2'">You answered: <strong>SKIPPED</strong></span>
                        <span v-else>You answered: <strong>NONE</strong></span><br>

                        <span class="item__last-updated" v-if="previousSpouse.updated_at != ''">Last Updated: {{ previousSpouse.updated_at }}</span> &nbsp;/&nbsp;

                        <!-- <router-link v-if="previousMarriageStatus && previousMarriageStatus.is_previously_married == '0'" to="/previous-spouse-question">Edit</router-link>
                        <router-link v-else-if="previousMarriageStatus && previousMarriageStatus.is_previously_married == '2'" to="/previous-spouse-question">Edit</router-link>
                        <router-link v-else to="/previous-spouse">Edit</router-link> -->
                        <router-link to="/previous-spouse-question">Edit</router-link>
                    </div>
                    <div class="item__meta" v-else>
                        <span class="item__last-updated">Not Visited</span>
                    </div>
                </div>

                <div :class="getClass('/family-members-question', '/family-members', familyMembers.is_filled, familyMembers.is_completed)">

                    <span class="item__status" v-if="$route.path == '/family-members-question' || $route.path == '/family-members'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </span>
                    <span class="item__status" v-else-if="familyMembers.is_filled == 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecax="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </span>
                    <span class="item__status" v-else-if="familyMembers.is_completed == 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                    </span>
                    <span class="item__status" v-else-if="familyMembers.is_completed == 1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </span>

                    <h3><router-link :event="disableRouter(previousSpouse.is_filled)" to="/family-members-question">Would you like to add close family members including children?</router-link></h3>

                    <div class="item__meta" v-if="familyMembers.is_visited != '0'">
                        <span v-if="familyMembersStatus && familyMembersStatus.has_family_member == '0'">You answered: <strong>No</strong></span>
                        <span v-else-if="familyMembersStatus && familyMembersStatus.has_family_member == '1'">MEMBER ADDED: <strong>{{ familyMembersStatus.count }}</strong></span>
                        <span v-else-if="familyMembersStatus && familyMembersStatus.has_family_member == '2'">You answered: <strong>SKIPPED</strong></span>
                        <span v-else>You answered: <strong>NONE</strong></span><br>

                        <span class="item__last-updated" v-if="familyMembers.updated_at != ''">Last Updated: {{ familyMembers.updated_at }}</span> &nbsp;/&nbsp;
                        <router-link to="/family-members-question">Edit</router-link>
                    </div>
                    <div class="item__meta" v-else>
                        <span class="item__last-updated">Not Visited</span>
                    </div>
                </div>

                <div :class="getClass('/close-friends-question', '/close-friends', closeFriends.is_filled, closeFriends.is_completed)">

                    <span class="item__status" v-if="$route.path == '/close-friends-question' || $route.path == '/close-friends'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </span>
                    <span class="item__status" v-else-if="closeFriends.is_filled == 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </span>
                    <span class="item__status" v-else-if="closeFriends.is_completed == 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                    </span>
                    <span class="item__status" v-else-if="closeFriends.is_completed == 1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </span>

                    <h3><router-link :event="disableRouter(familyMembers.is_filled)" to="/close-friends-question">Would you like any close friends contacted?</router-link></h3>

                    <div class="item__meta" v-if="closeFriends.is_visited != '0'">
                        <span v-if="friendsStatus && friendsStatus.has_friends == '0'">You answered: <strong>No</strong></span>
                        <span v-else-if="friendsStatus && friendsStatus.has_friends == '1'">MEMBER ADDED: <strong>{{ friendsStatus.count }}</strong></span>
                        <span v-else-if="friendsStatus && friendsStatus.has_friends == '2'">You answered: <strong>SKIPPED</strong></span>
                        <span v-else>You answered: <strong>NONE</strong></span><br>

                        <span class="item__last-updated" v-if="closeFriends.updated_at != ''">Last Updated: {{ closeFriends.updated_at }}</span> &nbsp;/&nbsp;
                        <router-link to="/close-friends-question">Edit</router-link>
                    </div>
                    <div class="item__meta" v-else>
                        <span class="item__last-updated">Not Visited</span>
                    </div>
                </div>

                <div :class="getClass('/home-assistants-question', '/home-assistants', homeAssistants.is_filled, homeAssistants.is_completed)">

                    <span class="item__status" v-if="$route.path == '/home-assistants-question' || $route.path == '/home-assistants'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </span>
                    <span class="item__status" v-else-if="homeAssistants.is_filled == 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </span>
                    <span class="item__status" v-else-if="homeAssistants.is_completed == 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                    </span>
                    <span class="item__status" v-else-if="homeAssistants.is_completed == 1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </span>

                    <h3><router-link :event="disableRouter(closeFriends.is_filled)" to="/close-friends-question">Do you have any home assistants?</router-link></h3>

                    <div class="item__meta" v-if="homeAssistants.is_filled">
                        <span class="item__last-updated">Last Updated: {{ homeAssistants.updated_at }}</span> &nbsp;/&nbsp;
                        <router-link to="/home-assistants">Edit</router-link>
                    </div>
                    <div class="item__meta" v-else>
                        <span class="item__last-updated">Not Visited</span>
                    </div>
                </div>

                <div :class="getClass('/estate-representative-question', '/estate-representative', homeAssistants.is_filled, homeAssistants.is_completed)">

                    <span class="item__status" v-if="$route.path == '/estate-representative-question' || $route.path == '/estate-representative'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </span>
                    <span class="item__status" v-else-if="estateRepresentative.is_filled == 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </span>
                    <span class="item__status" v-else-if="estateRepresentative.is_completed == 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                    </span>
                    <span class="item__status" v-else-if="estateRepresentative.is_completed == 1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </span>

                    <h3><router-link :event="disableRouter(homeAssistants.is_filled)" to="/close-friends-question">Do you have a personal representative for your estate?</router-link></h3>

                    <div class="item__meta" v-if="estateRepresentative.is_filled">
                        <span class="item__last-updated">Last Updated: {{ estateRepresentative.updated_at }}</span> &nbsp;/&nbsp;
                        <router-link to="/estate-representative">Edit</router-link>
                    </div>
                    <div class="item__meta" v-else>
                        <span class="item__last-updated">Not Visited</span>
                    </div>
                </div>

                <div :class="getClass('/spouse-estate-representative-question', '/spouse-estate-representative', homeAssistants.is_filled, homeAssistants.is_completed)">

                    <span class="item__status" v-if="$route.path == '/spouse-estate-representative-question' || $route.path == '/spouse-estate-representative'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </span>
                    <span class="item__status" v-else-if="spouseEstateRepresentative.is_filled == 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </span>
                    <span class="item__status" v-else-if="spouseEstateRepresentative.is_completed == 0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                    </span>
                    <span class="item__status" v-else-if="spouseEstateRepresentative.is_completed == 1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </span>

                    <h3><router-link :event="disableRouter(estateRepresentative.is_filled)" to="/close-friends-question">Does your spouse/life partner/signifcant other have a personal representative of their estate?</router-link></h3>

                    <div class="item__meta" v-if="spouseEstateRepresentative.is_filled">
                        <span class="item__last-updated">Last Updated: {{ spouseEstateRepresentative.updated_at }}</span> &nbsp;/&nbsp;
                        <router-link to="/spouse-estate-representative">Edit</router-link>
                    </div>
                    <div class="item__meta" v-else>
                        <span class="item__last-updated">Not Visited</span>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    data() {
        return {
            routeName: null,
            leftNav: [],
            personalDetails: [],
            spouse: [],
            previousSpouse: [],
            familyMembers: [],
            closeFriends: [],
            homeAssistants: [],
            estateRepresentative: [],
            spouseEstateRepresentative: [],
            religiousOrganization: [],
            marriageStatus: [],
            previousMarriageStatus: [],
            familyMembersStatus: [],
            friendsStatus: []
        };
    },
    created() {
        this.getNavigationInfo();
        this.getSpouseMarriageStatus();
        this.getPreviousSpouseMarriageStatus();
        this.getFamilyMembersStatus();
        this.getFriendsStatus();
    },
    mounted() {
        $("#b").mCustomScrollbar({
            scrollButtons:{enable:true},
            autoHideScrollbar:true,
            theme:"dark"
        });
        feather.replace();
    },
    watch: {
        //$route: "currentRoute"
        $route: function(to, from) {
            this.getNavigationInfo();
            this.getSpouseMarriageStatus();
            this.getPreviousSpouseMarriageStatus();
            this.getFamilyMembersStatus();
            this.getFriendsStatus();
        }
    },
    methods: {
        getNavigationInfo() {
            axios.get('/getpersonalinfonav').then((response) => {
                if (response.status == 200) {
                    this.leftNav = response.data.leftmenu
                    this.personalDetails = this.leftNav.personal_details;
                    this.spouse = this.leftNav.spouse;
                    this.previousSpouse = this.leftNav.previous_spouse;
                    this.familyMembers = this.leftNav.family_members;
                    this.closeFriends = this.leftNav.close_friends;
                    this.homeAssistants = this.leftNav.home_assistants;
                    this.estateRepresentative = this.leftNav.estate_representative;
                    this.spouseEstateRepresentative = this.leftNav.spouse_estate_representative;
                    this.religiousOrganization = this.leftNav.religious_organization;
                }
            });
        },
        currentRoute() {
            this.$nextTick(() => {
                this.routeName = this.$route.name;
            });
        },
        getClass(url, nextUrl, is_filled, is_completed ) {
            //console.log(this.$route.path);
            if (url == this.$route.path || nextUrl == this.$route.path) {
                return 'item current active';
            } else if(is_filled == 0) {
                return 'item item__no-data locked';
            } else {
                return 'item';
            }
        },
        disableRouter(prev_step_is_filled) {
            if (prev_step_is_filled == 0) {
                return "'click' : ''";
            } else {
                return "'click' : 'clicked'";
            }
        },
        getSpouseMarriageStatus() {
            axios.get('personal/marriage-status')
                .then((response) => {
                    if(response.status == 200) {
                        this.marriageStatus = response.data.data;
                    }
                })
                .catch(function(){

                });
        },
        getPreviousSpouseMarriageStatus() {
            axios.get('previousspouse/getpreviousmarriagestatus')
                .then((response) => {
                    if(response.status == 200) {
                        this.previousMarriageStatus = response.data.data;
                    }
                })
                .catch(function(){

                });
        },
        getFamilyMembersStatus() {
            axios.get('personal/family/status')
                .then((response) => {
                    if(response.status == 200) {
                        this.familyMembersStatus = response.data.data;
                        // console.log("Family Members");
                        // console.log(this.familyMembersStatus);
                    }
                })
                .catch(function(){

                });
        },
        getFriendsStatus() {
            axios.get('friendsinfo/getfriendsstatus')
                .then((response) => {
                    if(response.status == 200) {
                        this.friendsStatus = response.data.data;
                    }
                })
                .catch(function(){

                });
        }
    }
};
</script>
