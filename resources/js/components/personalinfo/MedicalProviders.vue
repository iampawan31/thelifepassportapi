<template>
    <div class="c">
        <div class="question-item" data-nextpage="questions/health-surrogate.php">
            <div class="section-form">
                <div class="form-wrapper form-family-member">
                    <form name="frmFamilyMember" action="#" method="post" class="custom-form">
                        <p>Related field will be displayed here.....</p>

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
            this.$router.push("/health-surrogate-question");
        }
    }
};
</script>