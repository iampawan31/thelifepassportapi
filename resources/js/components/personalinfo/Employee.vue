<template>
  <div class="add-anohter-field">
    <div class="field-wrapper" v-for="(line, index) in lines" v-bind:key="index">
      <div class="form-subgroup">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="field-group">
              <label for="spouse_employer_name" class="input-label">Employer Name</label>
              <input
                type="text"
                name="spouse_employer_name"
                id="spouse_employer_name"
                class="field-input"
                placeholder="Employer Name"
                v-model="line.employer_name"
                value=""
              />
            </div>
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="field-group">
              <label for="spouse_employer_phone" class="input-label">Employer Phone</label>
              <input
                type="text"
                name="spouse_employer_phone"
                id="spouse_employer_phone"
                class="field-input"
                placeholder="Phone number"
                v-model="line.employer_phone"
                value=""
              />
            </div>
          </div>
        </div>

        <div class="field-group">
          <label for="spouse_employer_address">Employer Address</label>
          <textarea
            rows="2"
            name="spouse_employer_address"
            id="spouse_employer_address"
            class="field-input"
            placeholder="Street Address, Town, City, State, Zipcode and country"
            v-model="line.employer_address"
            value=""
          ></textarea>
        </div>

        <div class="field-group">
          <label for="spouse_company_computer">Company computer user name and password</label>
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <input
                type="text"
                name="spouse_company_computer_un"
                id="spouse_company_computer_un"
                class="field-input"
                placeholder="Username"
                v-model="line.employer_computer_username"
                value=""
              />
            </div>
            <div class="col-md-6 col-sm-12">
              <input
                type="text"
                name="spouse_company_computer_pwd"
                id="spouse_company_computer_pwd"
                class="field-input"
                placeholder="Password"
                v-model="line.employer_computer_password"
                value=""
              />
            </div>
          </div>
        </div>

        <div class="field-group field-group__last">
          <label for="spouse_employer_benefits">Benefits used</label>
          <textarea
            rows="2"
            name="spouse_employer_benefits"
            id="spouse_employer_benefits"
            class="field-input"
            placeholder="Benefits used"
            v-model="line.employee_benefits"
            value=""
          ></textarea>
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
    <div class="btn-add" @click="addLine">
      <a href="javascript:void(0);">
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

      this.lines.push({ 
            employer_name: null, 
            employer_phone: null,  
            employer_address: null, 
            employer_computer_username: null,
            employer_computer_password: null,
            employee_benefits: null
        });
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