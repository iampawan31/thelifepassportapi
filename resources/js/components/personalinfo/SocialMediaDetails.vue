<template>
  <div class="field-group">
    <h4 class="form-subhead">Social Media</h4>
    <div class="add-anohter-field">
      <div
        class="field-wrapper"
        v-for="(social, index) in socialMedia"
        v-bind:key="index"
      >
        <social-media
          v-on:social-media-update="updateSocialMedia"
          :social-media-key="index"
          :social-media-options="socialOptions"
          :social-media-type="social.social"
          :social-media-username="social.username"
          :social-media-password="social.password"
        >
        </social-media>
        <a
          href="javascript:void(0);"
          class="btn-remove"
          v-if="index != 0"
          @click="removeSocialMedia(index)"
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
            class="feather feather-minus-circle"
          >
            <circle
              cx="12"
              cy="12"
              r="10"
            />
            <line
              x1="8"
              y1="12"
              x2="16"
              y2="12"
            />
          </svg>
        </a>
      </div>
      <div class="btn-add">
        <a
          href="javascript:void(0);"
          @click="addSocialMedia"
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
            class="feather feather-plus"
          >
            <line
              x1="12"
              y1="5"
              x2="12"
              y2="19"
            />
            <line
              x1="5"
              y1="12"
              x2="19"
              y2="12"
            />
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
  props: ["userSocials"],
  components: {
    Select2,
    SocialMedia
  },
  data() {
    return {
      socialValue: "",
      socialOptions: [],
      socialMedia: [],
      blockRemoval: true
    };
  },
  created() {
    axios.get("/socialmedialist").then(response => {
      if (response.status == 200) {
        this.socialOptions = response.data.social;
      }
    });
  },
  watch: {
    socialMedia() {
      this.blockRemoval = this.socialMedia.length <= 1;
    }
  },
  methods: {
    addSocialMedia() {
      this.socialMedia.push({
        social: null,
        username: null,
        password: null
      });
    },
    populateSocials() {
      if (this.userSocials.length > 0) {
        this.userSocials.forEach(data => {
          this.socialMedia.push({
            social: data.social_id,
            username: data.username,
            password: data.password
          });
        });
      } else {
        this.socialMedia.push({
          social: null,
          username: null,
          password: null
        });
      }
    },
    removeSocialMedia(lineId) {
      if (!this.blockRemoval) this.socialMedia.splice(lineId, 1);
    },
    updateSocialMedia(index, socialMediaType, username, password) {
      this.socialMedia[index].social = socialMediaType;
      this.socialMedia[index].username = username;
      this.socialMedia[index].password = password;
      this.$emit("social-media-details-updates", this.socialMedia);
    }
  },
  mounted() {
    this.$nextTick(() => {
      //this.addSocialMedia();
      this.populateSocials();
    });
  },
  socialChangeEvent(val) {
    console.log(val);
  },
  socialSelectEvent({ id, text }) {
    console.log({ id, text });
  }
};
</script>
