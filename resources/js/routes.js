import PersonalDetails from './components/personalinfo/PersonalDetails.vue';
import Spouse from './components/personalinfo/Spouse.vue';
import PreviousSpouse from './components/personalinfo/PreviousSpouse.vue';
import FamilyMembers from './components/personalinfo/FamilyMembers.vue';

import SpouseQuestion from './components/personalinfo/questions/Spouse.vue';
import PreviousSpouseQuestion from './components/personalinfo/questions/PreviousSpouse.vue';
import FamilyMembersQuestion from './components/personalinfo/questions/FamilyMembers.vue';

export const routes = [
    { path: '/', component: PersonalDetails },
    { path: '/Spouse', component: Spouse },
    { path: '/previous-spouse', component: PreviousSpouse },
    { path: '/family-members', component: FamilyMembers },

    { path: '/spouse-question', component: SpouseQuestion },
    { path: '/previous-spouse-question', component: PreviousSpouseQuestion },
    { path: '/family-members-question', component: FamilyMembersQuestion }
];