/* personal info  */
import PersonalDetails from './components/personalinfo/PersonalDetails.vue';
import Spouse from './components/personalinfo/Spouse.vue';
import PreviousSpouse from './components/personalinfo/PreviousSpouse.vue';
import FamilyMembers from './components/personalinfo/FamilyMembers.vue';
import CloseFriends from './components/personalinfo/CloseFriends.vue';
import HomeAssistants from './components/personalinfo/HomeAssistants.vue';
import EstateRepresentative from './components/personalinfo/EstateRepresentative.vue';
import PartnerEstateRepresentative from './components/personalinfo/PartnerEstateRepresentative.vue';
import Belong from './components/personalinfo/Belong.vue';
import ComputerPasswords from './components/personalinfo/ComputerPasswords.vue';
import MedicalProviders from './components/personalinfo/MedicalProviders.vue';
import HealthSurrogate from './components/personalinfo/HealthSurrogate.vue';
import Trustee from './components/personalinfo/Trustee.vue';
import Pets from './components/personalinfo/Pets.vue';
import SectionComplete from './components/personalinfo/SectionComplete.vue';


import SpouseQuestion from './components/personalinfo/questions/Spouse.vue';
import PreviousSpouseQuestion from './components/personalinfo/questions/PreviousSpouse.vue';
import FamilyMembersQuestion from './components/personalinfo/questions/FamilyMembers.vue';
import CloseFriendsQuestion from './components/personalinfo/questions/CloseFriends.vue';
import HomeAssistantsQuestion from './components/personalinfo/questions/HomeAssistants.vue';
import EstateRepresentativeQuestion from './components/personalinfo/questions/EstateRepresentative.vue';
import PartnerEstateRepresentativeQuestion from './components/personalinfo/questions/PartnerEstateRepresentative.vue';
import BelongQuestion from './components/personalinfo/questions/Belong.vue';
import ComputerPasswordsQuestion from './components/personalinfo/questions/ComputerPasswords.vue';
import MedicalProvidersQuestion from './components/personalinfo/questions/MedicalProviders.vue';
import HealthSurrogateQuestion from './components/personalinfo/questions/HealthSurrogate.vue';
import TrusteeQuestion from './components/personalinfo/questions/Trustee.vue';
import PetsQuestion from './components/personalinfo/questions/Pets.vue';

export const routes = [
    /* main routes */
    { path: '/', name: 'personalDetails', component: PersonalDetails },
    { path: '/spouse', name: 'spouse', component: Spouse },
    { path: '/previous-spouse', component: PreviousSpouse },
    { path: '/family-members', component: FamilyMembers },
    { path: '/close-friends', component: CloseFriends},
    { path: '/home-assistants', component: HomeAssistants},
    { path: '/estate-representative', component: EstateRepresentative},
    { path: '/partner-estate-representative', component: PartnerEstateRepresentative},
    { path: '/belong', component: Belong},
    { path: '/computer-passwords', component: ComputerPasswords},
    { path: '/medical-providers', component: MedicalProviders},
    { path: '/health-surrogate', component: HealthSurrogate},
    { path: '/trustee', component: Trustee },
    { path: '/pets', component: Pets},
    { path: '/section-complete', component: SectionComplete},
    /* questions routes */
    { path: '/spouse-question', component: SpouseQuestion },
    { path: '/previous-spouse-question', component: PreviousSpouseQuestion },
    { path: '/family-members-question', component: FamilyMembersQuestion },
    { path: '/close-friends-question', component: CloseFriendsQuestion},
    { path: '/home-assistants-question', component: HomeAssistantsQuestion},
    { path: '/estate-representative-question', component: EstateRepresentativeQuestion},
    { path: '/partner-estate-representative-question', component: PartnerEstateRepresentativeQuestion},
    { path: '/belong-question', component: BelongQuestion},
    { path: '/computer-passwords-question', component: ComputerPasswordsQuestion},
    { path: '/medical-providers-question', component: MedicalProvidersQuestion},
    { path: '/health-surrogate-question', component: HealthSurrogateQuestion},
    { path: '/trustee-question', component: TrusteeQuestion},
    { path: '/pets-question', component: PetsQuestion},
];