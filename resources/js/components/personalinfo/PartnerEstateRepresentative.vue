<template>
  <div class="c">
    <div
      class="question-item"
      data-nextpage="questions/belong.php"
    >
      <div class="section-form">
        <div class="form-wrapper form-family-member">
          <form
            name="frmFamilyMember"
            action="#"
            method="post"
            class="custom-form"
            @submit.prevent="handleSubmit()"
          >
            <div class="staff-members-fields">
              <div class="field-group">
                <label
                  for="txt_name"
                  class="input-label"
                >Name</label>
                <input
                  type="text"
                  name="txt_name"
                  id="txt_name"
                  data-id="txt_name"
                  class="field-input required"
                  placeholder="Name"
                />
              </div>
              <div class="field-group">
                <label
                  for="txt_name"
                  class="input-label"
                >Relationship</label>
                <input
                  type="text"
                  name="txt_name"
                  id="txt_name"
                  data-id="txt_name"
                  class="field-input required"
                  placeholder="Relationship"
                />
              </div>
              <div class="field-group">
                <label
                  for="txt_name"
                  class="input-label"
                >Company</label>
                <input
                  type="text"
                  name="txt_name"
                  id="txt_name"
                  data-id="txt_name"
                  class="field-input required"
                  placeholder="Company"
                />
              </div>

              <div class="field-group">
                <label for="home_address">Address</label>
                <textarea
                  rows="2"
                  name="home_address"
                  id="home_address"
                  class="field-input"
                  placeholder="Street Address, Town, City, State, Zipcode and country"
                ></textarea>
              </div>
              <div class="field-group">
                <label
                  for="txt_name"
                  class="input-label"
                >Phone Number</label>
                <input
                  type="text"
                  name="txt_name"
                  id="txt_name"
                  data-id="txt_name"
                  class="field-input required"
                  placeholder="Phone Number"
                />
              </div>
              <div class="field-group">
                <label
                  for="txt_name"
                  class="input-label"
                >Email</label>
                <input
                  type="text"
                  name="txt_name"
                  id="txt_name"
                  data-id="txt_name"
                  class="field-input required"
                  placeholder="Email"
                />
              </div>
              <div class="field-group">
                <label
                  for="txt_name"
                  class="input-label"
                >Website</label>
                <input
                  type="text"
                  name="txt_name"
                  id="txt_name"
                  data-id="txt_name"
                  class="field-input required"
                  placeholder="Website"
                />
              </div>

            </div>

            <div class="field-group clearfix">
              <input
                type="submit"
                class="field-submit btn-primary"
                value="Save and continue"
              />
            </div>
          </form>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {};
  },
  mounted() {},
  methods: {
    handleSubmit(e) {
      this.$router.push("/belong-question");
    }
  }
};
</script>
