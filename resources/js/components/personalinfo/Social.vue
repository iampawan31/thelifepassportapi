<template>
  <div class="field-group">
    <div class="add-anohter-field">
      <div class="field-wrapper" v-for="(line, index) in lines" v-bind:key="index">
        <div class="row">
          <div class="col-md-5">
            <Select2 
              width="resolve"
              name="social_media_type"
              id="social_media_type"
              placeholder="Select an Options"
              v-model="socialValue" 
              :options="socialOptions" 
              @change="socialChangeEvent($event)" 
              @select="socialSelectEvent($event)" />
          </div>
          <div class="col-md-7 col-sm-12">
            <div class="fields-group clearfix">
              <input
                type="text"
                name="social_username"
                id="social_username"
                class="field-input"
                placeholder="Username"
                v-model="line.username"
                value=""
              />
              <input
                type="password"
                name="social_password"
                id="social_password"
                class="field-input field-input__last"
                placeholder="Password"
                v-model="line.password"
                value=""
              />
            </div>
          </div>
        </div>
        <a href="javascript:void(0);" class="btn-remove" v-if="index != 0" @click="removeLine(index)">
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
        <a href="javascript:void(0);" @click="addLine">
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
      socialOptions: ['Facebook', 'Twitter', 'Instagram', 'LinkedIn', 'Youtube', 'Others'],
      lines: [],
      blockRemoval: true
    };
  },
  watch: {
    lines() {
      this.blockRemoval = this.lines.length <= 1;
    }
  },
  methods: {
    addLine() {
      // let checkEmptyLines = this.lines.filter(line => line.number === null)
      // console.log(checkEmptyLines);
      // if (checkEmptyLines.length >= 1 && this.lines.length > 0) return

      this.lines.push({ social: null, username: null, password: null });
    },
    removeLine(lineId) {
      if (!this.blockRemoval) this.lines.splice(lineId, 1);
    }
  },
  mounted() {
    this.addLine();
  },
  socialChangeEvent(val){
      console.log(val);
  },
  socialSelectEvent({id, text}){
      console.log({id, text})
  }
}
</script>