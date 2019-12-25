<template>
  <div class="field-group">
    <div class="add-anohter-field">
      <div class="field-wrapper" v-for="(social, index) in socialMedia" v-bind:key="index">
        <div class="row">
          <div class="col-md-5">
            <Select2 
              width="resolve"
              name="social_media_type[]"
              placeholder="Select an Options"
              :options="socialOptions" 
               />
          </div>
          <!-- v-model="socialValue" 
            @change="socialChangeEvent($event)" 
              @select="socialSelectEvent($event)" -->
          <div class="col-md-7 col-sm-12">
            <div class="fields-group clearfix">
              <input
                type="text"
                name="social_username[]"
                class="field-input"
                placeholder="Username"
                v-model="social.username"
                value=""
              />
              <input
                type="password"
                name="social_password[]"
                class="field-input field-input__last"
                placeholder="Password"
                v-model="social.password"
                value=""
              />
            </div>
          </div>
        </div>
        <a href="javascript:void(0);" class="btn-remove" v-if="index != 0" @click="removeSocialMedia(index)">
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
            <circle cx="12" cy="12" r="10" />
            <line x1="8" y1="12" x2="16" y2="12" />
          </svg>
        </a>
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
          </svg> Add another
        </a>
      </div>
    </div>
  </div>
</template>
<script>
import Select2 from 'v-select2-component';
export default {
  components: {
    Select2
  },
  data() {
    return {
      socialValue: '',
      //socialOptions: ['Facebook', 'Twitter', 'Instagram', 'LinkedIn', 'Youtube', 'Others'],
      socialOptions: [],
      socialMedia: [],
      blockRemoval: true
    };
  },
  created() {
    axios.get('/socialmedialist').then((response) => {
        
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
      this.socialMedia.push({ social: null, username: null, password: null });
    },
    removeSocialMedia(lineId) {
      if (!this.blockRemoval) this.socialMedia.splice(lineId, 1);
    }
  },
  mounted() {
    this.addSocialMedia();
  },
  socialChangeEvent(val){
      console.log(val);
  },
  socialSelectEvent({id, text}){
      console.log({id, text})
  }
}
</script>