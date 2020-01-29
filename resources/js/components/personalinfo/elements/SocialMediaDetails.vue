<template>
    <div class="field-group">
        <h4 class="form-subhead">Social Media</h4>
        <div class="add-anohter-field">
            <div
                class="field-wrapper"
                v-for="(social, index) in localSocials"
                v-bind:key="index"
            >
                <social-media
                    :value="social"
                    :social-media-key="index"
                    :social-media-options="socialOptions"
                    v-on:social-media-removal="removeSocialMedia"
                >
                </social-media>
            </div>
            <div class="btn-add">
                <a href="javascript:void(0);" @click="addSocialMedia">
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
                        class="feather feather-plus"
                    >
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Add another
                </a>
            </div>
        </div>
    </div>
</template>
<script>
import Select2 from "v-select2-component";
import SocialMedia from "./SocialMedia";

export default {
    props: {
        value: {
            type: Array,
            required: true
        }
    },
    computed: {
        localSocials: {
            get() {
                return this.value;
            },
            set(localSocials) {
                this.$emit("input", localSocials);
            }
        },
        singleEmailIsAdded() {
            return (
                this.localSocials !== undefined && this.localSocials.length > 0
            );
        }
    },
    components: {
        Select2,
        SocialMedia
    },
    data() {
        return {
            socialOptions: []
        };
    },
    created() {
        axios.get("/socialmedialist").then(response => {
            if (response.status == 200) {
                this.socialOptions = response.data.social;
            }
        });
    },
    methods: {
        addSocialMedia() {
            this.localSocials.push({
                social_id: null,
                username: null,
                password: null
            });
        },
        removeSocialMedia(lineId) {
            this.localSocials.splice(lineId, 1);
        }
    }
};
</script>
