<template>
  <div class="field-group">
    <div class="add-anohter-field">
        <div class="field-wrapper" v-for="(line, index) in lines" v-bind:key="index">
            <div class="fields-group clearfix">
                <input
                type="text"
                name="user_email"
                id="user_email"
                class="field-input field-input__first email"
                placeholder="Email address"
                v-model="line.email"
                value=""
                />
                <input
                type="password"
                name="email_password"
                id="email_password"
                class="field-input field-input__last"
                placeholder="password"
                v-model="line.password"
                value=""
                />
            </div>
            <a href="javascript:void(0);" class="btn-remove" v-if="index != 0" @click="removeLine(index)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg></a>
        </div>
        <div class="btn-add">
            <a href="javascript:void(0);" @click="addLine"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Add another</a>
        </div>
    </div>
</div>
</template>
<script>
export default {
  data() {
    return {
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

      this.lines.push({ email: null, password: null });
    },
    removeLine(lineId) {
      if (!this.blockRemoval) this.lines.splice(lineId, 1);
    }
  },
  mounted() {
    this.addLine();
  }
};
</script>