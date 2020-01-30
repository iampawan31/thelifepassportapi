import Vue from "vue";
import Vuex from "vuex";
// import axios from "axios";

Vue.use(Vuex);

const mainStore = new Vuex.Store({
    state: {
        user: [],
        personal: [],
        phones: [],
        emails: [],
        socials: [],
        employers: [],
        apiToken: ""
    },
    mutations: {
        ADD_USER(state, user) {
            state.user = user;
        },
        ADD_PERSONAL_INFORMATION(state, personal) {
            state.personal = personal;
        },
        ADD_PHONES(state, phones) {
            state.phones = phones;
        },
        ADD_EMAILS(state, emails) {
            state.emails = emails;
        },
        ADD_SOCIALS(state, socials) {
            state.socials = socials;
        },
        ADD_EMPLOYERS(state, employers) {
            state.employers = employers;
        }
    },
    actions: {
        populateData({ commit }, data) {
            commit("ADD_USER", data);
            commit("ADD_PERSONAL_INFORMATION", data.personal);
            commit("ADD_PHONES", data.phones);
            commit("ADD_EMAILS", data.emails);
            commit("ADD_SOCIALS", data.socials);
            commit("ADD_EMPLOYERS", data.employers);
        }
    }
});

export default mainStore;
